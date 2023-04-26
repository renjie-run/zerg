<?php
namespace app\controller\v2;

use app\BaseController;
use app\exception\BannerMissingException;
use app\validate\IdMustBePositiveInt;
use app\model\Banner as BannerModel;

class Banner extends BaseController
{
  /**
   * 根据 id 获取 Banner
   */
  public function getBannerById($id) {
    return json('this is version 2!');
  }
}
