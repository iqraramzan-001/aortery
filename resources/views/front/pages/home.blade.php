@extends('front.layouts.layout')
@section('content')
    <section class="banner py-5 wow animated fadeInDown position-relative">
        <div class="container py-4 text-center d-flex align-items-center position-relative z-1 text-white">
            <div class="row justify-content-center w-100">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10">
                    <h1 class="display-5 fw-bolder wow animated fadeInDown">Join Now and Enjoy <span class="text-blue">15% Off</span> For 2 Years!</h1>
                    <p class="fs-5 lh-150 d-block py-4 wow animated fadeInDown">It's easily sign up with your email and we will send you a confirmation message.</p>
                    <a href="{{route('register')}}" class="btn btn-purple px-5 py-3 mt-4 fs-5 wow animated fadeInDown rounded-pill">Sign Up</a>
                </div>
            </div>
        </div>
    </section>

    <section class="categories py-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                    <h class="h3 wow animated fadeInDown fw-bold">Shop By <span class="text-purple">Category</span></h>
                </div>
            </div>
            <div class="row align-items-stretch mt-5 justify-content-center">
                @foreach($categories as $cat)
                    <div class="col-lg-3 col-md-4 col-sm-6 mt-4">
                        <a href="javascript:;" class="btn btn-light py-4 px-3 text-center wow animated fadeInDown h-100 w-100 shadow-sm"><i class="{{$cat->icon}}"></i>{{$cat->name}}</a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

@endsection
