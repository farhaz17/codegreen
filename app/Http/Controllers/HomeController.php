<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetails;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $id = $user->id;
        $user_details = UserDetails::where('user_id', $id)->first();
        return view('home')->with('details', $user_details);
    }

    public function edit(Request $request)
    {
        $user_details = UserDetails::where('user_id', $request->user_id)->first();
        return view('edit')->with('details', $user_details);
    }

    public function update(Request $request)
    {
        $user_details = UserDetails::where('user_id', $request->user_id)->first();
        $user_details->email = $request->email;
        $user_details->dob = $request->dob;
        $user_details->city = $request->city;
        $user_details->save();

        return redirect()->route("home");
    }
}
