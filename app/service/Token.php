<?php

namespace app\service;

class Token
{
    public function generateToken()
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
}