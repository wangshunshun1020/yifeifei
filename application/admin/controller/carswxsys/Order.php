<?php
    
    namespace app\admin\controller\carswxsys;
    
    use app\common\controller\Backend;
    use app\admin\model\carswxsys\Order as OrderModel;
    
    
    /**
     *
     *
     * 订单管理
     */
    class Order extends Backend
    {
        
        
        protected $model = null;
        protected $noNeedRight = ['*'];
        protected $multiFields = ['enabled', 'sort'];
        
        public function _initialize()
        {
            parent::_initialize();
            $this->model = new \app\admin\model\carswxsys\Order;
        }
        
        
        public function index()
        {
            //当前是否为关联查询
            $this->relationSearch = true;
            //设置过滤方法
            $this->request->filter(['strip_tags', 'trim']);
            
            
            if ($this->request->isAjax()) {
                //如果发送的来源是Selectpage，则转发到Selectpage
                if ($this->request->request('keyField')) {
                    return $this->selectpage();
                }
                
                $map = [];
                
                $field = input('field');//字段
                $order = input('order');//排序方式
                if ($field && $order) {
                    $od = $field . " " . $order;
                } else {
                    $od = "o.create_time desc";
                }
                list($where, $sort, $order, $offset, $limit) = $this->buildparams();
                
                $order = new OrderModel();
                $count = $order->getListCount($map);
                $Nowpage = $offset / $limit + 1;
                
                $list = $order->getListByWhere($map, $Nowpage, $limit, $od);
                $status_arr = array(1=>'未支付',2=>'已支付');
                if ($list) {
                    
                    foreach ($list as $k => $v) {
                        
                        $list[$k]['username'] = $v['nickname'] . '/' . $v['tel'];
                        $list[$k]['snap_name'] = $v['snap_name'] . '/【' . $v['title'].'】';
                        
                        
                        $list[$k]['create_time'] = date('Y-m-d', $v['create_time']);
    
                        $list[$k]['status_str'] =$status_arr[$v['status']];
                        
                        
                    }
                }
                
                
                $result = array("total" => $count, "rows" => $list);
                
                return json($result);
            }
            return $this->view->fetch();
        }
        
    
        
     
        
    }
