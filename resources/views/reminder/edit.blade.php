@extends('templates.app')

@section('content')
    <div class="container my-4">
        <h2>Edit Reminder</h2>

        <form action="{{ route('reminder.update', $reminder->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $reminder->title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $reminder->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal & Waktu</label>
                <input type="datetime-local" name="due_at" class="form-control"
                    value="{{ \Carbon\Carbon::parse($reminder->due_at)->format('Y-m-d\TH:i') }}">
            </div>

            <div class="mb-3">
                <label>Repeat</label>
                <select name="repeat" class="form-select">
                    <option value="none" {{ $reminder->repeat == 'none' ? 'selected' : '' }}>None</option>
                    <option value="daily" {{ $reminder->repeat == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ $reminder->repeat == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ $reminder->repeat == 'monthly' ? 'selected' : '' }}>Monthly</option>
                </select>
            </div>

            <a href="{{ route('reminder.index') }}" class="btn btn-danger">Kembali</a>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
