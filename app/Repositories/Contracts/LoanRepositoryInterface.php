<?php

namespace App\Repositories\Contracts;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;

interface LoanRepositoryInterface
{
    public function create(array $data): Loan;
    public function addDetail(Loan $loan, int $toolId, int $qty): void;
    public function findManyWithDetails(array $ids): Collection;
}
