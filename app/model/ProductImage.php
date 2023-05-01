<?php

namespace app\model;

class ProductImage extends BaseModel
{
    protected $hidden = [ 'delete_time', 'img_id' ];

    public function img()
    {
        return $this->belongsTo(Image::class, 'img_id', 'id');
    }
}
