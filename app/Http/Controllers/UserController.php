<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel; // class laravel excel
use Yajra\DataTables\Facades\DataTables; // class laravel yajra : datatables

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
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
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:8'
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'name.min' => 'Nama wajib diisi minimal 3 huruf',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email wajib diisi dengan data yang valid',
                'password.required' => 'Password wajib di isi!',
                'password.min' => 'Password minimal 8 karakter!'
            ]
        );

        $createUser = User::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        if ($createUser) {
            return redirect()->route('admin.users.index')->with('success', "Data user berhasil ditambahkan");
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data pengguna');
        }
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
    public function edit(User $user, $id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama wajib diisi minimal 3 huruf',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email wajib diisi dengan data yang valid',
            'password.min' => 'Password minimal 8 karakter',
            'password.nullable' => 'Password boleh dikosongkan'
        ]);

        $updateUser = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($updateUser) {
            return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate data user');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteUser = User::where('id', $id)->delete();
        if ($deleteUser) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil menghapus data user');
        } else {
            return redirect()->back()->with('success', 'Gagal menghapus data user!');
        }
    }

    public function trash()
    {
        $userTrash = User::onlyTrashed()->get();
        return view('admin.user.trash', compact('userTrash'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.users.index')->with('success', 'Berhasil mengembalikan data user');
    }

    public function deletePermanent($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus data secara permanen!');
    }

    public function signUp(Request $request)
    {
        // (Request $request) : class untuk mengambil value dari formulir
        // validasi = validate();
        $request->validate(
            [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'email' => 'required|email:dns',
                'password' => 'required|min:8'
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
            ]
        );

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

    public function loginAuth(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email harus di isi',
                'password.required' => "Password harus di isi"
            ]
        );

        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil login!');
            } else {
                return redirect()->route('dashboard')->with('success', 'Berhasil login!');
            }
            return redirect()->route('dashboard')->with('success', 'Berhasil login!');
        } else {
            return redirect()->back()->with('error', 'Gagal login! pastikan data sudah sesuai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('logout', 'Berhasil logout!, silahkan login kembali untuk akses lengkap');
    }

    public function export()
    {
        $fileName = 'data-user-reminder.xlsx';
        return Excel::download(new UserExport, $fileName);
    }
}
