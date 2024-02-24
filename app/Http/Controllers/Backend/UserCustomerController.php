<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserCustomerController extends Controller
{
    public function index()
    {
        $users_customer = User::where('role', 'customer')->get();

        return view('backend.sections.users_customer.index', compact('users_customer'));
    }

    public function create()
    {
        return view('backend.sections.users_customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ]);

        User::create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => 'customer'
        ]);

        return to_route('users_customer.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $user_customer = User::find($id);

        return view('backend.sections.users_customer.edit', compact('user_customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'full_name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'min:6']
        ]);

        $user_customer = User::find($id);
        $user_customer->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email')
        ]);

        if ($request->get('password')) {
            $user_customer->update([
                'password' => bcrypt($request->get('password'))
            ]);
        }

        return to_route('users_customer.index')->with('flash', 'Registro actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $user_customer = User::find($id);
        $user_customer->delete();

        return to_route('users_customer.index')->with('flash', 'Registro eliminado exitosamente!');
    }
}
