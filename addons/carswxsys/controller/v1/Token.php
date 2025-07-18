<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    
   
    use addons\carswxsys\service\UserToken;
    use addons\carswxsys\service\Token as TokenService;
    use addons\carswxsys\service\UserTokenDouyin;
    use addons\carswxsys\validate\TokenGet;
    use addons\carswxsys\lib\exception\ParameterException;

    
    /**
     * 获取令牌，相当于登录
     */
    class Token
    {
        
        
        public function getTokenDouyin()
        {
            (new TokenGet())->goCheck();
            $param = input('post.');
            $code = $param['code'];
            $nickname = $param['nickname']??'';
            $avatar = $param['avatar']??'';
            $wx = new UserTokenDouyin($code, $nickname, $avatar);
            $token = $wx->get();

            $data = array('token' => $token);

            return json_encode($data);

        }
        
        /**
         * 用户获取令牌（登陆）
         * @url /token
         * @POST code
         * @note 虽然查询应该使用get，但为了稍微增强安全性，所以使用POST
         */
        public function getToken()
        {
            (new TokenGet())->goCheck();
            $param = input('post.');
            $code = $param['code'];
            $wx = new UserToken($code);
            $token = $wx->get();
            
            $data = array('token' => $token);
            
            return json_encode($data);
            
        }
        
     
        
        

        
        public function verifyToken()
        {
            
            
            $token = input('post.token');
            
            if (!$token) {
                throw new ParameterException(['token不允许为空']);
            }
            $valid = TokenService::verifyToken($token);
            
            $data = array('isValid' => $valid);
            
            return json_encode($data);
            
            
        }
        
        
        
    }