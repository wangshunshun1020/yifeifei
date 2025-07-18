<?php
    
    
    namespace addons\carswxsys\service;
    
    
    use addons\carswxsys\lib\exception\OrderException;
    use addons\carswxsys\lib\exception\TokenException;
    use addons\carswxsys\library\WxPay\WxPayApi;
    use addons\carswxsys\model\Order as OrderModel;
    use think\Exception;
    use think\Log;


    class Pay
    {
        private $orderNo;
        private $orderID;
        
        function __construct($orderID)
        {
            if (!$orderID) {
                throw new Exception('订单号不允许为NULL');
            }
            $WxPayApi = new WxPayApi();
            $this->orderID = $orderID;
        }
        
        public function pay()
        {
            $this->checkOrderValid();

    
    
            $order = OrderModel::where('id', '=', $this->orderID)->find();
            if (!$order) {
                throw new OrderException();
            }
            
            return $this->makeWxPreOrder($order['total_price']);
            //        $this->checkProductStock();
        }
        
        // 构建微信支付订单信息

        /**
         * @return bool
         * @throws OrderException
         * @throws TokenException
         */
        private function checkOrderValid()
        {
            $order = OrderModel::where('id', '=', $this->orderID)->find();
            if (!$order) {
                throw new OrderException();
            }
//        $currentUid = Token::getCurrentUid();
            if (!Token::isValidOperate($order->user_id)) {
                throw new TokenException(['msg' => '订单与用户不匹配', 'errorCode' => 10003]);
            }
            if ($order->status != 1) {
                throw new OrderException(['msg' => '订单已支付过啦', 'errorCode' => 80003, 'code' => 400]);
            }
            $this->orderNo = $order->order_no;
            return true;
        }
        
        //向微信请求订单号并生成签名

        private function makeWxPreOrder($totalPrice)
        {
            $openid = Token::getCurrentTokenVar('openid');
            
            if (!$openid) {
                throw new TokenException();
            }
            $wxOrderData = new \WxPayUnifiedOrder();
            
            
            $config = get_addon_config('carswxsys');
            $wxOrderData->SetOut_trade_no($this->orderNo);
            $wxOrderData->SetMch_id($config['couponsn']);
            $wxOrderData->SetTrade_type('JSAPI');
            $wxOrderData->SetTotal_fee($totalPrice * 100);
            $wxOrderData->SetBody('置顶信息');
            $wxOrderData->SetOpenid($openid);
            // $wxOrderData->SetNotify_url(config('secure.pay_back_url'));
            
            $domainurl = addon_url('', '', false, true);
            
            $notifyurl = $domainurl . 'carswxsys/v1.Pay/receiveNotify';
            $wxOrderData->SetNotify_url($notifyurl);

            return $this->getPaySignature($wxOrderData);
        }
        
        private function getPaySignature($wxOrderData)
        {
            $wxOrder = WxPayApi::unifiedOrder($wxOrderData);
            
            // 失败时不会返回result_code
            if ($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS') {
                Log::record($wxOrder, 'error');
                Log::record('获取预支付订单失败', 'error');
                throw new Exception('获取预支付订单失败');
            }
            $this->recordPreOrder($wxOrder);
            $signature = $this->sign($wxOrder);
            return $signature;
        }
        
        // 签名

        private function recordPreOrder($wxOrder)
        {
            // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
            OrderModel::where('id', '=', $this->orderID)->update(['prepay_id' => $wxOrder['prepay_id']]);
        }
        
        private function sign($wxOrder)
        {
            $config = get_addon_config('carswxsys');
            $jsApiPayData = new \WxPayJsApiPay();
            $jsApiPayData->SetAppid($config['wxappid']);
            $jsApiPayData->SetTimeStamp((string)time());
            $rand = md5(time() . mt_rand(0, 1000));
            $jsApiPayData->SetNonceStr($rand);
            $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
            $jsApiPayData->SetSignType('md5');
            $sign = $jsApiPayData->MakeSign();
            $rawValues = $jsApiPayData->GetValues();
            $rawValues['paySign'] = $sign;
            unset($rawValues['appId']);
            return $rawValues;
        }
    }