@extends('front.layouts.app')
@section('title','Forgot Password')
@section('content')
    <section class="signup wow animated fadeInDown position-relative py-5">
        <div class="container position-relative z-1">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="bg-white shadow-sm p-4 rounded-2 wow animated fadeInDown">
                        <h3 class="h3 fw-bold pb-1">Forgot Password?</h3>
                        <hr />
                        <form action="{{route('forgot.password.send')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 my-3">
                                    <label class="form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control p-3 rounded-pill shadow-none" name="email" placeholder="Example: johndoe@test.com" />
                                    @if ($errors->has('email'))
                                        <div class="text-danger p-1">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-12 my-3">
                                    <p class="text-purple lh-150">We will send you an email shortly</p>
                                </div>
                                <div class="col-sm-6 my-3">
                                    <a href="{{route('login')}}" class="btn btn-darks p-3 w-100 rounded-pill fs-5">Back to Log In</a>
                                </div>
                                <div class="col-sm-6 my-3">
                                    <button type="submit" class="btn btn-blue p-3 w-100 rounded-pill fs-5">Reset Password</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
