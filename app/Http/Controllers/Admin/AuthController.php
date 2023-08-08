<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Webup\HeliumCore\Traits\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('pages.admin.admin_users.login');
    }

    public function redirectPath()
    {
        return route('admin::admin_users.index');
    }
}
