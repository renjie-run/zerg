<?php

namespace app\model;

class Product extends BaseModel
{
    protected $hidden = [
        'create_time', 'update_time', 'pivot', 'delete_time', 'from',
    ];

    public function imgs()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')
            ->order('order', 'asc');
    }

    public function properties()
    {
        return $this->hasMany(ProductProperty::class, 'product_id', 'id');
    }

    public function getMainImgUrlAttr($value, $data) {
        return $this->prefixImgUrl($value, $data);
    }

    public function getMostRecent($count)
    {
        $hidden = array_merge($this->hidden, [ 'summary' ]);
        return self::limit($count)->order('create_time', 'desc')->hidden($hidden)->select();
    }

    public function getProductsByCategories($categoryId)
    {
        return self::where('category_id', '=', $categoryId)->select();
    }

    public function getProductById($id)
    {
        return self::with([ 'imgs.imgUrl', 'properties' ])->find($id);
    }

}
