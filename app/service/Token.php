<?php

namespace app\service;

use app\exception\TokenException;
use think\Exception;
use think\facade\Cache;
use think\facade\Request;

class Token
{
    public static function generateToken()
    {
        // 使用三组字符串进行 md5 加密
        // str1: 随机 32 位字符
        $str1 = getRandChars(32);

        // str2: timestamp
        $str2 = $_SERVER['REQUEST_TIME_FLOAT'];

        // str3: salt
        $str3 = config('secure.token_salt');
        return md5($str1.$str2.$str3);
    }

    public static function getCurrentTokenVar($key)
    {
        $token = Request::header('token');
        if ($token) {
            $vars = Cache::get($token);
        }
        if (empty($vars)) {
            throw new TokenException();
        }
        if (!is_array($vars)) {
            $vars = json_decode($vars, true);
        }
        if (!array_key_exists($key, $vars)) {
            throw new Exception('要获取的 Token 变量不存在: '.$key);
        }
        return $vars[$key];
    }

    public static function getCurrentUid()
    {
        return self::getCurrentTokenVar('uid');
    }
}