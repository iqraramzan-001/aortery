<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ResetPasswordController extends Controller
{





    public function resetPassword($token)
    {
        $otp=$token;
        return view('auth.update-password',[
            'token'=>$otp,
        ]);
    }



     public function updatePassword(UpdatePasswordRequest $request){
         $updatePassword = DB::table('password_reset_tokens')
             ->where([
                 'token' => $request->token
             ])
             ->first();

         $email=$updatePassword->email;

         if(!$updatePassword){
             return back()->withInput()->with('error', 'Invalid token!');
         }

         $user = User::where('email', $email)
             ->update(['password' => Hash::make($request->password)]);

         DB::table('password_reset_tokens')->where(['email'=> $email])->delete();
         if($user){
             return redirect()->route('login')->with('success', 'Your password has been changed!');
         }
         return redirect()->back()->with('error','Something Went Wrong');
     }


}
