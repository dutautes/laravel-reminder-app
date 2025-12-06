<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    // data sampah dari data user > admin
    public function trash()
    {
        $userTrash = User::onlyTrashed()->get();
        return view('admin.user.trash', compact('userTrash'));
    }

    // softdeletes restore() data user > admin
    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.users.index')->with('success', 'Berhasil mengembalikan data user');
    }

    // delete data user forceDelete() data user > admin
    public function deletePermanent($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus data secara permanen!');
    }

    // sign up
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

    // login authentication anjay
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
                // log activity
                $log = new UserActivity();
                $log->saveActivity(
                    'login',
                    'User melakukan login',
                    'User',
                    auth()->id()
                );
                return redirect()->route('dashboard')->with('success', 'Berhasil login!');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal login! pastikan data sudah sesuai');
        }
    }

    // logout
    public function logout()
    {
        $userId = auth()->id(); // simpan id sebelum logout

        // log activity
        $log = new UserActivity();
        $log->saveActivity(
            'logout',
            'User melakukan logout',
            'User',
            $userId
        );

        Auth::logout();

        return redirect()->route('home')->with('logout', 'Berhasil logout!, silahkan login kembali untuk akses lengkap');
    }

    // export Excel di data user > admin
    public function export()
    {
        $fileName = 'data-user-reminder.xlsx';
        return Excel::download(new UserExport, $fileName);
    }

    // datatables buat data user di dalam admin
    public function datatables()
    {
        $users = User::query();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role_badge', function ($user) {
                if ($user['role'] == 'admin') {
                    return '<span class="badge bg-primary">' . $user['role'] . '</span>';
                } else {
                    return '<span class="badge bg-secondary">' . $user['role'] . '</span>';
                }
            })
            ->addColumn('action', function ($user) {
                $btnEdit = '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-primary">Edit</a>';
                $btnDelete = '<form action="' . route('admin.users.delete', $user->id) . '" method="POST" style="display:inline-block">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>';

                return '<div class="d-flex justify-content-center align-items-center gap-2">' . $btnEdit . $btnDelete . '</div>';
            })
            ->rawColumns(['role_badge', 'action'])
            ->make(true);
    }

    // update email mandiri di account
    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate(
            [
                'email' => 'email:dns|unique:users,email,' . Auth::id() // Cek email di tabel users, pastikan email belum dipakai orang lain, kecuali user dengan ID ini (user yang lagi login).
            ],
            [
                'email.email' => 'Email wajib diisi dengan data yang valid',
                'email.unique' => 'Email sudah digunakan akun lain'
            ]
        );

        // Cek kalau email sama
        if ($request->email === $user->email) {
            return back()->with('error', 'Email tidak ada perubahan.');
        }

        $user->update([
            'email' => $request->email,
        ]);


        return back()->with('success', 'Berhasil mengubah akun email!');
    }

    // update password mandiri di account
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'min:8|confirmed',
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    // update profile
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id()); // ambil data user yang sedang login
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
                'headline' => 'nullable|string|max:255',
                'about' => 'nullable|string|max:1000',
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'username.unique' => 'Username sudah dipakai',
                'profile_photo.image' => 'File harus berupa gambar',
                'profile_photo.mimes' => 'Format gambar harus jpg/jpeg/png',
                'profile_photo.max' => 'Ukuran gambar maksimal 2MB',
            ]
        );

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'headline' => $request->headline,
            'about' => $request->about,
        ];

        // handle upload foto
        if ($request->hasFile('profile_photo')) {
            // hapus file lama kalo ada
            if ($user->profile_photo && Storage::disk('public')->exists('profile_photo')) {
                Storage::disk('public')->delete('profile_photo');
            }

            $filename = 'user-' . Auth::id() . '.' . $request->file('profile_photo')->getClientOriginalExtension(); // nama file foto
            $path = $request->file('profile_photo')->storeAs('profile_photos', $filename, 'public');
            $data['profile_photo'] = $path;
        }

        // Update
        $updated = User::where('id', $user->id)->update($data);

        if ($updated) {
            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada perubahan yang disimpan atau gagal menyimpan.');
        }
    }

    // hapus akun sendiri
    public function deleteAccount(Request $request)
    {
        $request->validate(
            [
                'password' => 'required',
            ],
            [
                'password.required' => 'Masukan password untuk konfirmasi'
            ]
        );

        $user = User::find(Auth::id());
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }


        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Password salah.']);
        }

        // hapus foto profil kalau ada
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Delete user
        $deleted = User::destroy($user->id);

        if ($deleted) {
            Auth::logout();
            return redirect('/')->with('success', 'Akun berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus akun, coba lagi.');
        }
    }

    // profile
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // ini pengaturan akun di profile
    public function account()
    {
        $user = Auth::user();
        return view('user.account', compact('user'));
    }

    // data chartbar di admin
    public function chartData()
    {
        $chartData = User::withCount('reminders')->get(); // menghitung jumlah reminder yang dimiliki oleh masing masing user

        $labels = $chartData->pluck('name'); // pluck() : ambil seluruh data dari field yang dituju
        $data = $chartData->pluck('reminders_count');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
