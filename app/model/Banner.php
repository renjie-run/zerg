<?php

namespace app\model;

class Banner extends BaseModel
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
