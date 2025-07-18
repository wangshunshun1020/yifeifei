<?php
    
    namespace app\admin\controller\carswxsys;
    
    use app\common\controller\Backend;
    use app\admin\model\carswxsys\User as WxuserModel;

    
    /**
     *
     *
     * 用户管理
     */
    class User extends Backend
    {
        
        
        protected $model = null;
        protected $noNeedRight = ['*'];
        protected $multiFields = ['enabled', 'sort'];
        
        public function _initialize()
        {
            parent::_initialize();
            $this->model = new \app\admin\model\carswxsys\User;
            // $this->view->assign("statusList", $this->model->getStatusList());
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
                    $od = "create_time desc";
                }
                list($where, $sort, $order, $offset, $limit) = $this->buildparams();
                $map['avatarUrl'] = array('neq', '');
                
                $wxuser = new WxuserModel();
                $count = $wxuser->getWxuserCount($map);
                
                $Nowpage = $offset / $limit + 1;
                
                $list = $wxuser->getWxuserByWhere($map, $Nowpage, $limit, $od);
                if ($list) {
                    
                    foreach ($list as $k => $v) {
                        $list[$k]['createtime'] = date('Y-m-d', $v['create_time']);
                    }
                }
                
                
                $result = array("total" => $count, "rows" => $list);
                
                return json($result);
            }
            return $this->view->fetch();
        }
        
     
   
        
    }
