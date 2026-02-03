<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LoanExport;
use Maatwebsite\Excel\Facades\Excel;

class LoanDetailController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['details.tool.category'])->latest()->get();
        return view('admin.pages.loan_detail.index', compact('loans'));
    }

    public function export(Request $request)
    {
        $ids = $request->input('ids') ? explode(',', $request->ids) : null;

        $fileName = 'Laporan_Peminjaman_' . now()->format('d-m-Y_His') . '.xlsx';

        return Excel::download(new LoanExport($ids), $fileName);
    }

    public function updateStatus(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:borrowed,returned',
        ]);

        try {
            DB::transaction(function () use ($request, $loan) {
                foreach ($loan->details as $detail) {
                    if ($request->status === 'returned' && $loan->status !== 'returned') {
                        $detail->tool->increment('stock', $detail->qty);
                    } elseif ($request->status === 'borrowed' && $loan->status !== 'borrowed') {
                        $detail->tool->decrement('stock', $detail->qty);
                    }
                }
                $loan->update(['status' => $request->status]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Status transaksi berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Loan $loan)
    {
        $loan->details()->delete();
        $loan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
