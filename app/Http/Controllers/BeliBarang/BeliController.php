<?php

namespace App\Http\Controllers\BeliBarang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;

class BeliController extends Controller
{
    public function index(Request $request, $id) {
        return view('beli-barang.index', compact('id'));
    }

    public function getIdentitasBarang(Request $request, $id) {
        if ($request->ajax()) {
            $response = Http::get(env('SINGLE_SERVICE_API_URL') . "barang");
            $response = $response->json();
            $response = $response['data'];
            $data = collect($response)->where('id', $id)->values()->all();

            foreach ($data as &$row) {
                $jumlah = isset($row['jumlah']) ? $row['jumlah'] : 1;
                $harga = $row['harga'];
                $total = $jumlah * $harga;
                $row['total'] = $total;
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('jumlah', function($row) {
                    return '<input type="number" name="jumlah" placeholder="1" id="item-jumlah">';
                })
                ->addColumn('total', function ($row) {
                    $jumlah = $row['jumlah'] ?? 1;
                    $harga = $row['harga'];
                    return $jumlah * $harga;
                })
                ->rawColumns(['jumlah'])
                ->make(true);
        }
    }
}
