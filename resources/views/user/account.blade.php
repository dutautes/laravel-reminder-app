@extends('templates.app')

@section('content')
    <div class="container py-4">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <div class="row">
            @include('user.sidebar')

            <div class="col-md-9">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Ubah Email</h5>
                        <form action="{{ route('user.update_email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Baru</label>
                                <input type="email" name="email"
                                    class="form-control @error('email')
                                    is-invalid
                                @enderror"
                                    placeholder="{{ Auth::user()->email }}">
                                @error('email')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                                <small class="text-muted">Email akan berubah setelah Anda menekan tombol.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Email</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Ubah Password</h5>
                        <div class="alert alert-warning py-2 small">Isi jika Anda ingin mengubah password.</div>

                        <form action="{{ route('user.update_password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Password Baru *</label>
                                <input type="password" name="password"
                                    class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                    placeholder="Masukkan password baru">
                                @error('password')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru *</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password')
                                    is-invalid
                                    @enderror"
                                    placeholder="Konfirmasi password">
                                @error('password')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Password</button>
                        </form>

                        <hr class="my-4">

                        <form action="{{ route('user.delete_account') }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus akun? Ini tidak bisa dibatalkan!')">
                            @csrf
                            @method('DELETE')

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-danger">Hapus Akun</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
