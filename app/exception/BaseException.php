<?php

namespace app\exception;

use think\Exception;

class BaseException extends Exception
{

    public $code = 400;                   // HTTP 状态码
    public $msg = 'invalid parameter(s)'; // 错误信息
    public $err_code = '10000';           // 自定义错误码

    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return;
        }

        if (key_exists('code', $params)) {
            $this->code = $params['code'];
        }

        if (key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }

        if (key_exists('err_code', $params)) {
            $this->err_code = $params['err_code'];
        }
    }
}
