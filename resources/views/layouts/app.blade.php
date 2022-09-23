<!doctype html>
<html dir="{{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title',config('app.name', 'Laravel'))</title>
    <meta name="title" content="Team Tasks Website">
    <meta name="description" content="Team Tasks Website">
    <!-- Scripts -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,500;0,900;1,500;1,900&display=swap"
        rel="stylesheet">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('select2/select2-bootstrap-5-theme.rtl.min.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('select2/select2-bootstrap-5-theme.min.css') }}" />
    @endif
    <link rel=' stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&amp;display=swap'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
    <link rel="stylesheet" href="{{ asset('css/zmdi.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/theme.rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    @endif
    {{-- <link rel="stylesheet" href="{{ asset('css/amz.css') }}"> --}}
    @yield('style')
</head>

<body>
    @include('layouts.navbar')


    <div class="container-fluid">
                @yield('content')
    </div>
<div class="container-fluid">
        <div class="row my-2 justify-content-center">
            <div class="col-md-8">
@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
@foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif
    @if (session('message'))
        <div class="alert alert-secondary text-center">
            {{ session('message') }}
        </div>
    @endif
    </div>
    </div>
    </div>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @include('layouts.footer')

    <!-- partial -->
    {{-- <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js'></script> --}}
    <script src="{{ asset('js/script.js') }}"></script>


    <script src="{{ asset('select2/select2.min.js') }}"></script>

    @yield('script')
    {{-- @stack('script') --}}
</body>

</html>
