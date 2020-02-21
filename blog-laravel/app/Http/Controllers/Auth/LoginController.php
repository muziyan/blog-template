<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function index()
    {
        return view("admin.login");
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'required'
        ]);

        //验证用户名和密码
        if (Auth::attempt($credentials)) {

            session()->flash('notice', '欢迎回来！');
            return redirect("admin/");

        } else {

            // 登录失败后的相关操作
            session()->flash('error', '很抱歉，您的用户名和密码不匹配');
            return redirect()->back();

        }

    }

    public function logout()
    {
        Auth::logout();
        session()->flash('notice', '您已成功退出！');
        return redirect('login');
    }

    public function username()
    {
        return "username";
    }
}
