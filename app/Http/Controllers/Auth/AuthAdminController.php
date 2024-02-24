<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginView()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $attempt = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => function ($query) {
                $query->where('role', 'admin');
            }
        ]);

        if ($attempt) {
            return to_route('backend.index');
        }

        return redirect()->back();
    }
}
