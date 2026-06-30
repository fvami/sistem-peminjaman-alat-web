<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface LoanExporterInterface
{
    public function export(Collection $loans): string;
}