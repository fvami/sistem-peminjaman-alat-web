<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanDetailController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['details.tool.category'])->latest()->get();
        return view('admin.pages.loan_detail.index', compact('loans'));
    }

    public function updateStatus(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:borrowed,returned',
        ]);

        if ($loan->status === $request->status) {
            return back()->with('info', 'Status sudah sesuai.');
        }

        try {
            DB::transaction(function () use ($request, $loan) {
                foreach ($loan->details as $detail) {
                    if ($request->status === 'returned') {
                        $detail->tool->increment('stock', $detail->qty);
                    } else {
                        $detail->tool->decrement('stock', $detail->qty);
                    }
                }

                $loan->update(['status' => $request->status]);
            });

            return back()->with('success', 'Status transaksi #' . $loan->id . ' berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
