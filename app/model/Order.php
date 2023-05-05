<?php

namespace app\model;

class Order extends BaseModel
{
    protected $hidden = [ 'delete_time', 'update_time' ];
}
