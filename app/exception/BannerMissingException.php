<?php

namespace app\exception;

class BannerMissingException extends BaseException
{

    public $code = 404;
    public $msg = 'the banner is not exist';
    public $err_code = 40000;
}
