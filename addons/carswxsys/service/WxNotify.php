<?php
    
    namespace addons\carswxsys\service;
    
    use addons\carswxsys\lib\enum\OrderStatusEnum;
    use addons\carswxsys\library\WxPay\WxPayNotify;
    use addons\carswxsys\model\Cars as CarsModel;
    use addons\carswxsys\model\Order;
    use think\Db;
    use think\Exception;
    use think\Log;

    class WxNotify extends WxPayNotify
    
    {
        
        
        public function NotifyProcess($data, &$msg)
        {
            
            
            if ($data['result_code'] == 'SUCCESS') {
                $orderNo = $data['out_trade_no'];
                Db::startTrans();
                try {
                    $order = Order::where('order_no', '=', $orderNo)->lock(true)->find();
                    
                    if ($order->status == 1) {
                        
                        $this->updateOrderStatus($order->id, true);
                        
                        
                        if ($order->ordertype == 'lookrole') {
                            
                            $lookroleinfo = $order->snap_items;
                            
                            $days = $lookroleinfo[0]->days;
                            
                            $CarsModel = new CarsModel();
                            $param['id'] = $order['pid'];
                            $param['toptime'] = time()+$days * 24 * 60 * 60;
                            
                            $CarsModel->updateCars($param);
                            
                        }
                        
                        
                    }
                    Db::commit();
                } catch (Exception $ex) {
                    Db::rollback();
                    Log::error($ex);
                    // 如果出现异常，向微信返回false，请求重新发送通知
                    return false;
                }
            }
            return true;
        }
        
        
        private function updateOrderStatus($orderID, $success)
        {
            $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
            Order::where('id', '=', $orderID)->update(['status' => $status]);
        }
    }