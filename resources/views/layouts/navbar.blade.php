<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
    <div class="container-fluid mx-2">
        <a class="nav-item float-start p-0 me-auto" href="{{ route('home') }}" data-bs-toggle="tooltip"
            data-bs-placement="top" title="{{ __('myweb.Home') }}">

            {{ __('myweb.Home') }}</a>
        <a class="nav-item nav-link" href="{{ route('tasks.create') }}" data-bs-toggle="tooltip" data-bs-placement="top"
            title="{{ __('task_new') }}">

            {{ __('task_new') }}</a>


        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbar-content">
            <div class="hamburger-toggle">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </button>
        <div class="collapse navbar-collapse" id="navbar-content">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                        {{ __('myweb.Home') }}</a>
                </li> --}}
                @auth

                    {{-- <li class="nav-item">
                        <a class="nav-link" aria-current="page"
                            href="{{ route('tasks.create') }}">{{ __('task_new') }}</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('tasks.index') }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="{{ __('All') }}">

                            {{ __('All') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('tasks.unfinished') }}"
                            data-bs-toggle=" tooltip" data-bs-placement="top" title="{{ __('unfinished') }}">

                            {{ __('unfinished') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('tasks.finished') }}"
                            data-bs-toggle=" tooltip" data-bs-placement="top" title="{{ __('finished') }}">

                            {{ __('finished') }}
                        </a>
                    </li>
                    @isset($projects)
                        <li class="dropdown">
                            <a class="nav-link  dropdown-toggle" id="dropdownprojects" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                {{ __('By projects') }}
                            </a>
                            <ul id="projects_list" class="dropdown-menu" aria-labelledby="dropdownprojects">

                                @foreach ($projects as $project)
                                    <li><a class="dropdown-item"
                                            href="{{ route('tasks.byproject', $project) }}">{{ $project }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endisset
                @endauth

                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">{{ __('Get A Quote')
                        }}</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{#">{{ __('About Us') }}</a>
                </li> --}}




                {{-- <li class="nav-item dropdown dropdown-mega position-static">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside">Megamenu</a>
                <div class="dropdown-menu shadow">
                    <div class="mega-content px-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-3 py-4">
                                    <h5>Pages</h5>
                                    <div class="list-group">
                                        <a class="list-group-item" href="#">Accomodations</a>
                                        <a class="list-group-item" href="#">Terms & Conditions</a>
                                        <a class="list-group-item" href="#">Privacy</a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-3 py-4">
                                    <h5>Card</h5>
                                    <div class="card">
                                        <img src="https://via.placeholder.com/320x180" class="img-fluid" alt="image">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the
                                                card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-3 py-4">
                                    <h5>Lot of Pages</h5>
                                    <p>Lorem ipsum dolo sit achmet muhamed borlan de irtka.
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 py-4">
                                    <h5>Damn, so many</h5>
                                    <div class="list-group">
                                        <a class="list-group-item" href="#">Accomodations</a>
                                        <a class="list-group-item" href="#">Terms & Conditions</a>
                                        <a class="list-group-item" href="#">Privacy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li> --}}
                {{-- <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li> --}}
            </ul>
            {{-- <form class="my-2 ms-auto" action="#" method="POST">
                <div class="input-group">
                    @csrf
                    <input class="form-control border-0 mr-2 @error('policy_num') is-invalid @enderror"
                        name="policy_num" placeholder="{{ __('Enter Policy No.') }}" value="{{old('policy_num')??''}}"
                        aria-label="{{ __('Enter Policy No.') }}">

                    <button class="btn btn-primary border-0" type="submit">{{ __('Search') }}</button>

                </div>
                @error('policy_num')
                <span class="text-danger">{{ $message }}</span>
                @enderror

            </form> --}}

            <div class="nav-item dropstart float-end ms-auto">
                {{-- <div class="dropdown "> --}}
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        {{ __('auth.Account') }}
                    @endauth


                    {{-- <i class="zmdi zmdi-chart zmdi-hc-lg zmdi-hc-fw me-2"></i> --}}
                </a>
                <ul class="dropdown-menu shadow">
                    @guest
                        @if (Route::has('login'))
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('auth.Register') }}</a>
                            </li>
                        @endif
                        @if (Route::has('login'))
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('auth.Login') }}</a></li>
                        @endif
                    @else
                        {{-- <li><a class="dropdown-item" href="#">{{ __('Profile') }}</a></li>
                        <li> --}}

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('auth.Logout') }}<i class="zmdi zmdi-logout float-end"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        </li>

                    @endguest
                </ul>
            </div>
            @if (app()->getLocale() == 'en')
                <a class="navbar-brand p-0" href="{{ route('locale', 'ar') }}">
                    <img class="img-fluid" src="{{ asset('img/ar.png') }}" width="36">
                </a>
            @else
                <a class="navbar-brand p-0" href="{{ route('locale', 'en') }}">
                    <img class="img-fluid" src="{{ asset('img/en.png') }}" width="36">
                </a>
            @endif
        </div>
    </div>
</nav>
