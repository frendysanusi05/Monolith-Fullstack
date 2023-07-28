<?php

namespace App\Http\Controllers\KatalogBarang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;

class KatalogController extends Controller
{
    public function index(Request $request) {
        return view('katalog-barang.index');
    }

    public function detail(Request $request, $id) {
        return view('katalog-barang.detail', compact('id'));
    }

    public function getBarang(Request $request) {
        if ($request->ajax()) {
            $response = Http::get(env('SINGLE_SERVICE_API_URL') . "barang");
            $response = $response->json();
            $response = $response['data'];
            return DataTables::of($response)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function getDetailBarang(Request $request, $id) {
        if ($request->ajax()) {
            $response = Http::get(env('SINGLE_SERVICE_API_URL') . "barang");
            $response = $response->json();
            $response = $response['data'];
            $data = collect($response)->where('id', $id)->values()->all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    // public function pollItems(Request $request) {
    //     $response = Http::get(env('SINGLE_SERVICE_API_URL') . "barang");
    //     $responseData = $response->json();
    //     $data = $responseData['data'];

    //     $latestData = collect($data)->values()->all();

    //     while (true) {
    //         $response = Http::get(env('SINGLE_SERVICE_API_URL') . "barang");
    //         $responseData = $response->json();
    //         $data = $responseData['data'];
    //         $currentData = collect($data)->values()->all();
            
    //         if ($currentData != $latestData) {
    //             $latestData = $currentData;
    //             return view('katalog-barang.index');
    //         }

    //         // Jeda polling setiap 1 detik
    //         sleep(5);
    //     }
    // }
}
