<?php

return [
    'app_id' => env('wx.app_id', ''),
    'app_secret' => env('wx.app_secret', ''),
    'login_url' => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code'
];
