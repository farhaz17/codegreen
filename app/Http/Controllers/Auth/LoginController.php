<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password'  => 'required|alphaNum|min:3'
        ]);

        if (auth()->attempt(request(['username', 'password'])) == false) {
            return back()->with('message', 'The email or password is incorrect, please try again');
        }

        return redirect()->to('/home');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->to('/login');
    }
}
