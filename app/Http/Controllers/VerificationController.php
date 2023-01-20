<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function notice()
    {
        return view('verify.index',);
    }   

    public function verify(EmailVerificationRequest $emailVerificationRequest)
    {
        $emailVerificationRequest->fulfill();
        return "Akun berhasil di verifikasi, selamat datang di Dashboard";
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice')->with('success','Verifikasi Email berhasil dikirim, check Email sekarang.');
    }


    public function dashboard()
    {
        $user = User::get();
        return view('dashboard.index',compact('user'));
    }
}
