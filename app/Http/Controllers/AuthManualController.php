<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthManualController extends Controller
{
    function index() 
    {   
        return view('manual-auth.login');
    }

    function loginProses(Request $request)
    {   
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (FacadesAuth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('CRUD.index');
        }
        return back();
    }

    function logout(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
