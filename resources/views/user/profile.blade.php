@extends('templates.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            @include('user.sidebar')

            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4 fw-semibold">Profil Pengguna</h4>

                        @if (Session::get('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">d
                                {{ Session::get('failed') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4 text-center">
                                <img src="{{ $user->profilePhotoUrl() }}" alt="Profile" width="120"
                                    class="rounded-circle mb-2 border">
                                <div>
                                    <label for="profile_photo" class="form-label fw-semibold">Foto Diri</label>
                                    <input type="file" name="profile_photo" id="profile_photo"
                                        class="form-control w-auto d-inline">
                                    <small class="text-muted d-block mt-1">Disarankan rasio 1:1 dan ukuran &lt; 2MB.</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap *</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username *</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username', $user->username) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Headline</label>
                                <input type="text" name="headline" class="form-control"
                                    placeholder="Contoh: Fullstack Developer at XYZ Company"
                                    value="{{ old('headline', $user->headline) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tentang Saya</label>
                                <textarea name="about" class="form-control" rows="4" placeholder="Tulis cerita singkat tentang diri Anda.">{{ old('about', $user->about) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
