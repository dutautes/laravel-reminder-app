@extends('templates.app')

@section('content')
    <div class="container d-flex flex-column align-content-center mt-4 gap-2">
        @if (Session::get('success'))
            <div class="alert alert-success w-100">Berhasil login, <b>Selamat datang! {{ Auth::user()->name }}</b></div>
        @endif
        @if (Session::get('logout'))
            <div class="alert alert-warning w-100">{{ Session::get('logout') }}</div>
        @endif

        <div class="jumbotron d-flex flex-column justify-content-center align-items-center text-center"
            style="background: linear-gradient(135deg, #2476fb 0%, #4290f5 100%); border-radius: 2rem; min-height: 60vh; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 3rem 2rem;">
            <span class="text-secondary" style="font-size: 5rem;">
                <i class="fa-regular fa-sticky-note"></i>
            </span>
            <h2 class="mb-3 fw-bold" style="color: #fff;">NotesApp</h2>
            <p class="mb-4" style="color: #fff; font-size: 1.1rem;">
                Selamat datang di <b>NotesApp</b>! Catat ide, tugas, dan pengingatmu dengan mudah dan aman.<br>
                Mulai produktif dan jangan lewatkan satu hal pun!
            </p>
            <a href="" class="btn btn-light fw-bold px-4 py-2 shadow-sm">
                Mulai Mencatat
            </a>
        </div>
    </div>
@endsection
