<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        @guest
        <a class="navbar-brand border" href="{{url('/')}}">
            <span class="text-bold text-capitalize"><b>IJP</b></span>
        </a>
        @else
        @if(auth()->user()->user_type == \App\Models\User::TYPE_APPLICANT)
        <a class="navbar-brand border" href="{{ route('applicant.home') }}">
            <span class="text-bold text-capitalize"><b>IJP</b></span>
        </a>
        @elseif(auth()->user()->user_type == \App\Models\User::TYPE_COMPANY)
        <a class="navbar-brand border" href="{{ route('company.home') }}">
            <span class="text-bold text-capitalize"><b>IJP</b></span>
        </a>
        @elseif(auth()->user()->user_type == \App\Models\User::TYPE_ADMIN)
        <a class="navbar-brand border" href="{{ route('admin.home') }}">
            <span class="text-bold text-capitalize"><b>IJP</b></span>
        </a>
        @endif

        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registerr') }}</a>
                </li> -->
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>

                    @if(auth()->user()->user_type == \App\Models\User::TYPE_APPLICANT)
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item nav-item" href="{{ route('applicant.job-application.index') }}">
                            <i class="nav-icon fas fa-briefcase mr-2"></i> {{ __('Jobs Applications') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('applicant.account.index') }}">
                            <i class="nav-icon fas fa-cogs mr-2"></i>{{ __('Account Settings') }}
                        </a>

                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    @elseif(auth()->user()->user_type == \App\Models\User::TYPE_COMPANY)
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item nav-item" href="{{ route('company.job.index') }}">
                            <i class="nav-icon fas fa-briefcase mr-2"></i>{{ __('Jobs') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('company.internship.index') }}">
                            <i class="nav-icon fas fa-paper-plane mr-2"></i>{{ __('Internships') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('company.account.index') }}">
                            <i class="nav-icon fas fa-cogs mr-2"></i>{{ __('Company Settings') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('company.user-account.index') }}">
                            <i class="nav-icon fas fa-cogs mr-2"></i>{{ __('User Settings') }}
                        </a>

                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    @elseif(auth()->user()->user_type == \App\Models\User::TYPE_ADMIN)
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item nav-item" href="{{ route('admin.company.index') }}">
                            <i class="nav-icon fas fa-building mr-2"></i>{{ __('Companies') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('admin.internship-application.index') }}">
                            <i class="nav-icon fas fa-paper-plane mr-2"></i>{{ __('Internship Applications') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('admin.account.index') }}">
                            <i class="nav-icon fas fa-cogs mr-2"></i>{{ __('University Settings') }}
                        </a>

                        <a class="dropdown-item nav-item" href="{{ route('admin.user-account.index') }}">
                            <i class="nav-icon fas fa-cogs mr-2"></i>{{ __('User Settings') }}
                        </a>

                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    @endif
                </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>