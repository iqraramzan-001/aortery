<nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom py-lg-3 wow animated fadeInDown">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('front/images/logo-dark1.png')}}" alt="Logo" class="img-fluid" width="150" /></a>
        <button class="navbar-toggler btn btn-blue py-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link py-3 px-1 px-lg-4 transition" href="{{route('support')}}">Help Center</a></li>


            @if(request()->routeIs('login'))
                <li class="nav-item">
                    <a class="nav-link py-3 px-1 px-lg-4 transition" href="{{ route('register') }}">Sign Up</a>
                </li>
            @elseif(request()->routeIs('register'))
                <li class="nav-item">
                    <a class="nav-link py-3 px-1 px-lg-4 transition" href="{{ route('login') }}">Log In</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link py-3 px-1 px-lg-4 transition" href="{{ route('login') }}">Log In</a>
                </li>
            @endif

        </ul>
    </div>
    </div>
</nav>
