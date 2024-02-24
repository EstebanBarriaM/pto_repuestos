<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        session()->flush();
        auth()->logout();

        return to_route('frontend.index');
    }
}
