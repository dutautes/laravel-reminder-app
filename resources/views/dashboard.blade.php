@extends('templates.app')

@section('content')
    <div class="container my-4 w-75">
        <h3 class="fw-bold text-3xl mb-2">Welcome back, {{ Auth::user()->name }}</h3>
        <p class="text-secondary mb-4">Here's what's happening with your tasks today</p>

        {{-- ROW 1 --}}
        <div class="row g-4 mt-3">
            {{-- CARD 1 --}}
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center">
                    <div class="icon-box d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-25"
                        style="width: 80px; height: 80px ;">
                        <i class="bi bi-bell text-primary fs-2"></i>
                    </div>
                    <div class="text-end">
                        <h2 class="fw-bold m-0 text-4xl">{{ $activeCount }}</h2>
                        <small class="text-muted text-xl">Active Reminders</small>
                    </div>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center">
                    <div class="icon-box d-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-25"
                        style="width: 80px; height: 80px;">
                        <i class="bi bi-check2-all text-success fs-2"></i>
                    </div>
                    <div class="text-end">
                        <h2 class="fw-bold m-0 text-4xl">{{ $activeCount + $completedCount }}</h2>
                        <small class="text-muted text-xl">Total Reminders</small>
                    </div>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-md-4">
                <div class="p-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center">
                    <div class="icon-box d-flex align-items-center justify-content-center rounded-3 bg-warning bg-opacity-25"
                        style="width: 80px; height: 80px;">
                        <i class="bi bi-check2-circle text-warning fs-2"></i>
                    </div>
                    <div class="text-end">
                        <h2 class="fw-bold m-0 text-4xl">{{ $completedCount }}</h2>
                        <small class="text-muted text-xl">Completed Tasks</small>
                    </div>
                </div>
            </div>

        </div>

        {{-- ROW 2 --}}
        <h2 class="text-xl fw-bold mt-5">Quick Actions</h2>
        <div class="row g-4 mt-3">
            {{-- card 1 --}}
            <div class="col-md-6">
                <a href="{{ route('reminder.index') }}">
                    <div class="p-4 rounded-4 shadow-sm d-flex flex-col justify-content-center align-items-center">
                        <div class="icon-box d-flex align-items-center justify-content-center rounded-3 bg-info bg-opacity-25"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-bell text-info fs-2"></i>
                        </div>
                        <div class="text-end mt-4">
                            <small class="text-muted text-xl">Create Reminders</small>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Card 2 --}}
            <div class="col-md-6">
                <a href="{{ route('reminder.index') }}">
                    <div class="p-4 rounded-4 shadow-sm d-flex flex-col justify-content-center align-items-center">
                        <div class="icon-box d-flex align-items-center justify-content-center rounded-3 bg-info bg-opacity-25"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-check2-circle text-info fs-2"></i>
                        </div>
                        <div class="text-end mt-4">
                            <small class="text-muted text-xl">View Reminders</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


    {{-- profile card --}}
    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ route('user.profile') }}">
                <div class="p-4 rounded-4 shadow-sm d-flex flex-col justify-content-center align-items-center">
                    <img src="{{ Auth::user()->profilePhotoUrl() }}"
                        class="w-14 h-14 rounded-full mx-auto object-cover mb-1">
                    <div class="text-end mt-4">
                        <small class="text-muted text-xl">My Profile</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
    </div>
@endsection
