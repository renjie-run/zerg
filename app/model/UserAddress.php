<?php

namespace app\model;

class UserAddress extends BaseModel
{
    protected $hidden = [
        'delete_time', 'update_time',
    ];
}