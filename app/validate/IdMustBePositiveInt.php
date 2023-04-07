<?php
namespace app\validate;

class IdMustBePositiveInt extends BaseValid
{
    protected $rule = [
        'id' => 'require|isPositiveInt',
    ];

    protected function isPositiveInt($value, $rule, array $data, string $field = '')
    {
        if (is_numeric($value) && is_int($value - 0) && ($value - 0 ) > 0) {
            return true;
        }
        return $field.'必须是正整数';
    }
}
