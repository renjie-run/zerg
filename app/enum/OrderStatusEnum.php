<?php

namespace app\enum;

class OrderStatusEnum
{
    const UNPAID = 1; // 待支付
    const PAID = 2; // 已支付
    const DELIVERED = 3; // 已支付已发货
    const PAID_BUT_NOT_OF = 4; // 已支付，但库存不足
}