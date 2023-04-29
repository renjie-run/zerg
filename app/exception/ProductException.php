<?php

namespace app\exception;

class ProductException extends BaseException
{
    public $code = 404;
    public $msg = 'product is not exist';
    public $err_code = 20000;
}