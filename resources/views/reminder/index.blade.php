@extends('templates.app')

@section('content')
    <div class="container my-3">
        <h3 class="text-3xl"><b>My Reminders</b></h3>
        <h3 class="text-xl mt-3">Manage and organize your tasks efficiently</h3>

        <div class="d-flex justify-content-end mb-3 mt-4">
            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Data</a>
        </div>

        <h3 class="mb-2">Active (0)</h3>
        <div class="row">
            @foreach ($reminders as $reminder)
                <div class="col-md-12">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="text-xl">{{ $reminder->title }}</h5>
                            <p class="text-base">{{ $reminder->description }}</p>
                            <div class="d-flex justify-between">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <span><i
                                            class="fa-regular fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($reminder->due_at)->format('M j, Y') }}</span>
                                    <span><i
                                            class="fa-regular fa-clock me-1"></i>{{ \Carbon\Carbon::parse($reminder->due_at)->format('h.i A') }}</span>
                                    <span><i class="fa-solid fa-repeat me-1"></i>{{ $reminder->repeat }}</span>
                                </div>
                                <span>Done <input type="checkbox" name="done" id="done"></span>
                            </div>
                        </div>
                    </div>
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
                                    id="title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <input type="text" name="description" id="description"
                                    class="form-control @error('description') is-invalid
                                @enderror">
                            </div>
                            <div class="mb-3">
                                <label for="due_at" class="form-label">Tanggal & Waktu:</label>
                                <input type="datetime-local" name="due_at" id="due_at"
                                    class="form-control @error('due_at') is-invalid
                                @enderror">
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
        {{-- end of modal --}}
    </div>
@endsection
