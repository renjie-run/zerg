<?php
namespace app\controller\v1;

use app\BaseController;

class Banner extends BaseController
{
  /**
   * 根据 id 获取 Banner
   */
  public function getBannerById() {
    return 'banner';
  }
}