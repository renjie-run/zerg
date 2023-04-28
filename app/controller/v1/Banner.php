<?php
namespace app\controller\v1;

use app\BaseController;
use app\exception\BannerMissingException;
use app\validate\IdMustBePositiveInt;
use app\model\Banner as BannerModel;

class Banner extends BaseController
{
  /**
   * 根据 id 获取 Banner
   * @HTTP GET
   * @url /banner/:id
   * @param $id 目标 banner id
   * @return banner
   */
  public function getBannerById($id) {
    (new IdMustBePositiveInt())->goCheck();
    $banner = (new BannerModel())->getBannerById($id);
    if (!$banner) {
        throw new BannerMissingException();
    }
    return json($banner);
  }
}
