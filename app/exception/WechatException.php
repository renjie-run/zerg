<?php

namespace app\exception;

class WechatException extends BaseException
{
    public $code = 400;
    public $msg = '微信接口调用失败';
    public $err_code = 999;
}