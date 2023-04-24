<?php

namespace app\model;

use think\facade\Db;
use think\Model;

class Banner extends Model
{
    protected $hidden = [
        'delete_time', 'update_time'
    ];

    public function items() {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public function getBannerById($id)
    {
        return self::with([ 'items', 'items.img' ])->find($id);
    }
}
