<?php

namespace app\controller\v1;

use app\BaseController;
use app\exception\ThemeException;
use app\validate\IdCollection;
use app\model\Theme as ThemeModel;
use app\validate\IdMustBePositiveInt;

class Theme extends BaseController
{

    /**
     * 根据指定 id 获取主题
     * @HTTP GET
     * @url /theme?$ids=id1,id2,...
     * @param $ids themes 的 id 列表字符串
     * @return \think\response\Json: themes
     */
    public function getThemesByIds($ids = '')
    {
        (new IdCollection())->goCheck();
        $ids = explode(',', $ids);
        $themes = ThemeModel::with([ 'topicImg', 'headImg' ])->select($ids);
        if ($themes->isEmpty()) {
            throw new ThemeException();
        }
        return json($themes);
    }

    public function getThemeProducts($id)
    {
        (new IdMustBePositiveInt())->goCheck();
        $themeProducts = (new ThemeModel())->getThemeProducts($id);
        if (!$themeProducts) {
            throw new ThemeException();
        }
        return json($themeProducts);
    }
}