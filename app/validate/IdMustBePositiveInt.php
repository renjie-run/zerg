<?php
namespace app\validate;

class IdMustBePositiveInt extends BaseValid
{
    protected $rule = [
        'id' => 'require|isPositiveInt',
    ];

    protected $message = [
        'id' => 'id 必须是正整数',
    ];
}
