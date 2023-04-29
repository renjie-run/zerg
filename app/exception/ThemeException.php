<?php

namespace app\exception;

class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = 'theme is not exist';
    public $err_code = 30000;
}