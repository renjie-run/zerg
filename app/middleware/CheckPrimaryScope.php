<?php
declare (strict_types = 1);

namespace app\middleware;

use app\exception\ForbiddenException;
use app\exception\TokenException;
use app\service\Token as TokenService;

class CheckPrimaryScope
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return Response
     * @throws ForbiddenException
     * @throws TokenException
     */
    public function handle($request, \Closure $next)
    {
        TokenService::checkPrimaryScope();
        return $next($request);
    }
}
