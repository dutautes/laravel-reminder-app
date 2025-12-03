@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success w-100">{{ Session::get('success') }} <b>Selamat datang, {{ Auth::user()->name }}</b>
        </div>
    @endif

    <div class="container my-5 w-75">
        <h5 class="text-2xl">Grafik Pembuatan Reminder</h5>
        <div>
            <canvas id="chartBar"></canvas>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let dataChartBar = null;
        let labelChartBar = null;

        $(function() {
            $.ajax({
                url: "{{ route('admin.reminders.chart') }}",
                method: "GET",
                success: function(response) {
                    dataChartBar = response.data;
                    labelChartBar = response.labels;
                    showChart();
                },
                error: function(err) {
                    alert('Gagal mengambil data untuk chart reminders!');
                }
            });
        });

        function showChart() {
            const ctx = document.getElementById('chartBar');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelChartBar,
                    datasets: [{
                        label: 'Jumlah Reminder',
                        data: dataChartBar,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });
        }
    </script>
@endpush
