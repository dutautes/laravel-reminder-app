@extends('templates.app')

@section('content')
    <div class="container w-75 my-4">
        <h3 class="mb-2 text-2xl"><b>Activity Log</b></h3>
        <h4 class="mb-4">Data aktifitas yang dilakukan oleh semua user </h4>

        <table class="table table-hover table-bordered" id="activitiesTable">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
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
                        <td>{{ $activity->user->name ?? 'Unknown' }}</td> {{-- if ?? else --}}
                        <td>{{ $activity->action }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>
                            {{ $activity->ref_type }} ID:<b> {{ $activity->ref_id }}</b>
                        </td>
                        <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            $('#activitiesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.datatables_activity') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user_name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'refrence',
                        name: 'refrence'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            })
        })
    </script>
@endpush
