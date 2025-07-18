<?php
    
    namespace addons\carswxsys\service;
    
    use addons\carswxsys\lib\enum\ScopeEnum;
    use addons\carswxsys\lib\exception\TokenException;
    use addons\carswxsys\lib\exception\WeChatException;
    use addons\carswxsys\model\User;
    use addons\carswxsys\service\Curl as CurlService;
    use think\Exception;


    /**
     * 微信登录
     */
    class UserToken extends Token
    {
        protected $code;
        protected $wxLoginUrl;
        protected $wxAppID;
        protected $wxAppSecret;
        protected $curlService;
        
        
        function __construct($code)
        {
            $this->code = $code;
            
            $config = get_addon_config('carswxsys');
            $this->wxAppID = $config['wxappid'];
            $this->wxAppSecret = $config['wxappsecret'];
            $login_url = "https://api.weixin.qq.com/sns/jscode2session?" . "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code";
            $this->curlService = new CurlService();
            $this->wxLoginUrl = sprintf($login_url, $this->wxAppID, $this->wxAppSecret, $this->code);
        }
        
        
        /**
         * 登陆
         */
        public function get()
        {
            $result = $this->curlService->curl_get($this->wxLoginUrl);
            
            // 注意json_decode的第一个参数true
            // 这将使字符串被转化为数组而非对象
            
            $wxResult = json_decode($result, true);
            if (empty($wxResult)) {
                // 为什么以empty判断是否错误，这是根据微信返回
                // 规则摸索出来的
                // 这种情况通常是由于传入不合法的code
                throw new Exception('获取session_key及openID时异常，微信内部错误');
            } else {
                // 建议用明确的变量来表示是否成功
                // 微信服务器并不会将错误标记为400，无论成功还是失败都标记成200
                // 这样非常不好判断，只能使用errcode是否存在来判断
                $loginFail = array_key_exists('errcode', $wxResult);
                
                
                if ($loginFail) {
                    
                    
                    //   $this->processLoginError($wxResult);
                    
                    return false;
                    
                } else {
                    return $this->grantToken($wxResult);
                }
            }
        }
        
        
        // 判断是否重复获取

        private function grantToken($wxResult)
        {
            
            $openid = $wxResult['openid'];
            
            $session_key = $wxResult['session_key'];
            
            
            cache('session_key', $session_key, 7200);
            $user = User::getByOpenID($openid);
            if (!$user)
                // 借助微信的openid作为用户标识
                // 但在系统中的相关查询还是使用自己的uid
            {
                $uid = $this->newUser($openid);
            } else {
                $uid = $user->id;
            }
            $cachedValue = $this->prepareCachedValue($wxResult, $uid);
            $token = $this->saveToCache($cachedValue);
            return $token;
        }
        
        // 处理微信登陆异常
        // 那些异常应该返回客户端，那些异常不应该返回客户端
        // 需要认真思考

        private function newUser($openid)
        {
            
            $user = User::create(['openid' => $openid]);
            
            
            return $user->id;
        }
        
        // 写入缓存

        private function prepareCachedValue($wxResult, $uid)
        {
            $cachedValue = $wxResult;
            $cachedValue['uid'] = $uid;
            $cachedValue['scope'] = ScopeEnum::User;
            return $cachedValue;
        }
        
        // 颁发令牌
        
        private function saveToCache($wxResult)
        {
            $key = self::generateToken($wxResult);
            $value = json_encode($wxResult);
            $expire_in = 7200;
            $result = cache($key, $value, $expire_in);
            
            if (!$result) {
                throw new TokenException(['msg' => '服务器缓存异常', 'errorCode' => 10005]);
            }
            return $key;
        }
        
        private function duplicateFetch()
        {
            //TODO:目前无法简单的判断是否重复获取，还是需要去微信服务器去openid
            //TODO: 这有可能导致失效行为
        }
        
        // 创建新用户

        private function processLoginError($wxResult)
        {
            
            
            throw new WeChatException(['msg' => $wxResult['errmsg'], 'errorCode' => $wxResult['errcode']]);
        }
    }
