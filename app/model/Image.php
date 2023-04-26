<?php

namespace app\model;

use think\Model;

class Image extends BaseModel
{
    protected $hidden = [
        'delete_time', 'update_time', 'from'
    ];

    public function getUrlAttr($value, $data) {
        return $this->prefixUrl($value, $data, 'image');
    }

}