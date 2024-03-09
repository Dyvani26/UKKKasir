<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Categori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Barang::all();
        return view('dashboard.barang',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Categori::all();
        return view('dashboard.data_barang.create',['data'=> $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_user' => 'required',
            'id_categori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'jml_terjual' => 'required'
        ]);
        $imageName = time().'.'.$request->photo->extension();
        $request->photo->storeAs('public', $imageName);
        $validasi['photo'] = $imageName;

        $simpan = Barang::create($validasi);
        return redirect('/data/barang')->with('success','Record inserted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data =Barang::findOrFail($id);
        $categori=Categori::all();
        return view('dashboard.data_barang.edit',['data'=> $data,'categori'=>$categori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'id_user' => 'required',
            'id_categori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'jml_terjual' => 'required'
        ]);
        $data = Barang::findOrFail($id);
        if ($data->photo) {
            \Storage::delete(['file', $data->photo]);
        }
        $imageName = time().'.'.$request->photo->extension();
        $request->photo->storeAs('public', $imageName);
        $validasi['photo'] = $imageName;
        $data->update($validasi);

        return redirect('/data/barang')->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =Barang::findOrFail($id);
        $data->delete();
        return redirect('/data/barang')->with('success','Record deleted successfully!');
    }
    public function tambah_stok(Request $request)
    {
        $id = $request->input('id');
        $tambah_stok = $request->input('tambah_stok');
        $data = Barang::findOrFail($id);
        // Tambahkan jumlah stok yang baru
        $data->stok += $tambah_stok;

        // Simpan perubahan
        $data->save();
        return redirect('/data/barang')
        ->with('success', 'Stok Added successfully!');
    }
    public function laporan_barang()
    {
        $data = Barang::all();

        return view('dashboard.data_barang.laporan_barang',['data' => $data]);
    }
    public function cetak_barang(Request $request)
    {
        $bulan_tahun = $request->input('bulan_tahun');

        list($bulan, $tahun) = explode('-', $bulan_tahun);

        $results = Barang::whereYear('created_at', $tahun)
                            ->whereMonth('created_at', $bulan)
                            ->get();
        return view('dashboard.pdf.laporan_barang',['data' => $results,'bulan_tahun' => $bulan_tahun]);
    }
}
