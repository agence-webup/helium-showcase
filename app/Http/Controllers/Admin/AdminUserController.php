<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('pages.admin.admin_users.index');
    }

    public function create()
    {
        return view('pages.admin.admin_users.create');
    }

    public function edit($id)
    {
        $user = AdminUser::findOrFail($id);

        return view('pages.admin.admin_users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        $data['password'] = bcrypt(Str::random(16));
        AdminUser::create($data);

        return redirect()->route('admin::admin_users.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'password' => [
                'sometimes',
                'nullable',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        if (Arr::has($data, 'password') && ($data['password'] == null || $data['password'] == '')) {
            unset($data['password']);
        }

        $user = AdminUser::findOrFail($id);
        $user->update($data);
        $user->save();

        return redirect()->route('admin::admin_users.show', $user->id);
    }

    public function destroy($id)
    {
        AdminUser::findOrFail($id)->delete();

        return redirect()->route('admin::admin_users.index');
    }
}
