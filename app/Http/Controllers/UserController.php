<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar semua user
    public function index()
    {
        // Ambil semua data user dari database
        $users = User::all();

        // Kirim data ke tampilan (View)
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|string|in:user,admin,super_admin,ambulan,sierujukan,nakes,atem,ka,lab,rs,puskesmas,klinik',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat!');
    }
}
