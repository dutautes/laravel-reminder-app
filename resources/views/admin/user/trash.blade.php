@extends('templates.app')

@section('content')
    <div class="container mt-5">
        @if (Session::get('success'))
            <div class="alert alert-success w-100 mt-3">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <h5>Data Sampah Pengguna</h5>
        <table class="table my-3 table-bordered">
            <tr>
                <th>#</th>
                <th>Nama </th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            {{-- looping : mengubah aray multidimensi menjadi array asosiatif --}}
            @foreach ($userTrash as $key => $user)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
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
                    <td class="d-flex justify-content-center gap-2">
                        <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success me-2">Kembalikan</button>
                        </form>
                        <form action="{{ route('admin.users.delete_permanent', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Anda yakin menghapus file ini secara permanen?')">Hapus
                                Permanen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
