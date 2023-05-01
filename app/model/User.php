<?php

namespace app\model;

class User extends BaseModel
{

    public function getUserByOpenid($openid)
    {
        return self::where('openid', '=', $openid);
    }

}