<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as Valid;

class LoginController extends Controller
{
    public function index()
    {
        return response()->view("backend.auth.index",[
            'title' => 'Login - SIPERUM'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:5'
        ],[
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'username.min' => 'Username minimal 5 karakter',
            'password.min' => 'Password minimal 5 karakter',
        ]);
        $credential = $request->only("username","password");
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success","Selamat Datang, " . Auth::user()->name);
        }elseif(Auth::guard("operators")->attempt($credential)){
            $request->session()->regenerate();
            return redirect()->route("dashboard")->with("success","Selamat Datang, " . Auth::guard("operators")->user()->name);
        }
        throw Valid::withMessages(['message' => 'Maaf Email dan Password anda tidak terdaftar']);
    }   

    public function logout()
    {
        if(Auth::guard("operators")->check()){
            Auth::guard("operators")->logout();
            return redirect()->route("login")->with("success","Anda Telah Logout");
        }
        if(Auth::check()){
            Auth::logout();
            return redirect()->route("login")->with("success","Anda Telah Logout");
        }
        return redirect()->route("login")->with("success","Anda Telah Logout");
    }

}
