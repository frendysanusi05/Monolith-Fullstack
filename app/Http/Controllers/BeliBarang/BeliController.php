<?php

namespace App\Http\Controllers\BeliBarang;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;
use GuzzleHttp\Client;

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
                    return '<input type="number" name="jumlah" id="item-jumlah">';
                })
                ->addColumn('total', function ($row) {
                    $jumlah = $row['jumlah'] ?? 1;
                    $harga = $row['harga'];
                    return $jumlah * $harga;
                })
                ->rawColumns(['jumlah', 'action'])
                ->make(true);
        }
    }

    public function transaction(Request $request, $id, $jumlah) {
        $response = Http::get(env('SINGLE_SERVICE_API_URL') . "barang");
        $response = $response->json();
        $response = $response['data'];
        $data = collect($response)->where('id', $id)->values()->all();

        foreach ($data as &$row) {
            $nama = $row['nama'];
            $harga = $row['harga'];
            $stok = $row['stok'];
            $kode = $row['kode'];
            $perusahaan_id = $row['perusahaan_id'];
        }

        $total = $jumlah * $harga;

        if ($stok - $jumlah < 0) {
            return redirect()->back()->with('status', 'Pembelian gagal! Stok barang tidak mencukupi');
        }

        /* bypass authorization */
        $client = new Client();

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2OTAzODQwOTEsInBhc3N3b3JkIjoicGFzc3dvcmQiLCJyb2xlIjoiYWRtaW4iLCJ1c2VybmFtZSI6ImFkbWluIn0.CMcrJ0mU4DCBNtuOiaJM0Ecrpe0KmQ14Mr0BZJhW6K4';
        $headers = [
            'Authorization' =>  $token,
        ];
        $url = env('SINGLE_SERVICE_API_URL') . "barang/" . $id;

        if ($stok - $jumlah == 0) {
            $response = $client->delete($url, ['headers' => $headers]);
        }

        if ($stok - $jumlah > 0) {
            $response = $client->put($url, [
                'headers'   =>  $headers,
                'form_params'      => [
                    'nama'          =>  $nama,
                    'harga'         =>  $harga,
                    'stok'          =>  $stok - $jumlah,
                    'kode'          =>  $kode,
                    'perusahaan_id' =>  $perusahaan_id,
                ],
            ]);
        }

        TransactionHistory::create([
            'item_name'     =>  $nama,
            'amount'        =>  $jumlah,
            'total_price'   =>  $total,
            'buyers_id'     =>  $id,
        ]);

        return redirect()->back()->with('status', 'Pembelian berhasil!');
    }
}
