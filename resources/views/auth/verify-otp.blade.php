@extends('front.layouts.app')
@section('title','OTP')
@section('content')
    <section class="signup wow animated fadeInDown position-relative py-5">
        <div class="container position-relative z-1">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="bg-white shadow-sm p-4 rounded-2 wow animated fadeInDown">
                        <h3 class="h3 fw-bold pb-1">OTP</h3>

                        <hr />
                        <form action="{{route('password.otp.verify')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 my-3">
                                    <label class="form-label">Enter OTP<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" name="otp" placeholder="Example: 1234" />

                                    @if ($errors->has('otp'))
                                        <div class="text-danger p-2">{{ $errors->first('otp') }}</div>
                                    @endif
                                </div>
                                <div class="col-12 my-3">
                                    <p class="text-purple">Resend OTP after (45)</p>
                                </div>
                                <div class="col-12 my-3">
                                    <button type="submit" class="btn btn-blue p-3 w-100 rounded-pill fs-5">Log In</button>
                                </div>
                                {{--                            <div class="col-12 my-3">--}}
                                {{--                                <a href="otp.html" class="btn btn-blue p-3 w-100 rounded-pill fs-5">Log In</a>--}}
                                {{--                            </div>--}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
