<?php

namespace App\Http\Controllers\Auth;

use App\Events\Authenticated;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'username';
    }


    public function authenticated(\Illuminate\Http\Request $request, $user)
    {

        Event::fire(new Authenticated($user));
        return json_encode(['status' => '1', 'info' => '登录成功']);
    }


    public function messages()
    {
        return ['username' => '用户名不存在'];
    }


}
