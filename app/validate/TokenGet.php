<?php

namespace app\validate;

class TokenGet extends BaseValid
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];

    protected $message = [
        'code' => 'code 不能为空',
    ];

}