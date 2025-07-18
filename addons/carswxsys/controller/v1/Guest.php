<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\model\Guest as GuestModel;
    use addons\carswxsys\service\Token;
    
    class Guest extends BaseController
    {
        
        
        public function saveGuest()
        {
    
    
            if(request()->isPost()) {
    
                $param = input('post.');
                $param['uid'] = Token::getCurrentUid();
    
                $map['carid'] = $param['carid'];
                $map['uid'] =  $param['uid'];
    
                $guestinfo = GuestModel::getOne($map);
                
                $GuestModel = new GuestModel();
    
                if ($guestinfo) {
                    $param['updatetime'] = time();
                    $param['id'] = $guestinfo['id'];
                    $param['num'] = $guestinfo['num'] + 1;
                    
                    $GuestModel->updateGuest($param);
                    
        
                } else {
    
                    $param['createtime'] = $param['updatetime'] = time();
    
                    $data = $GuestModel->guestSave($param);
        
                }
    

                return $data;
    
            }
            
            
        }

        
        
    
        
        
    }