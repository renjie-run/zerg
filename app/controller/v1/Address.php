<?php

namespace app\controller\v1;

use app\BaseController;
use app\exception\SuccessMessage;
use app\exception\UserException;
use app\model\User as UserModel;
use app\validate\Address as AddressValidate;
use app\service\Token as TokenService;

class Address extends BaseController
{

    public function createOrUpdateAddress()
    {
        $validate = new AddressValidate();
        $validate->goCheck();

        // 根据 token 获取 uid
        // 根据 uid 判断是否存在该用户，不存在抛出异常
        // 判断用户是否存在地址，如果不存在则新增一条地址记录，否则更新对应的地址信息。说明：这里用户和地址是“一对一”的关系。
        $uid = TokenService::getCurrentUid();
        $user = UserModel::find($uid);
        if (!$user) {
            throw new UserException();
        }
        $validInput = $validate->getAddressDataByRule(input('post.'));
        $userAddress = $user->address;
        if (empty($userAddress)) {
            $user->address()->save($validInput);
        } else {
            $user->address->save($validInput);
        }

        return $this->jsonReturn(new SuccessMessage(), 201);
    }
}