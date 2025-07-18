<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    
    use addons\carswxsys\service\Pay as PayService;
    use addons\carswxsys\service\WxNotify;
    use addons\carswxsys\validate\IDMustBePositiveInt;
    use think\Log;
    
    class Pay extends BaseController
    {
        protected $beforeActionList = ['checkExclusiveScope' => ['only' => 'getPreOrder']];
        
        public function getPreOrder()
        {
            
            $id = input('post.id');
            (new IDMustBePositiveInt())->goCheck();
            
            
            $pay = new PayService($id);
 
            return json_encode($pay->pay());
        }
        
   
        public function redirectNotify()
        {
            $notify = new WxNotify();
            $notify->handle();
        }
        
        public function notifyConcurrency()
        {
            $notify = new WxNotify();
            $notify->handle();
        }
        
        public function receiveNotify()
        {
            
            $notify = new WxNotify();
            
            
            $notify->handle();

        }
    }