<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $users_admin = User::where('role', 'admin')->get();

        return view('backend.sections.users_admin.index', compact('users_admin'));
    }

    public function create()
    {
        return view('backend.sections.users_admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ]);

        User::create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => 'admin'
        ]);

        return to_route('users_admin.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $user_admin = User::find($id);

        return view('backend.sections.users_admin.edit', compact('user_admin'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'full_name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'min:6']
        ]);

        $user_admin = User::find($id);
        $user_admin->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email')
        ]);

        if ($request->get('password')) {
            $user_admin->update([
                'password' => bcrypt($request->get('password'))
            ]);
        }

        return to_route('users_admin.index')->with('flash', 'Registro actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $user_admin = User::find($id);
        $user_admin->delete();

        return to_route('users_admin.index')->with('flash', 'Registro eliminado exitosamente!');
    }
}
