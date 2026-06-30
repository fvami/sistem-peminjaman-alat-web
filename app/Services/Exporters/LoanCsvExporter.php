<?php

namespace App\Services\Exporters;

use App\Services\Contracts\LoanExporterInterface;
use Illuminate\Database\Eloquent\Collection;

class LoanCsvExporter implements LoanExporterInterface
{
    public function export(Collection $loans): string
    {
        $columns = ['Nama Peminjam', 'Telepon', 'Tgl Pinjam', 'Tgl Kembali', 'Alamat', 'Alat'];

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $columns);

        foreach ($loans as $loan) {
            $tools = $loan->details->map(fn($d) => $d->tool->name . ' (' . $d->qty . ')')->implode('; ');

            fputcsv($handle, [
                $loan->borrower_name,
                $loan->borrower_phone,
                $loan->loan_date,
                $loan->return_plan,
                $loan->borrower_address,
                $tools,
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $csv;
    }
}
