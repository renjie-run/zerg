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

    protected function isPositiveInt($value)
    {
        if (is_numeric($value) && is_int($value - 0) && ($value - 0 ) > 0) {
            return true;
        }
        return false;
    }

    protected function isNotEmpty($value)
    {
        if (empty($value)) {
            return false;
        }
        return true;
    }

    protected function getDataByRule($input)
    {
        $data = [];
        foreach ($this->rule as $key => $value) {
            $data[$key] = $input[$key];
        }
        return $data;
    }
}
