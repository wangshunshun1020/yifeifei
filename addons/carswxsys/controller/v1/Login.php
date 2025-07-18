<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\model\User as UserModel;
    use addons\carswxsys\service\Token;
    
    class Login extends BaseController
    {
        
        public function checkBindDouyin()
        {
            
            
            $uid = Token::getCurrentUid();
            
           // $ctoken = input('post.ctoken');
          //  $companyid = Token::getCurrentCid($ctoken);
    

            
            $map['id'] = $uid;
            
            $userinfo = UserModel::getByUserWhere($map);
            
            // if ($userinfo['tel'] == '') {
            //     $isbind = false;
            // } else {
                
            //     $isbind = true;
            // }
            // print($userinfo);
            $isbind = false;
            if (!empty($userinfo['openid'])) {
                $isbind = true;
            }
            
            $data = array('isbind' => $isbind);
            return json_encode($data);
            
            
        }
        
        
        public function checkBind()
        {
            
            
            $uid = Token::getCurrentUid();
            
           // $ctoken = input('post.ctoken');
          //  $companyid = Token::getCurrentCid($ctoken);
    

            
            $map['id'] = $uid;
            
            $userinfo = UserModel::getByUserWhere($map);
            
            if ($userinfo['tel'] == '') {
                $isbind = false;
            } else {
                
                $isbind = true;
            }
            
            $data = array('isbind' => $isbind);
            return json_encode($data);
            
            
        }
        
        
        public function userLogin()
        {
            
            $uid = Token::getCurrentUid();
            $tel = input('post.tel');
            $map['tel'] = $tel;
            $map['id'] = $uid;
            
            $userinfo = UserModel::getByUserWhere($map);
            
            if (!$userinfo) {
                
                //手机号不存未注册
            }
            
            
        }
        
        public function userRegister()
        {
            
            $uid = Token::getCurrentUid();
            $isbind = $this->checkBind();
            if (!$isbind) {
            
            
            }
            
            
        }
        
        
        public function userSysinit()
        {
        
        
        }
        
        
    }