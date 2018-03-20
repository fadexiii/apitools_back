<?php
/**
 * Created by PhpStorm.
 * User: kx
 * Date: 2018/2/27
 * Time: 11:18
 */

use Illuminate\Support\Facades\Validator;

if (!function_exists('result')) {
    function result($code = 0, $mes = '')
    {
        if(isset(config('message')[$code])){
            $mes = config('message')[$code];
        }
        return \Illuminate\Http\Response::create(['mes' => $mes, 'code' => $code]);
    }
}

if (!function_exists('valida')) {
    function valida($all, $rule, $message = null)
    {
        if (is_null($message)) {
            $validator = Validator::make($all, $rule);
            if ($validator->fails()) {
                $result = '';
                foreach ($validator->messages()->toArray() as $val) {
                    foreach ($val as $v) {
                        $result = $result . $v . ';';
                    }
                }
                return $result;
            }else {
                return false;
            }
        }else {
                $validator = Validator::make($all, $rule, $message);
                if ($validator->fails()) {
                    $result = '';
                    foreach ($validator->messages()->toArray() as $val) {
                        foreach ($val as $v) {
                            $result = $result . $v . ';';
                        }
                    }
                    return $result;
                }else {
                    return false;
                }
        }
    }
}