<?php

namespace app\model;

class Category extends BaseModel
{
    protected $hidden = [ 'delete_time', 'update_time' ];

    public function topicImg() {
        return $this->belongsTo(Image::class, 'topic_img_id', 'id');
    }
}