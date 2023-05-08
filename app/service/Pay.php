<?php

namespace app\service;

use app\enum\OrderStatusEnum;
use app\exception\OrderException;
use app\exception\TokenException;
use think\Exception;
use app\model\Order as OrderModel;
use app\service\Order as OrderService;
use app\service\Token as TokenService;

class Pay
{
    private $orderId;
    private $orderNO;

    function __construct($orderId)
    {
        if (!$orderId) {
            throw new Exception('订单 ID 不能为空');
        }
        $this->orderId = $orderId;
    }

    public function pay()
    {
        // 检测订单是否存在
        // 订单与相应的用户是否匹配
        // 订单是否已支付
        // 库存检测
        $this->checkOrderValid();
        $status = (new OrderService())->checkOrderStock($this->orderId);
        if (!$status['pass']) {
            return $status;
        }
        // TODO:
    }

    private function makeWxPreOrder()
    {

    }

    public function checkOrderValid()
    {
        $order = OrderModel::where('id', '=', $this->orderId)->find();
        if (!$order) {
            throw new OrderException();
        }
        if (!TokenService::isValidOperate($order->user_id)) {
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                '$err_code' => 10003,
            ]);
        }
        if ($order->status != OrderStatusEnum::UNPAID) {
            throw new OrderException([
               'code' => 400,
               'msg' => '订单已支付',
                'err_code' => 8003,
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }
}
