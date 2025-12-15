<?php

namespace App\Exports;

use App\Models\Organisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrganisasisExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        $query = Organisasi::query();

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
            'Nama',
            'Nama Organisasi',
            'Alamat',
            'No. Telepon',
            'Email',
            'Tanggal Dibuat'
        ];
    }

    /**
     * Mapping data ke kolom
     */
    public function map($organisasi): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $organisasi->nama,
            $organisasi->nama_organisasi,
            $organisasi->alamat,
            $organisasi->no_telpon,
            $organisasi->email,
            $organisasi->created_at->format('d-m-Y H:i')
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