<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 3, 'pembeli' => 'Dena', 'penjual_code' => 'PJL001', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 2, 'user_id' => 3, 'pembeli' => 'Budi', 'penjual_code' => 'PJL002', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Ani', 'penjual_code' => 'PJL003', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 4, 'user_id' => 3, 'pembeli' => 'Citra', 'penjual_code' => 'PJL004', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 5, 'user_id' => 3, 'pembeli' => 'Doni', 'penjual_code' => 'PJL005', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Eko', 'penjual_code' => 'PJL006', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 7, 'user_id' => 3, 'pembeli' => 'Fitri', 'penjual_code' => 'PJL007', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 8, 'user_id' => 3, 'pembeli' => 'Gina', 'penjual_code' => 'PJL008', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Hendra', 'penjual_code' => 'PJL009', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 10, 'user_id' => 3, 'pembeli' => 'Ira', 'penjual_code' => 'PJL010', 'penjualan_tanggal' => now()],

        ];
        DB::table('t_penjualan')->insert($data);

    }
}
