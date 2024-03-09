<?php

namespace App\Http\Controllers;
use App\Models\Dashboard;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $penjualan = Penjualan::count();
        $petugas = User::count();
        $pelanggan = DetailPenjualan::distinct('nama_pemesan')->count();
        $barang = Barang::count();
        $totalPenjualan = Penjualan::where('status','=','bayar')->sum('total_harga');
        $totalDiskon = Penjualan::where('status','=','bayar')->sum('diskon');
        $totalBatal = Penjualan::where('status','!=','bayar')->sum('total_harga');
        $stokTersedia = Barang::sum('stok');
        return view('dashboard.dashboard',[
            'penjualan' => $penjualan,
            'petugas' => $petugas,
            'pelanggan' => $pelanggan,
            'barang' => $barang,
            'totalPenjualan' => $totalPenjualan,
            'totalDiskon' => $totalDiskon,
            'totalBatal' => $totalBatal,
            'stokTersedia' => $stokTersedia
        ]);;
    }
}
