@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }}">
@endsection
@section('content')

    {{-- Counts Cards --}}
    <div class="row  justify-content-center ">
        <div class="col-md-4 my-2 text-center">
            <div class="card shadow border-4 border-bottom-0 border-top-0 border-end-0  border-secondary">

                <div class="card-body row align-items-center">
                    <div class="col-md-8">
                        <a class="card-text text-decoration-none fs-4"
                            href="{{ route('tasks.index') }}">{{ __('myweb.alltasks') }} </a>
                    </div>
                    <div class="col-md-4 text-decoration-none text-center text-secondary fs-4"><a
                            href="{{ route('tasks.index') }}">
                            {{ App\Models\Tasks::where('user_id', Auth::id())->count() ?? 0 }}
                            </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 text-center">
            <div class="card shadow border-4 border-bottom-0 border-top-0 border-end-0  border-warning">
                <div class="card-body row align-items-center">
                    <div class="col-md-8">

                        <a class="card-text text-decoration-none fs-4"
                            href="{{ route('tasks.finished') }}">{{ __('myweb.finished') }}</a>
                    </div>
                    <div class="col-md-4 text-decoration-none text-decoration-none text-center text-warning fs-4"><a
                            href="{{ route('tasks.finished') }}">
                            {{ App\Models\Tasks::where('user_id', Auth::id())->where('task_finished', true)->count() }}
                            </div></a>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 text-center">
            <div class="card shadow border-4 border-bottom-0 border-top-0 border-end-0  border-warning">
                <div class="card-body row align-items-center">
                    <div class="col-md-8">

                        <a class="card-text text-decoration-none fs-4"
                            href="{{ route('tasks.unfinished') }} ">{{ __('myweb.unfinished') }} </a>
                    </div>
                    <div class="col-md-4 text-decoration-none text-center text-warning fs-4"><a
                            href="{{ route('tasks.unfinished') }}">
                            {{ App\Models\Tasks::where('user_id', Auth::id())->where('task_finished', false)->count() }}
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Canavs --}}
    <div class="row  justify-content-center">

        <div class="col-md-6 col-sm-12 my-2">
            <div class="card shadow">
                <div class="card-header">{{ __('Charts Tasks')}}</div>
                <div class="card-body">
                    <canvas id="myChart" width="200" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 my-2">
            <div class="card shadow">
                <div class="card-header"> {{ __('Project Tasks')}}</div>
                <div class="card-body">
                    @isset($projects)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Project_Name') }}</th>
                                    <th scope="col">{{ __('finished') }}</th>
                                    <th scope="col">{{ __('unfinished') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projsum as $projsum)
                                    <tr>
                                        <td><a
                                                href="{{ route('tasks.byproject', $projsum->project_name) }}">{{ $projsum->project_name }}</a>
                                        </td>
                                        <td>{{ $projsum->finished }}</td>
                                        <td>{{ $projsum->unfinished }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12 my-2">
            <div class="card shadow">
                <div class="card-header">{{ __('top 10 late Tasks') }}</div>
                <div class="card-body">
                    @isset($toplates)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('task_description') }}</th>
                                    <th scope="col">{{ __('Project_Name') }}</th>
                                    <th scope="col">{{ __('task_duedate') }}</th>
                                    <th scope="col">{{ __('duedays') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($toplates as $toplate)
                                    <tr>
                                        <td><a
                                                href="{{ route('tasks.edit', $toplate->id) }}">{{ $toplate->task_description }}</a>
                                        </td>
                                        <td>{{ $toplate->project_name }}</td>
                                        <td>{{ $toplate->task_duedate }}</td>
                                        <td>{{ $toplate->duedays }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset
                    {{-- longtask --}}
                </div>
            </div>
        </div>
     <div class="col-md-6 col-sm-12 my-2">
            <div class="card shadow">
                <div class="card-header">{{ __('top 10 long Tasks') }}</div>
                <div class="card-body">

                    @isset($longtasks)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('task_description') }}</th>
                                    <th scope="col">{{ __('Project_Name') }}</th>
                                    <th scope="col">{{ __('task_dates') }}</th>
                                    <th scope="col">{{ __('taskdays') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($longtasks as $longtask)
                                    <tr>
                                        <td><a href="{{ route('tasks.edit', $longtask->id) }}">{{ $longtask->task_description }}</a>
                                        </td>
                                        <td>{{ $longtask->project_name }}</td>

                                        <td>{{ date('Y-m-d',strtotime($longtask->created_at)) }}<br>{{ date('Y-m-d',strtotime($longtask->updated_at)) }}</td>
                                        <td>{{ $longtask->taskdays }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#years').select2();
        $('#producers').select2();
        $('#monthes').select2();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"
        integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        const color = ["#33a8c7", "#52e3e1", "#a0e426", "#fdf148",
                "#ffab00", "#f77976", "#f050ae", "#d883ff",
                "#9336fd", "#ffce39", "#fff951", "#b9ff47",
                "#74ff97", "#37fffc", "#6bc9ff", "#f36aff",
                "#ff6cbb", "#000000"
            ],
            colorb = ['rgba(51, 168, 199, 0.7)', 'rgba(82, 227, 225, 0.7)', 'rgba(160, 228, 38, 0.7)',
                'rgba(253, 241, 72, 0.7)',
                'rgba(255, 171, 0, 0.7)', 'rgba(247, 121, 118, 0.7)', 'rgba(240, 80, 174, 0.7)', 'rgba(216, 131, 255, 0.7)',
                'rgba(147, 54, 253, 0.7)'
            ];


        const ctx = $('#myChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {

                labels: {!! $labelx !!},
                datasets: [{
                        label: " {{ __('Tasks') }}",
                        data: {!! $data1 !!},
                        borderColor: color[1],
                        backgroundColor: colorb[1],
                    },
                    {
                        label: " {{ __('finished') }}",
                        data: {!! $data2 !!},
                        borderColor: color[2],
                        backgroundColor: colorb[2],
                    },
                    {
                        label: " {{ __('unfinished') }}",
                        data: {!! $data3 !!},
                        borderColor: color[3],
                        backgroundColor: colorb[3],
                    }
                ]

            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $('#submit').on('click', function() {

        });





        function updateChart(mydata) {
            let datasets = [];
            for (let index = 0; index < rooms.length; index++) {
                const element = rooms[index];
                myChart.data.datasets[index].label = element;
                myChart.data.datasets[index].data = {};
                let ok = -1;
                for (let j = 0; j < mydata.length; j++) {
                    let row = mydata[j];
                    if (row.name_ar == element) {
                        ok = row.mon;
                        myChart.data.datasets[index].data[row.mon] = row.count;
                    } else if (ok != row.mon) {
                        myChart.data.datasets[index].data[row.mon] = 0;
                    }
                }

            }
            // ctx3.remov
            myChart.update();
        }
    </script>
@endsection
