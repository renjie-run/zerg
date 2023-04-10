<?php

namespace app\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class ExceptionHandle extends Handle
{
    public function render($request, Throwable $e): Response
    {
        return json('custom exception handle');
//        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}
