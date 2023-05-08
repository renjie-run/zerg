<?php

namespace app\controller\v1;

use app\BaseController;
use app\validate\IdMustBePositiveInt;

class Pay extends BaseController
{

    public function getPreOrder($orderId)
    {
        (new IdMustBePositiveInt())->goCheck();
    }
}