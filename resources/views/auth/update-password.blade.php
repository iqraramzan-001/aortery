@extends('front.layouts.app')
@section('title','New Password')
@section('content')
    <section class="signup wow animated fadeInDown position-relative py-5">
        <div class="container position-relative z-1">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="bg-white shadow-sm p-4 rounded-2 wow animated fadeInDown">
                        <h3 class="h3 fw-bold pb-1">New Password</h3>
                        <hr />
                        <form action="{{route('update.password')}}" method="post">
                            @csrf
                        <div class="row">
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="col-12 my-3">
                                <label class="form-label">New Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control p-3 rounded-pill shadow-none" name="password" placeholder="Example: Minimum 8 Characters" />
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 my-3">
                                <label class="form-label">Confirm New Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control p-3 rounded-pill shadow-none" name="confirm_password" placeholder="Example: Minimum 8 Characters" />
                                @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 my-3">
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
