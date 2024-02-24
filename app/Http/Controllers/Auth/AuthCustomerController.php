<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginView()
    {
        return view('frontend.auth.login');
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
                $query->where('role', 'customer');
            }
        ]);

        if ($attempt) {
            return to_route('frontend.index');
        }

        return redirect()->back();
    }

    public function registerView()
    {
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'full_name' => ['required', 'max:191'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ]);

        $customer = User::create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => 'customer'
        ]);

        Auth::login($customer);

        return to_route('frontend.index');
    }
}
