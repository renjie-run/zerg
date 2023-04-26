<?php

namespace app\model;

use think\Model;

class BaseModel extends Model
{

    public function prefixUrl($value, $data, $type) {
        if ($data['from'] === 1) {
            if ($type === 'image') {
                return config('setting.img_prefix').$value;
            }
            if ($type === 'file') {
                return config('setting.file_prefix').$value;
            }
        }
        return $value;
    }

}