<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $tools = Tool::where('status', 'available')
            ->where('stock', '>', 0)
            ->get();
        $cart = session('cart', []);

        return view('admin.pages.loan.index', compact('tools', 'cart'));
    }

    public function exportExcel(Request $request)
    {
        $ids = explode(',', $request->ids);
        $loans = Loan::whereIn('id', $ids)->with('details.tool')->get();
        $fileName = 'rekap-peminjaman-' . date('Y-m-d') . '.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Nama Peminjam', 'Telepon', 'Tgl Pinjam', 'Tgl Kembali', 'Alamat', 'Alat');

        $callback = function () use ($loans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($loans as $loan) {
                $tools = $loan->details->map(function ($d) {
                    return $d->tool->name . ' (' . $d->qty . ')';
                })->implode('; ');

                fputcsv($file, array(
                    $loan->borrower_name,
                    $loan->borrower_phone,
                    $loan->loan_date,
                    $loan->return_plan,
                    $loan->borrower_address,
                    $tools
                ));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cart(Request $request)
    {
        $cart = session('cart', []);
        $tool = Tool::find($request->tool_id);

        if (!$tool || $tool->status !== 'available') {
            return response()->json(['error' => 'Alat tidak tersedia atau sudah tidak aktif.'], 422);
        }

        if ($request->action == 'add') {
            $currentQtyInCart = isset($cart[$tool->id]) ? $cart[$tool->id]['qty'] : 0;

            if ($tool->stock < ($currentQtyInCart + 1)) {
                return response()->json(['error' => 'Stok tidak mencukupi!'], 422);
            }

            if (isset($cart[$tool->id])) {
                $cart[$tool->id]['qty']++;
            } else {
                $cart[$tool->id] = [
                    'tool_id' => $tool->id,
                    'name' => $tool->name,
                    'qty' => 1
                ];
            }
        }

        if ($request->action == 'update') {
            $requestedQty = max(1, intval($request->qty));

            if ($tool->stock < $requestedQty) {
                return response()->json([
                    'error' => 'Hanya tersedia ' . $tool->stock . ' unit.',
                    'max_stock' => $tool->stock
                ], 422);
            }

            if (isset($cart[$tool->id])) {
                $cart[$tool->id]['qty'] = $requestedQty;
            }
        }

        if ($request->action == 'remove') {
            unset($cart[$request->tool_id]);
        }

        session(['cart' => $cart]);
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        try {
            DB::transaction(function () use ($request, $cart) {
                $loan = Loan::create([
                    'user_id' => auth()->id(),
                    'borrower_name' => $request->borrower_name,
                    'borrower_phone' => $request->borrower_phone,
                    'borrower_address' => $request->borrower_address,
                    'loan_date' => $request->loan_date,
                    'return_plan' => $request->return_plan,
                ]);

                foreach ($cart as $item) {
                    $tool = Tool::lockForUpdate()->find($item['tool_id']);

                    if ($tool->stock < $item['qty']) {
                        throw new \Exception("Stok alat '{$tool->name}' tiba-tiba tidak mencukupi.");
                    }

                    LoanDetail::create([
                        'loan_id' => $loan->id,
                        'tool_id' => $item['tool_id'],
                        'qty' => $item['qty'],
                    ]);

                    $tool->decrement('stock', $item['qty']);
                }
            });

            session()->forget('cart');
            return redirect()->route('operator.loan')->with('success', 'Peminjaman berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
