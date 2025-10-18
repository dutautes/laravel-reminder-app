@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::get('failed'))
        <div class="alert alert-danger">
            {{ Session::get('failed') }}
        </div>
    @endif
    <div class="container mt-3">
        <div class="d-flex justify-content-end mb-3 mt-4">
            <a href="" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Data</a>
            <a href="{{ route('admin.users.trash') }}" class="btn btn-warning">Data Sampah</a>
        </div>

        <h3>Data Pengguna</h3>
        <table class="table table-bordered" id="usersTable">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    @if ($user['role'] == 'admin')
                        <td>
                            <span class="badge bg-primary">{{ $user['role'] }}</span>
                        </td>
                    @endif
                    @if ($user['role'] == 'user')
                        <td>
                            <span class="badge bg-secondary">{{ $user['role'] }}</span>
                        </td>
                    @endif
                    <td class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary mb-3">Edit</a>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- modal TAMBAH --}}
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAddLabel">Tambah Data User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- agar membungkus sampe modal-footer ke button kirim --}}
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama:</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid
                                @enderror"
                                    id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid

                                @enderror">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid

                                @enderror">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end of modal --}}
    </div>
@endsection

@push('stack')
    @if ($errors->any())
        <script>
            let modalAdd = document.querySelector("#modalAdd");
            // munculkan modal dengan JS
            new bootstrap.Modal(modalAdd).show();

            let modalEdit = document.querySelector("#modalEdit {{ $user->id }}");
            new bootstrap.Modal(modalEdit).show();
        </script>
    @endif
@endpush
