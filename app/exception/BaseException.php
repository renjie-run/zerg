<?php

namespace app\exception;

use think\Exception;

class BaseException extends Exception
{

    public $code = 400;                   // HTTP 状态码
    public $msg = 'invalid parameter(s)'; // 错误信息
    public $err_code = '10000';           // 自定义错误码

}