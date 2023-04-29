<?php

namespace app\exception;

class ThemeMissingException extends BaseException
{
    public $code = 404;
    public $msg = 'the themes not exist';
    public $err_code = 30000;
}