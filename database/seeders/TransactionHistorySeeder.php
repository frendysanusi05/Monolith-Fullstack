<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionHistory;

class TransactionHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionHistory::create([
            'item_name'     =>  'Buku Tulis',
            'amount'        =>  2,
            'total_price'   =>  20000,
            'buyers_id'     =>  1,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Gambar',
            'amount'        =>  1,
            'total_price'   =>  15000,
            'buyers_id'     =>  1,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Tulis',
            'amount'        =>  10,
            'total_price'   =>  100000,
            'buyers_id'     =>  1,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Gambar',
            'amount'        =>  3,
            'total_price'   =>  45000,
            'buyers_id'     =>  1,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Kotak Kecil',
            'amount'        =>  2,
            'total_price'   =>  50000,
            'buyers_id'     =>  1,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Kotak Kecil',
            'amount'        =>  1,
            'total_price'   =>  25000,
            'buyers_id'     =>  2,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Tulis',
            'amount'        =>  5,
            'total_price'   =>  50000,
            'buyers_id'     =>  2,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Gambar',
            'amount'        =>  4,
            'total_price'   =>  60000,
            'buyers_id'     =>  2,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Kotak Kecil',
            'amount'        =>  20,
            'total_price'   =>  500000,
            'buyers_id'     =>  2,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Gambar',
            'amount'        =>  10,
            'total_price'   =>  150000,
            'buyers_id'     =>  2,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Tulis',
            'amount'        =>  1,
            'total_price'   =>  10000,
            'buyers_id'     =>  1,
        ]);

        TransactionHistory::create([
            'item_name'     =>  'Buku Mewarnai',
            'amount'        =>  1,
            'total_price'   =>  20000,
            'buyers_id'     =>  1,
        ]);
    }
}
