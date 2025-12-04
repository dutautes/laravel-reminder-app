@extends('templates.app')

@section('content')
    <div class="container my-4">
        <h3 class="mb-4"><b>Activity Log</b></h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Reference</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->user->name ?? 'Unknown' }}</td>
                        <td>{{ $activity->action }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>
                            {{ $activity->ref_type }} (ID: {{ $activity->ref_id }})
                        </td>
                        <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
