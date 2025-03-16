@extends('front.layouts.app')
@section('title','Login')

@section('content')
    <section class="signup wow animated fadeInDown position-relative py-5">
        <div class="container position-relative z-1">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="bg-white shadow-sm p-4 rounded-2 wow animated fadeInDown">
                        <h3 class="h3 fw-bold pb-1">Log In</h3>
                        <hr />
                        <form action="{{route('signin')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 my-3">

                                    <label class="form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control p-3 rounded-pill shadow-none" name="email" value="{{ old('email') }}" placeholder="Example: johndoe@test.com" />
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-12 my-3">
                                    <label class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control p-3 rounded-pill shadow-none" name="password" placeholder="Example: Minimum 8 Characters" />
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 my-3">
                                    <a href="{{route('forgot.password')}}" class="text-purple">Forget Your Password?</a>
                                </div>
                                <div class="col-12 my-3">
                                    <button type="submit" class="btn btn-blue p-3 w-100 rounded-pill fs-5">Next</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
