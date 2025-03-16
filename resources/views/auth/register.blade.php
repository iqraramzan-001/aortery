@extends('front.layouts.app')
@section('title','Register')
@section('content')

    <section class="signup wow animated fadeInDown position-relative py-5">
        <div class="container position-relative z-1">
            <div class="row justify-content-end">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="bg-white shadow-sm p-4 rounded-2 wow animated fadeInDown">
                        <h3 class="h3 fw-bold pb-1">Create an Account</h3>
                        <hr />
                        <form action="{{ route('signup') }}" method="post">
                            @csrf
                            <div class="row">
                                {{-- Type Selection --}}
                                <div class="col-12 my-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <strong>Join As:</strong>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input mt-0" type="radio" name="type" id="supplier" value="supplier" {{ old('type') == 'supplier' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="supplier">Supplier</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input mt-0" type="radio" name="type" id="buyer" value="buyer" {{ old('type') == 'buyer' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="buyer">Buyer</label>
                                        </div>
                                    </div>
                                    @error('type')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Company Name --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" name="company_name" value="{{ old('company_name') }}" placeholder="Example: Microsoft" />
                                    @error('company_name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Commercial Registration Number --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Commercial Registration Number<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" name="register_number" value="{{ old('register_number') }}" placeholder="Example: 123456" />
                                    @error('register_number')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email Address --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control p-3 rounded-pill shadow-none" name="email" value="{{ old('email') }}" placeholder="Example: johndoe@test.com" />
                                    @error('email')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Confirm Email Address --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Confirm Email Address<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control p-3 rounded-pill shadow-none" name="confirm_email" value="{{ old('confirm_email') }}" placeholder="Example: johndoe@test.com" />
                                    @error('confirm_email')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control p-3 rounded-pill shadow-none" name="password" placeholder="Example: Minimum 8 Characters" />
                                    @error('password')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div class="col-12 my-3">
                                    <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control p-3 rounded-pill shadow-none" name="confirm_password" placeholder="Example: Minimum 8 Characters" />
                                    @error('confirm_password')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Terms & Conditions --}}
                                <div class="col-12 my-3">
                                    <div class="form-check lh-150 fs-14">
                                        <input class="form-check-input" type="checkbox" value="" id="agree" />
                                        <label class="form-check-label" for="agree">Agree to <a href="terms-conditions.html" class="text-purple">Terms & Conditions</a></label>
                                    </div>
                                </div>

                                {{-- Submit Button --}}
                                <div class="col-12 my-3">
                                    <button class="btn btn-blue p-3 w-100 rounded-pill fs-5">Sign Up</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
