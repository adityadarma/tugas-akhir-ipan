<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {        
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }
    
    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|alphaNum',
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')
                            ->withErrors($validator)
                            ->withInput()
                            ->with('alert','Email/Password tidak boleh kosong!');
        }
        $credentials = $request->only('email', 'password');

        if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'deleted_at' => null]))
        {
            return redirect()->route('index');
        }
        
        return redirect()->route('login')->withInput()->with('alert','Email/Password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
