<nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom py-lg-3 wow animated fadeInDown">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('front/images/logo-dark1.png')}}" alt="Logo" class="img-fluid" width="150" /></a>
        <button class="navbar-toggler btn btn-blue py-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="position-relative search-bar ms-lg-4" role="search">
                <input class="form-control w-100 shadow-none rounded-pill" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn bnt-light border-0 shadow-none position-absolute start-0 top-0" type="submit"><i class="fa fa-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link py-3 px-1 px-lg-4 transition" href="{{route('product.index')}}">Products</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-1 px-lg-4 transition" href="{{route('cart.index')}}"><i class="fa fa-cart-plus fs-5"></i></a></li>
                @if(Auth::check())
                    <li class="nav-item"><a class="nav-link py-3 px-1 px-lg-4 transition" href="{{route('support')}}">Help Center</a></li>
                @endif




                @if (Auth::check())
                    @php

                        $user = Auth::user();
                        $name = '';
                        if ($user->type === \App\Models\User::TYPE_SUPPLIER && $user->supplier) {
                            $name = $user->supplier->first_name . ' ' . $user->supplier->last_name;
                        } elseif ($user->type === \App\Models\User::TYPE_BUYER && $user->buyer) {
                            $name = $user->buyer->first_name . ' ' . $user->buyer->last_name;
                        }
                    elseif ($user->type === \App\Models\User::TYPE_ADMIN) {
                            $name ="Admin";
                        }
                    @endphp

                    <li class="nav-item"><a class="nav-link py-3 py-lg-0 px-1 px-lg-1 px-lg-4 transition" href="javascript:;"><small class="d-flex align-items-center gap-2 justify-content-between">Welcome!
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="bg-transparent border-0 text-danger">
                                        <i class="fa fa-power-off"></i>
                                    </button>
                                </form></small><b class="d-block text-blue mt-2">{{$name}}</b></a></li>
                @else
                    <li class="nav-item">
                        <a class="nav-link py-3 px-1 px-lg-4 transition" href="{{ route('login') }}">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-blue px-4 mt-1 rounded-pill" href="{{ route('register') }}">Sign Up</a>
                    </li>
                @endif



            </ul>
        </div>
    </div>
</nav>
