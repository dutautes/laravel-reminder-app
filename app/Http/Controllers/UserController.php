<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function signUp(Request $request)
    {
        // (Request $request) : class untuk mengambil value dari formulir
        // validasi = validate();
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' =>'required|min:8'
        ],
        [
            // pesan custom error
            // 'name_input.validasi' => 'person'1
            'first_name.required' => 'Nama depan wajib diisi',
            'first_name.min' => 'Nama depan wajib diisi minimal 3 huruf',
            'last_name.required' => 'Nama belakang wajib diisi',
            'last_name.min' => 'Nama belakang wajib diisi minimal 3 huruf',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email wajib diisi dengan data yang valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password wajib diisi minimal 8 huruf',
        ]);

        $createUser = User::create([
            'name' => $request->first_name . " " . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        if ($createUser) {
            return redirect()->route('login')->with('success', 'Silahkan login!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    public function loginAuth(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email harus di isi',
            'password.required' => "Password harus di isi"
        ]);

        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil login!');
            } else {
                return redirect()->route('home')->with('success', 'Berhasil login!');
            }
            return redirect()->route('home')->with('success', 'Berhasil login!');
        } else {
            return redirect()->back()->with('error', 'Gagal login! pastikan data sudah sesuai');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home')->with('logout', 'Berhasil logout!, silahkan login kembali untuk akses lengkap');
    }
}
