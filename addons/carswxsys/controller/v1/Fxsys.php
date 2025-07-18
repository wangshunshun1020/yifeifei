<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\model\User as UserModel;
    use addons\carswxsys\service\Token;
    
    class Fxsys extends BaseController
    {
        
        
        public function fxBinduser()
        {
            
            $tid = input('post.tid');
            
            $uid = Token::getCurrentUid();
            
            $map['id'] = $uid;
            
            
            $userinfo = UserModel::getByUserWhere($map);
            
            $data = [];
            
            $data['id'] = $uid;
            
            
            if ($userinfo['tid'] == 0) {
                
                
                $map1['id'] = $tid;//查直接上级信息
                
                $userinfo1 = UserModel::getByUserWhere($map1);
                
                if ($userinfo1['tid'] > 0) {
                    
                    $data['fxuid1'] = $userinfo1['tid'];
                    
                    if ($userinfo1['fxuid2'] > 0) {
                        
                        $data['fxuid2'] = $userinfo1['fxuid2'];
                    }
                    
                }
                
                $data['tid'] = $tid;
                
                
                $user = new UserModel();
                
                
                $user->updateUser($data);
                
            }
            
            
            $data = array('status' => 0);
            
            
            return json_encode($data);
            
            
        }
        
        
        public function rectBinduser()
        {
            
            $rectid = input('post.rectid');
            
            
            $uid = Token::getCurrentUid();
            
            $map['id'] = $uid;
            
            $data['id'] = $uid;
            
            $userinfo = UserModel::getByUserWhere($map);
            
            
            if ($userinfo['rectid'] == 0) {
                
                
                $data['rectid'] = $rectid;
                
                $user = new UserModel();
                
                
                $user->updateUser($data);
                
            }
            
            
            $data = array('status' => 0);
            
            
            return json_encode($data);
            
            
        }
        
        
    }