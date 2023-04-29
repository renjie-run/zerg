<?php

namespace app\validate;

class Count extends BaseValid
{
    protected $rule = [
        'count' => 'isPositiveInt|between:1,15',
    ];

    protected $message = [
      'count' => 'count 必须是 1-15 之间的正整数',
    ];

}