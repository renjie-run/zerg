<?php

namespace app\service;

use app\exception\WechatException;
use think\Exception;

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
        return 'token';
    }

    private function processWxException($wxResult)
    {
        throw new WechatException([
            'msg' => $wxResult['errmsg'],
            '$err_code' => $wxResult['errcode'],
        ]);
    }

}
