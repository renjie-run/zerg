<?php

namespace app\validate;

use app\exception\ParameterException;
use think\Validate;

class BaseValid extends Validate
{
    /**
     * @throws ParameterException
     */
    public function goCheck()
    {
        // 获取参数
        $params = request()->param();
        // 验证参数
        $result = $this->batch()->check($params);
        if (!$result) {
            $e = new ParameterException([
                'msg' => $this->error,
            ]);
            throw $e;
        }
        return true;
    }
}
