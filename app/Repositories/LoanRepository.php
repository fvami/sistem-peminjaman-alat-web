<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Repositories\Contracts\LoanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LoanRepository implements LoanRepositoryInterface
{
    public function create(array $data): Loan
    {
        return Loan::create($data);
    }

    public function addDetail(Loan $loan, int $toolId, int $qty): void
    {
        LoanDetail::create([
            'loan_id' => $loan->id,
            'tool_id' => $toolId,
            'qty' => $qty,
        ]);
    }

    public function findManyWithDetails(array $ids): Collection
    {
        return Loan::whereIn('id', $ids)->with('details.tool')->get();
    }
}
