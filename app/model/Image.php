<?php

namespace app\model;

use think\Model;

class Image extends Model
{
    protected $hidden = [
        'delete_time', 'update_time', 'from'
    ];

    public function getUrlAttr($value, $data) {
        if ($data['from'] === 1) {
            return config('setting.img_prefix').$value;
        }
        return $value;
    }

}