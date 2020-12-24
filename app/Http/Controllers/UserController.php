<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = DB::table('users')
                        ->join('role','role.id','=','users.role_id')
                        ->whereNull('users.deleted_at')
                        ->select(['role.nama as nama_role','users.*'])
                        ->get();

        return view('user.index',$data);
    }

    public function tambah()
    {
        $data['role'] = DB::table('role')->get();

        return view('user.tambah',$data);
    }

    public function tambahProcess(Request $request)
    {
        $request->validate([
            "nama" => 'required|string',
            "email" => 'required|email',
            "password" => 'required|string',
            "role" => 'required|numeric'
        ]);
        
        DB::table('users')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);

        return redirect()->route('user.index')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function ubah($id)
    {
        $data['user'] = DB::table('users')->where('id',$id)->first();
        $data['role'] = DB::table('role')->get();

        return view('user.ubah',$data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "nama" => 'required|string',
            "email" => 'required|email|unique:users,email,'.$id,
            "password" => 'required|string',
            "role" => 'required|numeric'
        ]);

        $data = [];
        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['role_id'] = $request->role;
        if($request->password) $data['password'] = Hash::make($request->password);
        
        DB::table('users')->where('id', '=', $id)->update($data);
        
        return redirect()->route('user.index')->with('status', 'Data Berhasil Di Perbaharui');
    }

    public function hapus($id)
    {
        DB::table('users')->where('id', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);

        return redirect()->route('user.index')->with('status', 'Data Berhasil Di Hapus');
    }
}
