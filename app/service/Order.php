<?php

namespace app\service;

use app\exception\OrderException;
use app\model\Product as ProductModel;

class Order
{
    protected $oProducts;
    protected $products;
    protected $uid;

    public function place($uid, $oProducts)
    {
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
        $status = $this->getOrderStatus();
        if (!$status['pass']) {
            $status['order_id'] = -1;
            return $status;
        }

    }

    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray' => [],
        ];
        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus($oProduct['product_id'], $oProduct['count'], $this->products);
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    private function getProductStatus($oPId, $oCount, $products)
    {
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'name' => '',
            'count' => 0,
            'totalPrice' => 0,
            'haveStock' => false,
        ];
        for ($i = 0; $i < count($products); $i++) {
            if ($products[$i]['id'] == $oPId) {
                $pIndex = $i;
                break;
            }
        }

        // 客户端所给 id 对应的商品可能不存在
        if ($pIndex == -1) {
            throw new OrderException([
                'msg' => 'id 为'.$oPId.'的商品不存在',
            ]);
        } else {
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if ($product['stack'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
            return $pStatus;
        }
    }

    private function getProductsByOrder($oProducts)
    {
        $oPIds = [];
        foreach ($oProducts as $oProduct) {
            array_push($oPIds, $oProduct[ 'product_id' ]);
        }
        return ProductModel::select($oPIds)
            ->visible([ 'id', 'price', 'stock', 'name', 'main_img_url' ])
            ->toArray();
    }
}
