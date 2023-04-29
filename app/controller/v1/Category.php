<?php

namespace app\controller\v1;

use app\BaseController;
use app\exception\CategoryException;
use app\model\Category as CategoryModel;

class Category extends BaseController
{
    public function getAllCategories()
    {
        $categories = CategoryModel::with([ 'topicImg' ])->select();
        if ($categories->isEmpty()) {
            throw new CategoryException();
        }
        return $this->jsonReturn($categories);
    }
}