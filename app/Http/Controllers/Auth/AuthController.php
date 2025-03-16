<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Interfaces\Auth\AuthInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\RoleRedirectService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthController extends Controller
{
    private $auth;
    public function __construct(AuthInterface $auth){
        $this->auth = $auth;
    }

    public function login(){
        if (Auth::check()) {
//            return redirect('/dashboard');
        }
        return view('auth.login');
    }

     public function register(){
        return view('auth.register');
     }


    public function signin(LoginRequest $request){

//        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//            return redirect()->route('home')->with('success', 'Login successful!');
//        }
        $request->authenticate();


        $user = auth()->user();



        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();


        if (session()->has('cart')) {
            $this->transferSessionCartToDatabase($user->id);
        }

        $roleRedirectService = new RoleRedirectService();

        $redirectRoute = $roleRedirectService->getRedirectRoute($user->type);

        return redirect($redirectRoute);



    }

    public function showOtpForm(){
        return view('auth.verify-otp');

    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ], [
            'otp.required' => 'OTP is required.',
        ]);

        $inputOtp = $request->input('otp');

        $tokenRecord = DB::table('password_reset_tokens')
            ->where('token', $inputOtp)
            ->first();

        if (!$tokenRecord) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if (Carbon::parse($tokenRecord->created_at)->addMinutes(5)->isPast()) {
            DB::table('password_reset_tokens')
                ->where('email', $tokenRecord->email)
                ->where('token', $inputOtp)
                ->delete();

            return redirect()->back()->withErrors(['otp' => 'OTP has expired.']);
        }

        // ✅ Get email from session
        $email = session('auth_email');

        if (!$email) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired, please log in manually.']);
        }

        // ✅ Find user and log in
        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::login($user);

            // ✅ Clear OTP record after successful login
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            // ✅ Handle cart transfer if exists
            if (session()->has('cart')) {
                $this->transferSessionCartToDatabase($user->id);
            }

            $roleRedirectService = new RoleRedirectService();
            $redirectRoute = $roleRedirectService->getRedirectRoute($user->type);

            return redirect($redirectRoute)->with('success', 'OTP Verified & Logged In Successfully');
        }

        return redirect()->route('login')->withErrors(['otp' => 'User not found.']);
    }



    public function signup(RegisterRequest $request){

        $user = $this->auth->register($request->all());

        if($user){
            $token = rand(100000, 999999);

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
                Mail::send('login-send', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject(' Login Credentials here');
                });
            return redirect()->route('password.otp.send');
        }
    }

    public function logout(Request $request){


        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout successfully');
    }

    private function transferSessionCartToDatabase($userId)
    {

        $cart = session()->get('cart', []);
        $buyerId = getLoggedUserId();

        foreach ($cart as $productId => $cartItem) {

            $product = Product::where('id', $productId)->first();

            if ($product) {
                Cart::updateOrCreate(
                    ['buyer_id' => $buyerId, 'product_id' => $product->id],
                    [
                        'quantity' => DB::raw("quantity + {$cartItem['quantity']}"),
                        'price' => $product->price
                    ]
                );
            }
        }

        session()->forget('cart');
    }


}
