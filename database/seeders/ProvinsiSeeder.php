<?php
// database/seeders/ProvinsiSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        $provinsis = [
            ['nama' => 'Aceh', 'kode' => 'ACH'],
            ['nama' => 'Sumatera Utara', 'kode' => 'SU'],
            ['nama' => 'Sumatera Barat', 'kode' => 'SB'],
            ['nama' => 'Riau', 'kode' => 'RI'],
            ['nama' => 'Kepulauan Riau', 'kode' => 'KR'],
            ['nama' => 'Jambi', 'kode' => 'JA'],
            ['nama' => 'Sumatera Selatan', 'kode' => 'SS'],
            ['nama' => 'Bangka Belitung', 'kode' => 'BB'],
            ['nama' => 'Bengkulu', 'kode' => 'BE'],
            ['nama' => 'Lampung', 'kode' => 'LA'],
            ['nama' => 'DKI Jakarta', 'kode' => 'JK'],
            ['nama' => 'Banten', 'kode' => 'BT'],
            ['nama' => 'Jawa Barat', 'kode' => 'JB'],
            ['nama' => 'Jawa Tengah', 'kode' => 'JT'],
            ['nama' => 'DI Yogyakarta', 'kode' => 'YO'],
            ['nama' => 'Jawa Timur', 'kode' => 'JI'],
            ['nama' => 'Bali', 'kode' => 'BA'],
            ['nama' => 'Nusa Tenggara Barat', 'kode' => 'NB'],
            ['nama' => 'Nusa Tenggara Timur', 'kode' => 'NT'],
            ['nama' => 'Kalimantan Barat', 'kode' => 'KB'],
            ['nama' => 'Kalimantan Tengah', 'kode' => 'KT'],
            ['nama' => 'Kalimantan Selatan', 'kode' => 'KS'],
            ['nama' => 'Kalimantan Timur', 'kode' => 'KI'],
            ['nama' => 'Kalimantan Utara', 'kode' => 'KU'],
            ['nama' => 'Sulawesi Utara', 'kode' => 'SA'],
            ['nama' => 'Sulawesi Tengah', 'kode' => 'ST'],
            ['nama' => 'Sulawesi Selatan', 'kode' => 'SN'],
            ['nama' => 'Sulawesi Tenggara', 'kode' => 'SG'],
            ['nama' => 'Gorontalo', 'kode' => 'GO'],
            ['nama' => 'Sulawesi Barat', 'kode' => 'SR'],
            ['nama' => 'Maluku', 'kode' => 'MA'],
            ['nama' => 'Maluku Utara', 'kode' => 'MU'],
            ['nama' => 'Papua', 'kode' => 'PA'],
            ['nama' => 'Papua Barat', 'kode' => 'PB'],
            ['nama' => 'Papua Selatan', 'kode' => 'PS'],
            ['nama' => 'Papua Tengah', 'kode' => 'PT'],
            ['nama' => 'Papua Pegunungan', 'kode' => 'PP'],
            ['nama' => 'Papua Barat Daya', 'kode' => 'PBD'],
        ];

        foreach ($provinsis as $provinsi) {
            Provinsi::create($provinsi);
        }
    }
}