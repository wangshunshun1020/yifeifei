<?php
    
    
    namespace addons\carswxsys\service;
    use addons\carswxsys\lib\exception\OrderException;
    use addons\carswxsys\model\Order as OrderModel;
    use think\Exception;

    /**
     * 订单类
     */
    class Order
    {
        protected $oProducts;
        protected $products;
        protected $uid;
        protected $ordertype;
        protected $companyid = 0;
        
        function __construct()
        {
        }
        
        
        public function placeLookrole($uid, $oProducts, $type)
        {
            
            $this->products = $oProducts;
            $this->uid = $uid;
            $this->ordertype = $type;
            
            //处理订单快照
            $orderSnap = $this->snapLookroleOrder();
            
            
            $status = self::createRoleOrderByTrans($orderSnap);
            
            
            $status['pass'] = true;
            return $status;
            
        }
        
        
        private function snapLookroleOrder()
        {
            // status可以单独定义一个类
            $snap = ['orderPrice' => 0, 'pStatus' => [], 'snapName' => $this->products['title']];
            
            $product = $this->products;
            $oProduct = $this->oProducts;
            $pStatus = $this->snapLookroleProduct($product);
            $snap['orderPrice'] = $pStatus['money'];
            array_push($snap['pStatus'], $pStatus);
            return $snap;
        }
        
        private function snapLookroleProduct($product)
        {
            $pStatus = ['id' => null, 'title' => null, 'looknum' => 0, 'money' => 0];
            
            // 以服务器价格为准，生成订单
            $pStatus['days'] = $product['days'];
            $pStatus['title'] = $product['title'];
            $pStatus['id'] = $product['id'];
            $pStatus['money'] = $product['money'];
            return $pStatus;
        }
        
        private function createRoleOrderByTrans($snap)
        {
            try {
                $products = $this->products;
                $orderNo = $this->makeOrderNo();
                $order = new OrderModel();
                $order->user_id = $this->uid;
                $order->ordertype = $this->ordertype;
                $order->roleid = $products['id'];
                $order->pid = $products['pid'];
                $order->order_no = $orderNo;
                $order->total_price = $snap['orderPrice'];
                $order->snap_name = $snap['snapName'];
                $order->snap_items = json_encode($snap['pStatus']);
                $order->save();
                
                $orderID = $order->id;
                $create_time = $order->create_time;
                
                
                return ['order_no' => $orderNo, 'order_id' => $orderID, 'create_time' => $create_time];
            } catch (Exception $ex) {
                throw $ex;
            }
        }
        
        public static function makeOrderNo()
        {
            $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
            $orderSn = $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
            return $orderSn;
        }
        
    
        
     
    }