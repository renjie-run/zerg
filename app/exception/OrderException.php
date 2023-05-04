<?php

namespace app\exception;

class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在';
    public $err_code = 80000;
}
