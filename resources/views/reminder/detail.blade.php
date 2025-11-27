@extends('templates.app')

@section('content')
    <div class="container my-4">
        <a href="{{ route('reminder.index') }}" class="btn btn-danger">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Reminders
        </a>
        <div class="card p-4 mx-auto" style="max-width: 700px; border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">{{ $reminder->title }}</h4>

                {{-- badge status --}}
                @php
                    $status = $reminder->status;
                    $badgeColor = $status === 1 ? 'primary' : 'secondary';
                    $badgeText = $status === 0 ? 'Nonactive' : 'Active';
                @endphp

                <span class="badge bg-{{ $badgeColor }}" style="font-size: 0.85rem;">
                    {{ $badgeText }}
                </span>
            </div>


            <p class="text-muted" style="font-size: 14px;">
                Created on {{ \Carbon\Carbon::parse($reminder->created_at)->format('M j, Y') }}
            </p>

            <div class="mt-3">
                <h6 class="fw-bold">Description</h6>
                <p class="text-secondary">{{ $reminder->description }}</p>
            </div>

            <div class="d-flex gap-3 mt-4">
                <div class="flex-fill p-3 bg-light rounded">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="fa-regular fa-calendar"></i>
                        <span class="fw-semibold">Due Date</span>
                    </div>
                    <div class="fw-bold">
                        {{ \Carbon\Carbon::parse($reminder->due_at)->format('M j, Y') }}
                    </div>
                </div>

                <div class="flex-fill p-3 bg-light rounded">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="fa-regular fa-clock"></i>
                        <span class="fw-semibold">Due Time</span>
                    </div>
                    <div class="fw-bold">
                        {{ \Carbon\Carbon::parse($reminder->due_at)->format('g:i A') }}
                    </div>
                </div>
            </div>

            <div class="bg-light p-3 rounded mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <strong>Mark as Complete</strong>
                    <p class="m-0 text-muted" style="font-size: 13px;">Mark this reminder as done</p>
                </div>

                {{-- toggle switch --}}
                <form action="{{-- route('reminder.toggle', $reminder->id) --}}" method="POST">
                    @csrf
                    <label class="switch">
                        <input type="checkbox" {{-- onchange="this.form.submit()" --}} {{ $reminder->status === 'done' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </form>
            </div>

            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('reminder.edit', $reminder->id) }}" class="btn btn-outline-primary">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>

                <form action="{{ route('reminder.destroy', $reminder->id) }}" method="POST"
                    onsubmit="return confirm('Delete this reminder?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 45px;
            height: 24px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4ade80;
        }

        input:checked+.slider:before {
            transform: translateX(21px);
        }
    </style>
@endpush
