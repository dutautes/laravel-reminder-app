<!DOCTYPE html>
<html>

<head>
    <title>Dashboard PDF Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
        }

        h2 {
            margin-bottom: 0;
        }

        .section {
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #999;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .progress {
            font-family: monospace;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <h2>Dashboard Report</h2>
    <p>Nama User: <b>{{ $user->name }}</b></p>
    <p>Tanggal: {{ $date->format('d M Y, H:i') }}</p>

    <div class="section">
        <h3>Ringkasan</h3>
        <p>Total Reminder: {{ $total }}</p>
        <p>Done: {{ $done }}</p>
        <p>Pending: {{ $pending }}</p>
        <p>Persentase Selesai: {{ $percentage }}%</p>

        {{-- progress bar manual --}}
        @php
            $filled = round($percentage / 10);
        @endphp
        <div class="progress">
            Progress: [{{ str_repeat('█', $filled) . str_repeat('░', 10 - $filled) }}] {{ $percentage }}%
        </div>
    </div>

    <div class="section">
        <h3>5 Reminder Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latest as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->due_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
