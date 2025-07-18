<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\model\Order as OrderModel;
    use addons\carswxsys\model\Lookrole as LookroleModel;
    use addons\carswxsys\service\Order as OrderService;
    use addons\carswxsys\service\Token;
    use addons\carswxsys\validate\IDMustBePositiveInt;
    use addons\carswxsys\validate\OrderPlace;
    use addons\carswxsys\lib\exception\OrderException;
    use addons\carswxsys\lib\exception\SuccessMessage;
    
    class Order extends BaseController
    {
        protected $beforeActionList = ['checkExclusiveScope' => ['only' => 'placeOrder'], 'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser'], 'checkSuperScope' => ['only' => 'delivery,getSummary']];
        
        
        public function myOrder()
        {
            $uid = Token::getCurrentUid();
    
            $status = input('post.status');
    
            if($status>=1)
            {
        
                $map['o.status'] = $status;
            }
    
            $map['o.user_id'] = $uid;
            
            $od = 'o.id DESC';
    
            $OrderModel = new OrderModel();
            $list = $OrderModel->getListByWhere($map,$od);
    
    
            $totalcount = $OrderModel->getCount(array('o.user_id'=>$uid));
    
            $totalcount_0 = $OrderModel->getCount(array('o.user_id'=>$uid,'o.status'=>1));
            $totalcount_1 = $OrderModel->getCount(array('o.user_id'=>$uid,'o.status'=>2));
    
    
            $status_arr = array(1=>'未支付',2=>'已支付');
    
    
    
            foreach ($list as $k=>$v)
            {
                
                $list[$k]['create_time'] = date('Y-m-d H:m:s',$v['create_time']);
        
                $list[$k]['status_str'] =$status_arr[$v['status']];
        
            }
    
    
    
            $data = array(
                'list'=>$list,
                'totalcount'=>$totalcount,
                'totalcount_0'=>$totalcount_0,
                'totalcount_1'=>$totalcount_1,
    
            );
    
    
            return json_encode($data);
            
        }
        
        
        //置顶下单入口
        public function lookRoleOrder()
        {
            
            (new OrderPlace())->goCheck();
            
            $type = input('post.type');
            $roleid = input('post.roleid');
            $pid = input('post.pid');
            
            $lookroleinfo = LookroleModel::get($roleid);
            
            $lookroleinfo['pid']  = $pid;
            
            if (!$lookroleinfo) {
                throw new OrderException();
            }
            
            
            $uid = Token::getCurrentUid();
            $order = new OrderService();
            
            
            $status = $order->placeLookrole($uid, $lookroleinfo, $type);
            
            return json_encode($status);
            
        }
        
 
        

        /**
         * 获取订单详情
         * @param $id
         * @return static
         * @throws OrderException
         */
        public function getDetail($id)
        {
            (new IDMustBePositiveInt())->goCheck();
            $orderDetail = OrderModel::get($id);
            if (!$orderDetail) {
                throw new OrderException();
            }
            return $orderDetail->hidden(['prepay_id']);
        }
        
    
        
    
        
    }






















