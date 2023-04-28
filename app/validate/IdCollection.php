<?php

namespace app\validate;

class IdCollection extends BaseValid
{
    protected $rule = [
        'ids' => 'require|checkIds',
    ];

    protected $message = [
        'ids' => 'ids 必须是以逗号分割的多个正整数',
    ];

    protected function checkIds($value)
    {
        $ids = explode(',', $value);
        if (empty($ids)) {
            return false;
        }
        foreach ($ids as $id) {
            if ($id && !$this->isPositiveInt($id)) {
                return false;
            }
        }
        return true;
    }
}