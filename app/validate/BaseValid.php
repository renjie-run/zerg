<?php

namespace app\validate;

use think\Exception;
use think\Validate;

class BaseValid extends Validate
{
    public function goCheck()
    {
        // 获取参数
        $params = request()->param();
        // 验证参数
        $result = $this->check($params);
        if (!$result) {
            $err = $this->error;
            throw new Exception($err);
        }
        return true;
    }
}
