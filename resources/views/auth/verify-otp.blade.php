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
                                    <p class="text-purple">Resend OTP after <span id="countdown">45</span> seconds</p>
                                    <button id="resendOtpBtn" class="btn btn-link text-purple" style="display: none;" onclick="resendOtp()">Resend OTP</button>
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
    <script>
        let timer = 45;
        let countdownElement = document.getElementById("countdown");
        let resendBtn = document.getElementById("resendOtpBtn");

        function startCountdown() {
            let countdownInterval = setInterval(() => {
                if (timer > 0) {
                    countdownElement.textContent = timer;
                    timer--;
                } else {
                    clearInterval(countdownInterval);
                    countdownElement.parentElement.style.display = "none"; // Hide countdown text
                    resendBtn.style.display = "block"; // Show Resend button
                }
            }, 1000);
        }

        function resendOtp() {
            fetch("{{ route('password.otp.resend') }}", {
                method: "GET",
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        timer = 45;
                        countdownElement.textContent = timer;
                        countdownElement.parentElement.style.display = "block";
                        resendBtn.style.display = "none";
                        startCountdown();
                    } else {
                        alert("Failed to resend OTP. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        startCountdown();
    </script>
@endsection
