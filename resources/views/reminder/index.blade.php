@extends('templates.app')

@section('content')
    <div class="container w-75 my-3">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <h3 class="text-3xl"><b>My Reminders</b></h3>
        <h3 class="text-xl mt-3">Manage and organize your tasks efficiently</h3>

        <div class="d-flex justify-content-end mb-3 mt-4">
            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">tambah</a>
        </div>

        <h3 class="my-3 text-black">Active ({{ count($active) }})</h3>
        <div class="row">
            @foreach ($active as $reminder)
                <div class="col-md-12">
                    <div class="card mb-3 reminder-card">
                        <div class="card-body">
                            <div class="d-flex justify-between">
                                <a href="{{ route('reminder.show', $reminder->id) }}">
                                    <h5 class="card-title text-xl text-black">{{ $reminder->title }}</h5>
                                </a>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('reminder.edit', $reminder->id) }}"><i
                                            class="fa-regular fa-pen-to-square editBtn" style="cursor: pointer"></i></a>
                                    <form action="{{ route('reminder.destroy', $reminder->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this reminder?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-regular fa-trash-can deleteBtn"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-base">{{ $reminder->description }}</p>
                            <div class="d-flex justify-between">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <span><i
                                            class="fa-regular fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($reminder->due_at)->format('M j, Y') }}</span>
                                    <span><i
                                            class="fa-regular fa-clock me-1"></i>{{ \Carbon\Carbon::parse($reminder->due_at)->format('h.i A') }}</span>
                                    <span><i class="fa-solid fa-repeat me-1"></i>{{ $reminder->repeat }}</span>
                                    <span><i
                                            class="fa-solid fa-check me-1"></i>{{ $reminder->completed_at ? $reminder->completed_at->format('M j, Y h.i A') : '-' }}</span>
                                </div>

                                {{-- toggle switch --}}
                                <div class="d-flex gap-3">
                                    <span>Done</span>
                                    <form action="{{ route('reminder.toggle', $reminder->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label class="switch">
                                            <input type="checkbox" onchange="this.form.submit()"
                                                {{ $reminder->status ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <h3 class="my-3 text-black">Completed ({{ count($completed) }})</h3>
        <div class="row">
            @foreach ($completed as $reminder)
                <div class="col-md-12">
                    <div class="card mb-3 reminder-card-completed">
                        <div class="card-body">
                            <div class="d-flex justify-between">
                                <a href="{{ route('reminder.show', $reminder->id) }}">
                                    <h5 class="card-title text-xl"><del>{{ $reminder->title }}</del></h5>
                                </a>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('reminder.edit', $reminder->id) }}"><i
                                            class="fa-regular fa-pen-to-square editBtn" style="cursor: pointer"></i></a>
                                    <form action="{{ route('reminder.destroy', $reminder->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this reminder?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-regular fa-trash-can deleteBtn"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-base">{{ $reminder->description }}</p>
                            <div class="d-flex justify-between">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <span><i
                                            class="fa-regular fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($reminder->due_at)->format('M j, Y') }}</span>
                                    <span><i
                                            class="fa-regular fa-clock me-1"></i>{{ \Carbon\Carbon::parse($reminder->due_at)->format('h.i A') }}</span>
                                    <span><i class="fa-solid fa-repeat me-1"></i>{{ $reminder->repeat }}</span>
                                    <span><i
                                            class="fa-solid fa-check me-1"></i>{{ $reminder->completed_at ? $reminder->completed_at->format('M j, Y h.i A') : '-' }}</span>
                                </div>

                                {{-- toggle switch --}}
                                <div class="d-flex gap-3">
                                    <span>Done</span>
                                    <form action="{{ route('reminder.toggle', $reminder->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label class="switch">
                                            <input type="checkbox" onchange="this.form.submit()"
                                                {{ $reminder->status ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- modal TAMBAH --}}
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAddLabel">Tambah Reminder</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- agar membungkus sampe modal-footer ke button kirim --}}
                    <form method="POST" action="{{ route('reminder.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid
                                @enderror"
                                    id="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <p class="text-danger mt-1">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea type="text" name="description" cols="10" rows="10" id="description"
                                    class="form-control @error('description') is-invalid
                                @enderror"
                                    style="field-sizing: content;">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <p class="text-danger mt-1">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="due_at" class="form-label">Tanggal & Waktu:</label>
                                <input type="datetime-local" name="due_at" id="due_at"
                                    class="form-control @error('due_at') is-invalid
                                @enderror"
                                    value="{{ old('due_at') }}">
                                @if ($errors->has('due_at'))
                                    <p class="text-danger mt-1">{{ $errors->first('due_at') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="repeat" class="form-label">Repeat</label>
                                <select name="repeat" id="repeat">
                                    <option selected value="none">None</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
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
        {{-- end of modal add --}}
    </div>
@endsection

@push('style')
    <style>
        .reminder-card {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            transition: all 0.3s;
        }

        .reminder-card:hover {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .editBtn:hover {
            color: skyblue;
        }

        .deleteBtn:hover {
            color: red;
        }

        /* toggle */
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
            background-color: #535755dc;
        }

        input:checked+.slider:before {
            transform: translateX(21px);
        }
    </style>
@endpush

@push('script')
    {{-- pengecekan php, kalo ada error validasi apapun : $errors->any() --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded',
                function() { // pake event ini, kalo engga id modal nya null belum ke render
                    let modalAdd = document.getElementById('modalAdd');
                    let modal = new bootstrap.Modal(modalAdd);
                    modal.show();
                });
        </script>
    @endif
@endpush
