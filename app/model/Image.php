<?php

namespace app\model;

use think\Model;

class Image extends Model
{
    protected $hidden = [
        'delete_time', 'update_time', 'from'
    ];

}