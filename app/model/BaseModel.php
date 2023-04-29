<?php

namespace app\model;

use think\Model;

class BaseModel extends Model
{

    public function prefixImgUrl($value, $data)
    {
        if ($data['from'] === 1) {
            return config('setting.img_prefix').$value;
        }
        return $value;
    }

    public function prefixFileUrl($value, $data)
    {
        if ($data['from'] === 1) {
            return config('setting.file_prefix').$value;
        }
        return $value;
    }

}