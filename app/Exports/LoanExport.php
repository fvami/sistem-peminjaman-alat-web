<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $ids;

    public function __construct($ids = null)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        $query = Loan::with(['details.tool']);

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'No. Telepon',
            'Alamat',
            'Tanggal Pinjam',
            'Estimasi Kembali',
            'Status',
            'Detail Alat'
        ];
    }

    public function map($loan): array
    {
        $toolDetails = $loan->details->map(function ($detail) {
            return "- " . ($detail->tool->name ?? 'Alat Dihapus') . " (" . $detail->qty . " unit)";
        })->implode("\n");

        return [
            $loan->id,
            $loan->borrower_name,
            $loan->borrower_phone,
            $loan->borrower_address ?: '-',
            \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y'),
            \Carbon\Carbon::parse($loan->return_plan)->format('d/m/Y'),
            strtoupper($loan->status),
            $toolDetails
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        $sheet->getStyle('H')->getAlignment()->setWrapText(true);

        $sheet->getStyle('A:H')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->getColumnDimension('H')->setWidth(40);
    }
}
