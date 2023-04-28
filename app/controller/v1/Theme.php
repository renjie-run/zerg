<?php

namespace app\controller\v1;

use app\BaseController;
use app\validate\IdCollection;

class Theme extends BaseController
{

    /**
     * 根据指定 id 获取主题
     * @HTTP GET
     * @url /theme?$ids=id1,id2,...
     * @param $ids themes 的 id 列表字符串
     * @return themes
     */
    public function getThemesByIds($ids = '')
    {
        (new IdCollection())->goCheck();
        return json('theme');
    }
}