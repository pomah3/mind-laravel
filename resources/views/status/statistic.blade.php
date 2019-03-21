@extends('layout.logined')

@section('title')
    {{ __('status.statistic.title') }}
@endsection

@section('content')
    <div class="container">
        <canvas id="plot" width="400" height="200"></canvas><br>
{{--
        @foreach ($days as $day)
            <p>{{ $day["date"] }}</p>
            <table>
                @foreach ($day["statistics"] as $title => $count)
                    <tr>
                        <td>{{ $title }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach --}}
    </div>

    @push('scripts')
        <script>
            (function() {
                let days = @json($days);
                console.log(days);

                let datasets = {};
                let labels = [];

                days.forEach((day, i) => {
                    labels[i] = day.date.date;

                    Object.keys(day.statistics).forEach(title => {
                        datasets[title] = datasets[title] || [];
                        datasets[title][i] = day.statistics[title];
                    });
                });

                let colors = ["red", "green", "blue", "purple", "yellow", "orange"];

                let i = -1;
                let plot_datasets = Object.keys(datasets).map(title => {
                    i++;
                    return {
                        label: title,
                        data: datasets[title],
                        borderWidth: 1,
                        lineTension: 0,
                        borderColor: colors[i]
                    };
                });

                let chart = new Chart($("#plot"), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: plot_datasets
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })();
        </script>
    @endpush

@endsection
