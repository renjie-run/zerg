<?php
namespace app\controller\v1;

use app\BaseController;
use app\validate\IdMustBePositiveInt;

class Banner extends BaseController
{
  /**
   * 根据 id 获取 Banner
   */
  public function getBannerById($id) {
    (new IdMustBePositiveInt())->goCheck();
  }
}
