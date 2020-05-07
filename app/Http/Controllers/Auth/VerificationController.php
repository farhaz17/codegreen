<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use App\UserDetails;
use App\User;
use Illuminate\Http\Request;
use Session;

class VerificationController extends Controller
{
    protected function index()
    {
        // return view('auth.otp');
    }

    protected function verify(Request $request)
    {
        $user_details = UserDetails::where('user_id', $request->user_id)->first();
        $real_otp = $user_details->otp;

        if($real_otp == $request->otp) {
            $user_details->verified = 1;
            $user_details->save();

            $user = User::where('id', $request->user_id)->first();
            auth()->login($user);
            return redirect()->route("home");
        }

        Session::put('message', "Incorrect OTP");
        return view('auth.otp')->with('user_id', $request->user_id);
    }
}
