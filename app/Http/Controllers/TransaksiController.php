<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $data= Penjualan::where('status','=','pesan')
        ->orderBy('created_at','desc')
        ->get();
        return view('dashboard.data_transaksi',['data'=>$data]);
    }
    public function detail_transaksi($id)
    {
        $list_barang = DetailPenjualan::where('id_penjualan','=',$id)->get();
        $data = Penjualan::all();
        return view('dashboard.data_transaksi.detail_transaksi',['data'=>$data,'list'=>$list_barang,'id'=>$id]);
    }
    public function bayar(Request $request,$id)
    {
        $data = Penjualan::findOrFail($id);
        $update = [
            'diskon' => $request->input('diskon'),
            'total' => $request->input('total'),
            'total_bayar' => $request->input('bayar'),
            'kembalian' => $request->input('kembalian'),
            'status' => 'bayar'
        ];
        $data->update($update);
        return redirect('/transaksi')->with('success','Berhasil Bayar !');
    }
    public function sudah_bayar()
    {
        $data= Penjualan::where('status','=','bayar')
        ->orderBy('created_at','desc')
        ->get();
        return view('dashboard.data_transaksi.transaksi_terbayar',['data'=>$data]);
    }
    public function nota($id)
    {
        //      // Konfigurasi Dompdf
    // $options = new Options();
    // $options->set('isRemoteEnabled', true);
    // $options->set('defaultFont', 'Arial');

    // // Set ukuran kertas
    // $options->set('size', array(0,0,204,650)); // Lebar 80 mm dan panjang 600 mm
    // $options->set('dpi', 72);
    // Inisialisasi Dompdf dengan konfigurasi yang ditetapkan
    // $dompdf = new Dompdf($options);
        $data_pembayaran= Penjualan::where('id','=',$id)
        ->orderBy('created_at','desc')
        ->get();
        $data_barang = DetailPenjualan::where('id_penjualan','=',$id)->get();
        $data = [
            'data_pembayaran' => $data_pembayaran,
            'data_barang' => $data_barang,
        ];
        return view('dashboard.pdf.invoice',$data);
        // $pdf = FacadePdf::loadView('dashboard.pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
    }
    public function laporan_transaksi()
    {
        $data = Penjualan::all();

        return view('dashboard.data_transaksi.laporan_transaksi',['data' => $data]);
    }

    public function cetak_transaksi(Request $request)
    {
        $bulan_tahun = $request->input('bulan_tahun');

        list($bulan, $tahun) = explode('-', $bulan_tahun);

        $results = Penjualan::whereYear('created_at', $tahun)
                            ->whereMonth('created_at', $bulan)
                            ->get();
        return view('dashboard.pdf.laporan_transaksi',['data' => $results,'bulan_tahun' => $bulan_tahun]);
    }
    public function destroy(string $id)
    {
        $data_penjualan = Penjualan::findOrFail($id);
        $data_detail_penjualan = DetailPenjualan::where('id_penjualan','=',$id);

        $data_detail_penjualan->delete();
        $data_penjualan->delete();
        $data= Penjualan::where('status','=','pesan')
        ->orderBy('created_at','desc')
        ->get();
        return view('dashboard.data_transaksi',['data'=>$data]);
    }


}
