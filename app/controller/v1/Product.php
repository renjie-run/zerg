<?php

namespace app\controller\v1;

use app\BaseController;
use app\exception\ProductException;
use app\validate\Count;
use app\model\Product as ProductModel;
use app\validate\IdMustBePositiveInt;

class Product extends BaseController
{
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $products = (new ProductModel())->getMostRecent($count);
        if ($products->isEmpty()) {
            throw new ProductException();
        }
        return $this->jsonReturn($products);
    }

    public function getProductsByCategoryId($id)
    {
        (new IdMustBePositiveInt())->goCheck();
        $products = (new ProductModel())->getProductsByCategories($id);
        if ($products->isEmpty()) {
            throw new ProductException();
        }
        return $this->jsonReturn($products);
    }
}