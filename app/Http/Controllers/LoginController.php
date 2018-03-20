<?php
/**
 * Created by PhpStorm.
 * User: kx
 * Date: 2018/2/27
 * Time: 9:59
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\RegularExpression;
use Jwt;
use App\User;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if($result = valida($request->all(),[
            'username' => 'required|max:30',
            'password' => 'required|max:30'
        ],[
            'username.required' => '用户名不能为空',
            'username.max' => '用户名长度不能超过30个字符',
            'password.required' => '密码不能为空',
            'password.max' => '密码长度不能超过30个字符'
        ])){
            return result(-1, $result);
        }
        $user = User::where('username', '=', $request->get('username'))->first();
        if(!$user){
            return result(10001);
        }

        if(!password_verify($request->get('password'), $user['password'] )){
            return result(10002);
        }
        $token = Jwt::fromUser($user);

        $data = [
            'username' => $user['username'],
            'token' => $token,
            'ttl' => 3600
        ];

        return $data;
    }

    public function test(Request $request)
    {
        return 1;
    }
}