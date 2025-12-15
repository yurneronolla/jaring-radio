<?php

namespace App\Exports;

use App\Models\Radio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RadiosExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $year;

    public function __construct($year = null)
    {
        $this->year = $year;
    }

    /**
     * Ambil data yang akan di-export
     */
    public function collection()
    {
        $query = Radio::with('provinsi');

        // Filter berdasarkan tahun jika ada
        if ($this->year) {
            $query->whereYear('created_at', $this->year);
        }

        return $query->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Provinsi',
            'Nama',
            'Nama Radio',
            'Alamat',
            'No. Telepon',
            'Email',
            'Tanggal Dibuat'
        ];
    }

    /**
     * Mapping data ke kolom
     */
    public function map($radio): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $radio->provinsi->nama ?? '-',
            $radio->nama,
            $radio->nama_radio,
            $radio->alamat,
            $radio->no_telpon,
            $radio->email,
            $radio->created_at->format('d-m-Y H:i')
        ];
    }

    /**
     * Styling Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}