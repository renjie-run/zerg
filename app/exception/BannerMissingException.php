<?php

namespace app\exception;

class BannerMissingException extends BaseException
{

    public $code = 404;
    public $msg = 'banner to find is not exist';
    public $err_code = 40000;
}
