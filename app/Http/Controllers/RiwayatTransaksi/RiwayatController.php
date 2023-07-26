<?php

namespace App\Http\Controllers\RiwayatTransaksi;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use DataTables;

class RiwayatController extends Controller
{
    public function index(Request $request) {
        $id = auth()->user()->id;
        return view('riwayat-transaksi.index', compact('id'));
    }

    public function getRiwayat(Request $request, $id) {
        if ($request->ajax()) {
            $response = TransactionHistory::get();
            $data = collect($response)->where('buyers_id', $id)->values()->all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
