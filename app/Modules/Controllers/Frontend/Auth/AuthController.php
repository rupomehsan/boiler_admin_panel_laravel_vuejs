<?php

namespace App\Modules\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{

    public function LoginPage()
    {
        return Inertia::render('Auth/Login', [
            'event' => [
                'title' => 'Login Page',
            ]
        ]);
    }
    public function RegisterPage()
    {
        return Inertia::render('Auth/Register', [
            'event' => [
                'title' => 'Register Page',
            ]
        ]);
    }
    public function ForgotPassword()
    {
        return Inertia::render('Auth/RecoverPassword/ForgotPassword', [
            'event' => [
                'title' => 'ForgotPassword Page',
            ]
        ]);
    }
    public function VerifyCode()
    {
        return Inertia::render('Auth/RecoverPassword/VerifyCode', [
            'event' => [
                'title' => 'VerifyCode Page',
            ]
        ]);
    }
    public function ResetPassword()
    {
        return Inertia::render('Auth/RecoverPassword/ResetPassword', [
            'event' => [
                'title' => 'ResetPassword Page',
            ]
        ]);
    }
}
