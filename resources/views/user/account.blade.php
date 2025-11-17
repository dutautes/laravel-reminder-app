@extends('templates.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            @include('user.sidebar')

            <div class="col-md-9">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Ubah Email</h5>
                        <form action="{{ route('user.update_profile') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Baru</label>
                                <input type="email" name="email" class="form-control" placeholder="email@domain.com">
                                <small class="text-muted">Email akan berubah setelah Anda menekan link verifikasi yang
                                    dikirimkan.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Email</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Ubah Password</h5>
                        <div class="alert alert-warning py-2 small">Isi jika Anda ingin mengubah password.</div>

                        <form action="{{ route('user.update_profile') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Password Baru *</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password baru">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru *</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Konfirmasi password">
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
