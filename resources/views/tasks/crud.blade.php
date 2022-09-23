@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task Edit') }}</div>

                    <div class="card-body">
                        <form method="POST" action=@isset($task) "{{ route('tasks.update', ['task'=>$task]) }}"
                        @else
                        "{{ route('tasks.store') }}" @endisset
                                    >
                            @csrf
                            @isset($task)
                                @method('PUT')
                            @endisset
                            <div class="row mb-3">
                                <label for="project_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Project_Name') }}</label>

                                <div class="col-md-6">
                                    <select id="project_name"
                                        class="form-select select2 @error('project_name') is-invalid @enderror"
                                        name="project_name" required autocomplete="project_name" autofocus>
                                        <option selected>.</option>
                                        @foreach ($projects as $project)

                                            <option value="{{ $project }}" @if(!empty($task) && $task->project_name == $project) selected @endif>{{ $project }}</option>
                                        @endforeach

                                    </select>

                                    @error('project_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="task_amount"
                                    class="col-md-4 col-form-label text-md-end">{{ __('task_amount') }}</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('task_amount') is-invalid @enderror"
                                        name="task_amount"
                                        value=@isset($task) "{{ $task->task_amount }}" @else "{{ old('task_amount')??0 }}" @endisset>
                                    @error('task_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="task_duedate"
                                    class="col-md-4 col-form-label text-md-end">{{ __('task_duedate') }}</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('task_duedate') is-invalid @enderror"
                                        name="task_duedate" min ="2000-01-01" " max="9999-12-31"
                                        value=@isset($task) "{{$task->task_duedate }}" @else "{{ old('task_duedate')??date('Y-m-d') }}" @endisset>
                                    @error('task_duedate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="task_description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('task_description') }}</label>

                                <div class="col-md-6">
                                    <textarea  class="form-control @error('task_description') is-invalid @enderror"
                                        name="task_description">@isset($task){{ $task->task_description }} @else {{ old('task_description') }} @endisset</textarea>
                                    @error('task_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="task_eval"
                                    class="col-md-4 col-form-label text-md-end">{{ __('task_eval') }}</label>

                                <div class="col-md-6">
                                    <input type="range" class="form-range" min="0" max="100" step="10" name="task_eval"
                                    value=@isset($task) "{{ $task->task_eval }}" @else "{{ old('task_eval')??0 }}" @endisset
                                    oninput="this.nextElementSibling.value = this.value">
                                    <output>
@isset($task)  {{$task->task_eval}}  @else  {{ old('task_eval')??0 }}@endisset
                                    </output>

                                    {{-- <input type="number" class="form-control @error('task_eval') is-invalid @enderror"
                                        name="task_eval" step="10" min="0" max="100"
                                        value=@isset($task) "{{ $task->task_eval }}" @else "{{ old('task_eval')??0 }}" @endisset> --}}
                                    {{-- @error('task_eval')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="task_finished"
                                    class="col-md-4 col-form-label text-md-end">{{ __('task_finished') }}</label>

                                <div class="col-md-6">
                                    <input type="checkbox" class="form-check @error('task_finished') is-invalid @enderror"
                                        name="task_finished" value="1"
                                        @if ((!empty($task) && $task->task_finished) || old('task_finished')) checked  @endif>
                                    @error('task_finished')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"  ">
                                        {{ __('myweb.Store') }}
                                    </button>
                                    <a    class="btn btn-secondary" href="{{  redirect()->back()->getTargetUrl() }}">
                                        {{ __('myweb.Cancel') }}
                                    </a>
                                      {{-- <a href="{{ route('tasks.index') }} " class="btn btn-secondary">
                                        {{__('myweb.Cancel')  }}
                                    </a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('datatable/jquery.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script>
        $("#project_name").select2({
            tags: true,
            theme: 'bootstrap-5'
        });
    </script>
@endsection
