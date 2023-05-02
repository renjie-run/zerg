<?php

namespace app\model;

class User extends BaseModel
{

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
    }

    public function getUserByOpenid($openid)
    {
        return self::where('openid', '=', $openid)->find();
    }

}
