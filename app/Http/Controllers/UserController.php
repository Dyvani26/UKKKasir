<?php

namespace App\Http\Controllers;
use App\Models\DetailUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =User::all();
        return view('dashboard.petugas',['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.data_petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =$request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
            //add more validation rules for other columns
        ]);
        //berfungsi untuk mengenkripsi
        $validatedData['password'] = Hash::make($validatedData['password']);
        //berfungsi untuk memvalidasi data detail user
        $validasiDetailUser = $request->validate([
            'nama_lengkap'=>'required',
            'tgl_lahir'=>'required'
        ]);
        //create a new record using the validatedata
        $data =user::create($validatedData);
        //memanggil id dari users dan di simpan di detaiUser
        $dataid_user =$data ->id;
        $detailUser = new DetailUser($validasiDetailUser);
        $detailUser->id_user =$dataid_user;
        $detailUser -> save();

        //flash a success message to the session
        return redirect('/data/petugas')->with('success','Record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::findOrFail($id);
        $tgl_lahir = Carbon::parse($data->detailUser->tgl_lahir);
        $umur = $tgl_lahir->age;
        return view('dashboard.profile', ['data' => $data,'umur'=>$umur]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data =User::findOrFail($id);
        return view('dashboard.data_petugas.edit',['data'=> $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =$request->validate([
            'name' => 'required',
            'email' => 'required',

            //add more validation rules for other columns
        ]);

        //berfungsi untuk memvalidasi data detail user
        $validasiDetailUser = $request->validate([
            'nama_lengkap'=>'required',
            'tgl_lahir' => 'required',
            'nik' => '',
            'alamat' => '',
            'no_tlfn' => '',
        ]);
        //mencari record yang di rubah
        $data =user::findOrFail($id);
        //proses ubah data table user
        $data ->update($validatedData);
        //mencari record yang dirubah di table detail user
        $detailUser = DetailUser::where('id_user',$id)->first();
        //update data detail yser
        $detailUser -> update($validasiDetailUser);

        //flash a success message to the session
        return redirect('/data/petugas')->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataDetail=DetailUser::where('id_user',$id);
        $dataDetail->delete();
        $data =User::findOrFail($id);
        $data->delete();
        return redirect('/data/petugas')->with('success','Record deleted successfully!');
    }
    public function update_profile(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            // Add more validation rules for other columns
        ]);
        // berfungsi untuk memvalidasi data detail user
        $validasiDetailUser = $request->validate([
            'nama_lengkap' => 'required',
            'tgl_lahir' => 'required',
            'nik' => '',
            'alamat' => '',
            'no_tlfn' => '',
        ]);
        // Mencari record yang dritubah
        $data = User::findOrFail($id);
        // proses ubah data table user
        $data->update($validatedData);
        // mencari record yang dirubah di table detail user
        $detailUser = DetailUser::where('id_user', $id)->first();
        // Update data detail user
        $detailUser->update($validasiDetailUser);

        // Flash a success message to the session
        return redirect()->route('petugas.show', ['id' => $id])->with('success', 'Record updated successfully!');
    }
    public function photo(Request $request,  string $id)
    {
        $user = User::findOrFail($id);

        $data =  $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Memastikan tipe file adalah gambar (jpeg, png, jpg, gif) dan ukurannya tidak lebih dari 2MB
        ]);
        // Memeriksa apakah gambar sudah ada sebelumnya
        if ($user->profile_photo != null) {
                // Hapus gambar yang sudah ada sebelumnya
                Storage::delete('public/photo/'.$user->profile_photo);
        }

        // Mengambil file gambar dari request
        $image = $request->file('profile_photo');

        // Menyimpan gambar ke dalam direktori 'public/posts' dengan nama file yang dihasilkan menggunakan hash dari konten gambar
        $path = $image->storeAs('public/photo', $image->hashName());

        $user->update(['profile_photo'=> $image->hashName()]);
        //Flash a success message to the session
        return redirect()->route('petugas.show', ['id' => $id])->with('success', 'Record updated successfully!');
    }
}
