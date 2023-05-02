<?php

namespace app\validate;

use app\exception\ParameterException;

class Address extends BaseValid
{

    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|mobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty',
    ];

    protected $message = [
        'name' => 'name 不能为空',
        'mobile' => 'mobile 必须是有效的手机号',
        'province' => 'province 不能为空',
        'city' => 'city 不能为空',
        'country' => 'country 不能为空',
        'detail' => 'detail 不能为空',
    ];

    public function getAddressDataByRule($input)
    {
        if (array_key_exists('user_id', $input))
        {
            throw new ParameterException([
                'msg' => '存在非法参数: user_id',
            ]);
        }
        return $this->getDataByRule($input);
    }

}
