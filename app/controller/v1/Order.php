<?php

namespace app\controller\v1;

use app\BaseController;
use app\validate\OrderPlace;
use app\service\Order as OrderService;
use app\service\Token as TokenService;

class Order extends BaseController
{
    public function placeOrder()
    {
        // 根据订单信息检查库存
        // 存在库存，将订单写入数据库，通知客户端可以支付订单
        // 调用支付 API，进行支付
        // 支付时再次检查库存
        // 服务器中调用微信支付进行支付
        // 微信返回支付结果（异步）
        // 支付成功后进行库存量检测、然后减去库存
        (new OrderPlace())->goCheck();
        $orderService = new OrderService();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
        $status = $orderService->place($uid, $products);
        return $this->jsonReturn($status);
    }
}
