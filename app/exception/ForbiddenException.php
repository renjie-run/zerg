<?php

namespace app\exception;

class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不足';
    public $err_code = 10001;
}
