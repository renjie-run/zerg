<?php

namespace app\service;

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
        $result = json_decode($sResult, true);
        return 'token';
    }

}
