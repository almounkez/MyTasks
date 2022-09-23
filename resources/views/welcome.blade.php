@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="row my-2 pb-3">
        <div class="col-12 p-0">

            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/intro/slide1.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/intro/slide2.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/intro/slide3.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Previous') }}</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Next') }}</span>
                </button>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 p-0">

        </div>
        <div class="col-md-6 p-0">

        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card h-100">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    {{-- <h5 class="card-title">{{ __("Capitalaga's STRENGTHS") }}</h5> --}}
                    <p class="card-text">
                        {{ __('Operations keeps the lights on, strategy provides a light at the end of the tunnel, but project management is the train engine that moves the organization forward.') }}
                    </p>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">{{ __('INDUSTRY EXPERIENCE') }}</small>
                </div> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">

                <div class="card-body">

                    <div class="row">
                        <div class="col text-center"> <img src="{{ asset('img/mis/welcome01.png') }}" class="img-fluid" alt="..." width="200"></div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    {{-- <h5 class="card-title">{{ __('FROM PARIS TO TIMBUKTU') }}</h5> --}}
                    <p class="card-text">
                        {{ __('Project management is like juggling three balls – time, cost and quality. Program management is like a troupe of circus performers standing in a circle, each juggling three balls and swapping balls from time to time.') }}
                    </p>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted"></small>
                </div> --}}
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                 <div class="card-body">

                    <div class="row">
                        <div class="col text-center"> <img src="{{ asset('img/mis/welcome02.png') }}" class="img-fluid" alt="..." width="200"></div>
                    </div>

                </div>





                    {{-- <h5 class="card-title">Card title</h5> --}}
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p> --}}
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div> --}}
            </div>
        </div>

    </div>
    <div class="row my-2">
        <div class="col-12 p-0">
            <img src="{{ asset('img/mis/adds01.png') }}" alt="..." width="100%">
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card h-100">
                 <div class="card-body">

                    <div class="row">
                        <div class="col text-center"> <img src="{{ asset('img/mis/welcome03.png') }}" class="img-fluid" alt="..." width="200"></div>
                    </div>

                </div>


                {{-- <div class="card-footer">
                    <small class="text-muted"></small>
                </div> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    {{-- <h5 class="card-title">{{ __('ADAPTABLE POLICIES FOR ALL') }}</h5> --}}
                    <p class="card-text">
                        {{ __('Once you have mastered time, you will understand how true it is that most people overestimate what they can accomplish in a year - and underestimate what they can achieve in a decade!') }}
                    </p>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">.</small>
                </div> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                 <div class="card-body">

                    <div class="row">
                        <div class="col text-center"> <img src="{{ asset('img/mis/welcome04.png') }}" class="img-fluid" alt="..." width="200"></div>
                    </div>

                </div>


                {{-- <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div> --}}
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    {{-- <h5 class="card-title">{{ __('AROUND THE CLOCK GLOBAL SUPPORT') }}</h5> --}}
                    <p class="card-text">
                        {{ __('One reason so few of us achieve what we truly want is that we never direct our focus; we never concentrate our power. Most people dabble their way through life, never deciding to master anything in particular.') }}
                    </p>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div> --}}
            </div>
        </div>

    </div>
    <div class="row my-2">
        <div class="col-12 p-0">
            <img src="{{ asset('img/mis/adds02.png') }}" alt="..." width="100%">
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-1 p-1">
            <img src="{{ asset('img/mis/Welcome05.png') }}" alt="..." width="100%">
        </div>
        <div class="col p-1">
            <h3>
                {{ __("Management is doing things right; leadership is doing the right things.") }}
            </h3>
        </div>
    </div>
@endsection
