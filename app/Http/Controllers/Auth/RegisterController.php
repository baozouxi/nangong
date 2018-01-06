<?php

namespace App\Http\Controllers\Auth;

use App\Agent;
use App\Capital;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            //            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agent' => 'nullable|numeric|exists:agents,id',
            'phone'    => [
                'required',
                'min:11',
                'regex:/^1\d{1}\d{1}\d{8}/',
                'unique:users',
            ],
        ], [
            'username.unique'    => '用户名已经存在',
            'password.confirmed' => '两次密码输入不一致，请重试',
            'phone.unique'       => '电话已经存在',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {

        try {
            $user = DB::transaction(function () use ($data) {
                $user = User::create([
                    'username' => $data['username'],
                    'phone'    => $data['phone'],
                    'password' => bcrypt($data['password']),
                    'money_password' => bcrypt('12345678'),
                ]);

                $user->capital()->create([
                    'money' => 0.00,
                ]);

                if ($data['agent']) {
                    $agent =  Agent::find($data['agent']);
                    $agent->followers()->attach([
                        'user_id' => $user->id,
                    ]);
                }


                return $user;
            });




            return $user;
        } catch (\Exception $exception) {
            throw  $exception;
        } catch (\Throwable $e) {
            Log::error('用户注册失败'.$e->getMessage());

            return $e->getMessage();
        }
    }


    protected function registered(Request $request, $user)
    {

        $user->login()->create();

        return ['status' => '1', 'info' => '注册成功'];
    }
}
