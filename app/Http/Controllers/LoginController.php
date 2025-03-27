<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credential = $request->only('email', 'password');

        if (FacadesAuth::attempt($credential)) {
            return redirect('dashboard')->with('success', 'Login Success');
        } else {
            return back('login')->with('error', 'Email or Password is not valid, Please check your Credential!')->withInput();
        }
    }

    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->to('login');
    }
}
