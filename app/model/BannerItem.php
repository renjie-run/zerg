<?php

namespace app\model;

use think\Model;

class BannerItem extends Model
{
    protected $hidden = [
        'img_id', 'delete_time', 'update_time', 'banner_id'
    ];

    public function img()
    {
        return $this->belongsTo(Image::class, 'img_id', 'id');
    }
}