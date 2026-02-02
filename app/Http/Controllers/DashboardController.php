<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Category;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTools = Tool::count();
        $totalCategories = Category::count();

        $activeLoans = Loan::where('status', 'borrowed')->count();

        $topTools = LoanDetail::select('tool_id', DB::raw('SUM(qty) as total_borrowed'))
            ->with('tool')
            ->groupBy('tool_id')
            ->orderByDesc('total_borrowed')
            ->take(5)
            ->get();

        $recentLoans = Loan::with('details')->latest()->take(5)->get();

        return view('admin.pages.dashboard.index', compact(
            'totalTools',
            'totalCategories',
            'activeLoans',
            'topTools',
            'recentLoans'
        ));
    }
}
