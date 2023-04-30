<?php

namespace app\controller\v1;

use app\BaseController;
use app\service\UserToken;
use app\validate\TokenGet;

class Token extends BaseController
{

    public function getToken($code)
    {
        (new TokenGet())->goCheck();
        $token = (new UserToken())->get();
        return $this->jsonReturn($token);
    }
}