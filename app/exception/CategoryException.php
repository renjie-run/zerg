<?php

namespace app\exception;

class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = 'category is not exist';
    public $err_code = 50000;
}