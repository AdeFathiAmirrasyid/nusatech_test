<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function index()
    {
        return view('login.index',);
    }
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('loginError', 'Login failed!');
    }


    public function register()
    {
        return view('register.index',);
    }
    public function storeRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['_token'] = $request->except(['_token']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['status'] = 'registered';
        $user = User::create($validatedData);
        event(new Registered($user));
        auth()->login($user);

        return redirect('/login')->with('success','Registration successfull! Please login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
