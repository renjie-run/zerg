<?php
declare (strict_types = 1);

namespace app\middleware;

use app\enum\ScopeEnum;
use app\exception\ForbiddenException;
use app\exception\TokenException;
use app\service\Token as TokenService;
use think\Exception;

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
        $scope = TokenService::getCurrentTokenVar('scope');
        if (empty($scope)) {
            throw new TokenException();
        }
        if ($scope < ScopeEnum::User) {
            throw new ForbiddenException();
        }
        return $next($request);
    }
}
