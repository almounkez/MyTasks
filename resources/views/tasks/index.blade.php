@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('datatable/buttons.dataTables.min.css') }}"> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <table class="table text-center table-borderd" id="taskslist" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('task_description') }}</th>
                        <th>{{ __('project_name') }}</th>
                        <th>{{ __('task_finished') }}</th>
                        <th>{{ __('task_amount') }}</th>
                        <th>{{ __('task_duedate') }}</th>
                        <th>{{ __('task_eval') }}</th>
                        <th>{{ __('action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->task_description }}</td>
                            <td>{{ $task->project_name }}</td>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input finish" name="task_finished" value="1"
                                        data-rowid="{{ $task->id }}" @if ($task->task_finished) checked @endif>
                                </div>
                            </td>
                            <td>{{ $task->task_amount }}</td>
                            <td>{{ $task->task_duedate }}</td>
                            <td>{{ $task->task_eval }}</td>
                            <td>
                                <div class="btn-group shadow-0" role="group">
                                    <a class="btn rounded-end rounded-start btn-outline-warning mx-1 px-3 btn-edit"
                                        href="{{ route('tasks.edit', $task->id)  }}" data-rowid="{{ $task->id }}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn rounded-circle btn-outline-danger mx-1  px-3 btn-delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{ __('task_description') }}</th>
                        <th>{{ __('project_name') }}</th>
                        <th>{{ __('task_finished') }}</th>
                        <th>{{ __('task_amount') }}</th>
                        <th>{{ __('task_duedate') }}</th>
                        <th>{{ __('task_eval') }}</th>
                        <th>{{ __('action') }}</th>
                    </tr>
                </tfoot>

            </table>
            {{ $tasks->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('datatable/jquery.js') }}"></script>
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('datatable/sum().js') }}"></script>

    <script type="text/javascript">
        $(function() {

            $(document).on('click', '.finish', function(event) {
                // if (! confirm('Are you sure?')) {event.preventDefault();  return;}
                var rowid = $(this).data('rowid');
                // console.log(rowid);
                if (!rowid) return;
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "{{ route('tasks.setfinished') }}",
                    data: {
                        id: rowid,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response) {
                            $('.success').text(response.message);
                            console.log(response.message);
                            table.draw();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
