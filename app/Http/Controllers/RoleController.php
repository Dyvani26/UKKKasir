<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Akses;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=role::all();
        return view('dashboard.data_role',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=User::all();
        $akses=Akses::all();
        return view('dashboard.data_role.create',['user'=>$user,'akses'=>$akses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validasi =$request->validate([
            'id_user' => 'required',
            'id_akses' => 'required'
        ]);
        $data=Role::create($validasi);
        return redirect('/data/role')->with('success','Record inserted successfully!');
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
        $data =Role::findOrFail($id);
        $user=User::all();
        $akses=Akses::all();
        return view('dashboard.data_role.edit',['data'=> $data,'user'=>$user,'akses'=>$akses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Role::findOrFail($id);
        $validasi = $request->validate([
            'id_user'=> 'required',
            'id_akses'=>'required'
        ]);

        $data->update($validasi);

        return redirect('/data/role')->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =Role::findOrFail($id);
        $data->delete();
        return redirect('/data/role')->with('success','Record deleted successfully!');
    }
}
