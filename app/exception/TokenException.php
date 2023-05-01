<?php

namespace app\exception;

class TokenException extends BaseException
{
    public $code = 401;
    public $msg = '已过期或无效 Token';
    public $err_code = 10001;
}