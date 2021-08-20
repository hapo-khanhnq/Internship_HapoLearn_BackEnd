<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="logo-link"><img src="{{ asset('images/hapo_learn_logo.png') }}" alt="HapoLearn-logo"></a>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li>
                    <a href="{{ route('home') }}" class="header-link header-link-active">HOME</a>
                </li>
                <li>
                    <a href="{{ route('courses') }}" class="header-link">ALL&nbsp;COURSES</a>
                </li>
                @if (Auth::check())
                @csrf
                <li class="link-for-phone">
                    <a href="#" class="header-link">LIST LESSON</a>
                </li>
                <li class="link-for-phone">
                    <a href="#" class="header-link">LESSON DETAIL</a>
                </li>
                <li>
                    <a href="#" class="header-link">PROFILE</a>
                </li>
                <li>
                    <a class="header-link" href="{{ route('logout') }}" id="logout">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @else
                <li>
                    <a href="#" class="header-link" data-toggle="modal" data-target="#loginModal">LOGIN/REGISTER</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
@include('auth.login_register')
