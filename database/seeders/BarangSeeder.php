<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['barang_id' => 1,'kategori_id' => 1,'barang_kode' => 'B01','barang_nama' => 'Uniqlo','harga_beli' => 10000, 'harga_jual' => 12000],
            ['barang_id' => 2,'kategori_id' => 2,'barang_kode' => 'C01','barang_nama' => 'Levi\'s Jeans','harga_beli' => 150000, 'harga_jual' => 180000],
            ['barang_id' => 3,'kategori_id' => 3,'barang_kode' => 'T01','barang_nama' => 'Topi New Era','harga_beli' => 50000, 'harga_jual' => 70000],
            ['barang_id' => 4,'kategori_id' => 4,'barang_kode' => 'S01','barang_nama' => 'Sepatu Nike Air Force 1','harga_beli' => 1000000, 'harga_jual' => 1200000],
            ['barang_id' => 5,'kategori_id' => 5,'barang_kode' => 'TA02','barang_nama' => 'Tas Gucci','harga_beli' => 20000000, 'harga_jual' => 25000000],
            ['barang_id' => 6,'kategori_id' => 1,'barang_kode' => 'B02','barang_nama' => 'H&M Dress','harga_beli' => 80000, 'harga_jual' => 100000],
            ['barang_id' => 7,'kategori_id' => 2,'barang_kode' => 'C02','barang_nama' => 'Adidas Jogger Pants','harga_beli' => 120000, 'harga_jual' => 150000],
            ['barang_id' => 8,'kategori_id' => 3,'barang_kode' => 'T02','barang_nama' => 'Topi Snapback','harga_beli' => 30000, 'harga_jual' => 40000],
            ['barang_id' => 9,'kategori_id' => 4,'barang_kode' => 'S02','barang_nama' => 'Sepatu Converse Chuck Taylor','harga_beli' => 500000, 'harga_jual' => 600000],
            ['barang_id' => 10,'kategori_id' => 5,'barang_kode' => 'TA02','barang_nama'=>'Tas Jansport','harga_beli' => 300000, 'harga_jual' => 400000]

        ];
        DB::table('m_barang')->insert($data);
    }
}
