<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function index()
    {
        return view('admin.index');
    }


    public function loginPost(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|string|exists:admins',
            'password' => 'required|min:6'
        ],[
            'username.reqired' => '请输入用户名',
            'username.exists' => '该用户不存在',
            'password.required' => '请输入密码',
            'password.min' => '密码格式错误'
        ]);


        $admin = Admin::where('username', $request['username'])->first();

        if (!Hash::check($request['password'], $admin->password)) {
            return back()->with(['password'=> '密码错误']);
        }

        session()->push('admin-id', $admin->id);
        session()->push('admin-username', $admin->username);
        return redirect(route('admin.index'));


    }


    public function logout()
    {
        session()->flush();
        return redirect(route('admin.login'));
    }



    //用户列表
    public function users()
    {
        $users = User::with(['capital','cards','bankName', 'login'=>function($query){
            return $query->orderBy('login_time', 'desc')->limit(1);
        }])->get();


        return view('admin.users',compact('users'));

    }



}
