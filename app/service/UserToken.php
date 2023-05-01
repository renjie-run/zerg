<?php

namespace app\service;

use app\exception\WechatException;
use think\Exception;
use app\model\User as UserModel;

class UserToken
{
    protected $wxJsCode;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;


    public function __construct($code)
    {
        $this->wxJsCode = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppId, $this->wxAppSecret, $this->wxJsCode);
    }

    public function get()
    {
        $sResult = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($sResult, true);
        if (empty($wxResult)) {
            throw new Exception('获取 session_key 及 openid 异常，微信内部错误');
        }
        if (array_key_exists('errcode', $wxResult)) {
            $this->processWxException($wxResult);
        }
        $uid = $this->grantToken($wxResult);
        return 'token';
    }

    private function grantToken($wxResult)
    {
        // 获得 openid
        $opendid = $wxResult['openid'];

        // 根据 openid 查看 User 表中是否存在对应的记录
        // 如果存在则不处理，不存在则需要在 User 表中插入一条新的记录
        $user = (new UserModel())->getUserByOpenid($opendid);
        if (!$user) {
            $uid = $user->id;
        } else {
            $user = $this->newUser($opendid);
            $uid = $user->id;
        }

        // 生成令牌
        // 准备缓存数据，写入缓存
        // 将令牌返回给客户端
    }

    private function newUser($openid)
    {
        return UserModel::create([
            'openid' => $openid,
        ]);
    }

    private function processWxException($wxResult)
    {
        throw new WechatException([
            'msg' => $wxResult['errmsg'],
            '$err_code' => $wxResult['errcode'],
        ]);
    }

}
