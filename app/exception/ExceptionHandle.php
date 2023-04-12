<?php

namespace app\exception;

use think\exception\Handle;
use think\facade\Request;
use think\Response;
use Throwable;

class ExceptionHandle extends Handle
{
    protected $ignoreReport = [
        BaseException::class,
    ];

    private $code;
    private $msg;
    private $err_code;

    public function render($request, Throwable $e): Response
    {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->err_code = $e->err_code;
        } else {
            if (env('APP_DEBUG')) {
                return parent::render($request, $e);
            }
            $this->code = 500;
            $this->msg = 'internal server error';
            $this->err_code = 999;
        }
        $url = Request::url();
        $result = [
            'msg' => $this->msg,
            'err_code' => $this->err_code,
            'url' => $url,
        ];
        return json($result, $this->code);
    }

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }
}
