<?php

namespace App\Http\Controllers;

use App\Exceptions\CartException;
use App\Models\Tool;
use App\Repositories\Contracts\LoanRepositoryInterface;
use App\Services\Contracts\LoanExporterInterface;
use App\Services\CartService;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected LoanService $loanService,
        protected LoanRepositoryInterface $loanRepository,
        protected LoanExporterInterface $loanExporter
    ) {}

    public function index()
    {
        $tools = Tool::where('status', 'available')->where('stock', '>', 0)->get();
        $cart = $this->cartService->getCart();

        return view('admin.pages.loan.index', compact('tools', 'cart'));
    }

    public function exportExcel(Request $request)
    {
        $ids = explode(',', $request->ids);
        $loans = $this->loanRepository->findManyWithDetails($ids);
        $csv = $this->loanExporter->export($loans);

        $fileName = 'rekap-peminjaman-' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        return response($csv, 200, $headers);
    }

    public function cart(Request $request)
    {
        try {
            $cart = match ($request->action) {
                'add' => $this->cartService->add((int) $request->tool_id),
                'update' => $this->cartService->updateQty((int) $request->tool_id, (int) $request->qty),
                'remove' => $this->cartService->remove((int) $request->tool_id),
                default => $this->cartService->getCart(),
            };

            return response()->json($cart);
        } catch (CartException $e) {
            return response()->json(array_merge(['error' => $e->getMessage()], $e->context), 422);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->loanService->store([
                'user_id' => auth()->id(),
                'borrower_name' => $request->borrower_name,
                'borrower_phone' => $request->borrower_phone,
                'borrower_address' => $request->borrower_address,
                'loan_date' => $request->loan_date,
                'return_plan' => $request->return_plan,
            ]);

            return redirect()->route('operator.loan')->with('success', 'Peminjaman berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
