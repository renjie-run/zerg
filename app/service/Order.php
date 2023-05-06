<?php

namespace app\service;

use app\exception\OrderException;
use app\model\Product as ProductModel;
use app\model\UserAddress as UserAddressModel;
use app\model\Order as OrderModel;
use app\model\OrderProduct as OrderProductModel;
use think\Exception;

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
        $orderSnap = $this->snapOrder($status);
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;
    }

    private function createOrder($snap)
    {
        try {
            $orderNo = $this->makeOrderNo();
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->save();

            $orderId = $order->id;
            $createTime = $order->create_time;
            foreach ($this->oProducts as &$oProduct) {
                $oProduct['order_id'] = $orderId;
            }

            $orderProduct = new OrderProductModel();
            $orderProduct->saveAll($this->oProducts);

            return [
                'order_no' => $orderNo,
                'order_id' => $orderId,
                'create_time' => $createTime,
            ];
        } catch (\Exception $ex) {
            throw new Exception($ex);
        }
    }

    private function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        return $yCode[intval(date('Y')) - 2023].strtoupper(dechex(date('m'))).date('d').substr(microtime(), 2, 5).sprintf('%02d', rand(0, 99));
    }

    private function snapOrder($status)
    {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' => '',
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];

        if (count($this->products) > 1) {
            $snap['snapName'] .= '等';
        }

        return $snap;
    }

    private function getUserAddress()
    {
        return UserAddressModel::where('user_id', '=', $this->uid)->select()->toArray();
    }

    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatusArray' => [],
        ];
        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus($oProduct['product_id'], $oProduct['count'], $this->products);
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
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
            if ($product['stock'] - $oCount >= 0) {
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
