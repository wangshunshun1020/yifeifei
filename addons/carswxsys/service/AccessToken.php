<?php
    
    namespace addons\carswxsys\service;
    
    use addons\carswxsys\service\Curl as CurlService;
    use think\Exception;

    /*
     * 微信授权类
     */
    
    class AccessToken
    {
        const TOKEN_CACHED_KEY = 'access';
        const TOKEN_EXPIRE_IN = 7000;
        private $tokenUrl;
        
        function __construct()
        {
            
            $config = get_addon_config('carswxsys');
            
            $url = 'https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s';
            
            
            $url = sprintf($url, $config['wxappid'], $config['wxappsecret']);
            
            
            $this->tokenUrl = $url;
        }
        
        // 建议用户规模小时每次直接去微信服务器取最新的token
        // 但微信access_token接口获取是有限制的 2000次/天
        public function get()
        {
            
            
            $token = $this->getFromCache();
            
            
            if (!$token) {
                return $this->getFromWxServer();
            } else {
                return $token;
            }
        }
        
        /*
         * 从缓存里获取token
         */
        private function getFromCache()
        {
            $token = cache(self::TOKEN_CACHED_KEY);
            if (!$token) {
                return $token;
            }
            return null;
        }
        
        private function getFromWxServer()
        {
            $curlService = new CurlService();
            
            $token = $curlService->curl_get($this->tokenUrl);
            
            $token = json_decode($token, true);
            
            
            if (!$token) {
                // throw new Exception('获取AccessToken异常');
                return false;
            }
            if (!empty($token['errcode'])) {
                throw new Exception($token['errmsg']);
            }
            $this->saveToCache($token);
            return $token['access_token'];
        }
        
        private function saveToCache($token)
        {
            cache(self::TOKEN_CACHED_KEY, $token, self::TOKEN_EXPIRE_IN);
        }
        
        
    }