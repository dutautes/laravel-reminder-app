@extends('templates.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Pengaturan Profil</h2>

        @if (Session::get('failed'))
            <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 text-center">
                <img src="{{ $user->profilePhotoUrl() }}" alt="Profile" width="120" class="rounded-circle mb-2">
                <div>
                    <input type="file" name="profile_photo" class="form-control w-auto d-inline">
                </div>
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
            </div>

            <div class="mb-3">
                <label>Headline</label>
                <input type="text" name="headline" class="form-control" value="{{ old('headline', $user->headline) }}">
            </div>

            <div class="mb-3">
                <label>Tentang</label>
                <textarea name="about" class="form-control" rows="3">{{ old('about', $user->about) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Password Baru (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="form-control">
                <input type="password" name="password_confirmation" class="form-control mt-2"
                    placeholder="Konfirmasi password">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

        <hr class="my-5">

        <form action="{{ route('user.delete_account') }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus akun? Ini tidak bisa dibatalkan!')">
            @csrf
            @method('DELETE')

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-danger">Hapus Akun</button>
        </form>
    </div>
@endsection
