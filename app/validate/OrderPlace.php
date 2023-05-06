<?php

namespace app\validate;

use app\exception\ParameterException;

class OrderPlace extends BaseValid
{
//    $products = [
//        [
//            'product_id' => 1,
//            'count' => 3
//        ],
//    ];
    protected $rule = [
        'products' => 'checkProducts',
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInt',
        'count' => 'require|isPositiveInt',
    ];

    protected function checkProducts($values)
    {
        if (!is_array($values)) {
            throw new ParameterException([
                'msg' => '商品参数格式异常，要求是数组',
            ]);
        }
        if (empty($values)) {
            throw new ParameterException([
                'msg' => '商品列表不能为空',
            ]);
        }
        foreach ($values as $value) {
            $this->checkProduct($value);
        }
        return true;
    }

    protected function checkProduct($value)
    {
        $validate = new BaseValid();
        $result = $validate->batch()->check($value, $this->singleRule);
        if (!$result) {
            throw new ParameterException([
                'msg' => 'product_id 或 count 要求是正整数',
            ]);
        }
    }
}
