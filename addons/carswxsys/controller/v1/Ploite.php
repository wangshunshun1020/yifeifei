<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    
    use addons\carswxsys\controller\BaseController;
    
    use addons\carswxsys\model\Ploite as PloiteModel;
 
    use addons\carswxsys\service\Token;

    
    class Ploite extends BaseController
    {
        
        public function savePloite()
        {
    
            if(request()->isPost()){
        
        
                $param = input('post.');
                
                $param['uid'] = Token::getCurrentUid();
        
                $param['createtime'] = time();
                
                $PloiteModel = new PloiteModel();
        
                $data = $PloiteModel->insertPloite($param);
        
                return $data;
            }
    
    
        }
        
    }