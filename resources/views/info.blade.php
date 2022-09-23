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
                            {{ $apptasks ?? 0 }}
                            <img src="{{ asset('img/intro/tasks_all.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 text-center">
            <div class="card shadow border-4 border-bottom-0 border-top-0 border-end-0  border-secondary">
                <div class="card-body row align-items-center">
                    <div class="col-md-8">
                        <a class="card-text text-decoration-none fs-4"
                            href="{{ route('tasks.index') }}">{{ __('auth.Users') }} </a>
                    </div>
                    <div class="col-md-4 text-decoration-none text-center text-secondary fs-4"><a
                            href="{{ route('tasks.index') }}">
                            {{ $appusers ?? 0 }}
                            <img src="{{ asset('img/intro/tasks_all.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col">
               <div class="card shadow">
                <div class="card-header">{{ __('top 10 long Tasks') }}</div>
                <div class="card-body">

                    @isset($appactivity)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('id') }}</th>
                                    <th scope="col">{{ __('company') }}</th>
                                    <th scope="col">{{ __('name') }}</th>
                                    <th scope="col">{{ __('email') }}</th>
                                     <th scope="col">{{ __('cnt') }}</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($appactivity as $appactivities)
                                    <tr>
                                        <td>{{ $appactivities->id }}</td>
                                        <td>{{ $appactivities->company }}</td>
<td>{{ $appactivities->name }}</td>
 <td>{{ $appactivities->email }}</td>
  <td>{{ $appactivities->cnt }}</td>
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
@endsection
