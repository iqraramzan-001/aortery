<h1>Forget Password Email</h1>

<h4>{{ $token }}</h4>

<a class="btn btn-blue p-2 w-50 rounded-pill fs-5" href="{{ route('password.reset', $token) }}">Reset Password</a>
