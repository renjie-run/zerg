<?php

namespace app\model;


use think\facade\Db;

class Banner
{
    public static function getBannerById($id)
    {
        $result = Db::table('banner_item')->where('banner_id', $id)->select();
        return $result;
    }
}
