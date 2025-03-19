<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

// Admin@2005!

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function showRegisterForm()
    {
        return view('login.register');
    }

    public function store(Request $request)
    {
        $userModel = new User();

        $userModel->name = $request['name'];
        $userModel->email = $request['email'];
        $userModel->password = $request['password'];

        $userModel->save();

        return redirect('/admin/product-index');
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($validated)){
            // generate new id session
            $request->session()->regenerate();
            return redirect()->intended('/admin/product-index');
        }else{
            return redirect()->back()->with('error', 'E-mail ou senha inválida.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
