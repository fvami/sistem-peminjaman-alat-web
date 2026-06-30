<?php

namespace App\Services;

use App\Exceptions\CartException;
use App\Models\Loan;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\LoanRepositoryInterface;
use App\Repositories\Contracts\ToolRepositoryInterface;
use Illuminate\Support\Facades\DB;


// app/Services/LoanService.php
class LoanService
{
    public function __construct(
        protected LoanRepositoryInterface $loanRepository,
        protected ToolRepositoryInterface $toolRepository,
        protected CartRepositoryInterface $cartRepository
    ) {}

    public function store(array $borrowerData): Loan
    {
        $cart = $this->cartRepository->get();

        if (empty($cart)) {
            throw new CartException('Keranjang masih kosong!');
        }

        $loan = DB::transaction(function () use ($borrowerData, $cart) {
            $loan = $this->loanRepository->create($borrowerData);

            foreach ($cart as $item) {
                $tool = $this->toolRepository->findForUpdate($item['tool_id']);

                if ($tool->stock < $item['qty']) {
                    throw new \Exception("Stok alat '{$tool->name}' tiba-tiba tidak mencukupi.");
                }

                $this->loanRepository->addDetail($loan, $item['tool_id'], $item['qty']);
                $this->toolRepository->decrementStock($tool, $item['qty']);
            }

            return $loan;
        });

        $this->cartRepository->clear();

        return $loan;
    }
}
