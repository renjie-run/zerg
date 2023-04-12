<?php

namespace app\exception;

class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = 'invalid parameter';
    public $err_code = 10000;
}