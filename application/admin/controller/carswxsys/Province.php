<?php
    
    namespace app\admin\controller\carswxsys;
    
    use app\common\controller\Backend;
    use app\admin\model\carswxsys\Area as AreaModel;
    use app\admin\model\carswxsys\City as CityModel;
    use app\admin\model\carswxsys\Province as ProvinceModel;
    
    /**
     *
     *
     * @省份管理
     */
    class Province extends Backend
    {
        
        
        protected $model = null;
        protected $noNeedRight = ['*'];
        protected $multiFields = ['enabled', 'sort'];
        
        public function _initialize()
        {
            parent::_initialize();
            $this->model = new \app\admin\model\carswxsys\Province;
        }
        
        
        public function getarealist()
        {
            
            if ($this->request->isAjax()) {
                $AreaModel = new AreaModel();
                
                $cityid = input('post.cityid');//字段
                
                $map['cityid'] = $cityid;
                
                $arealist = $AreaModel->getAreaListBycityId($map);
                
                
                $this->success('', '', $arealist);
                
            }
            
            
        }
        
        
        /**
         * 查看
         */
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
                    $od = "sort desc";
                }
                
                list($where, $sort, $order, $offset, $limit) = $this->buildparams();
                $province = new ProvinceModel();
                $count = $province->getProvinceCount($map);
                $Nowpage = $offset / $limit + 1;
                $list = $province->getProvinceByWhere($map, $Nowpage, $limit, $od);
                
                
                $result = array("total" => $count, "rows" => $list);
                
                return json($result);
            }
            return $this->view->fetch();
        }
        
        /**
         * 添加
         */
        public function add()
        {
            
            
            if ($this->request->isPost()) {
                
                
                $params = $this->request->post("row/a");
                
                
                if ($params) {
                    $params = $this->preExcludeFields($params);
                    
                    if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                        $params[$this->dataLimitField] = $this->auth->id;
                    }
                    $result = false;
                    $province = new ProvinceModel();
                    $result = $province->insertProvince($params);
                    
                    
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error(__('No rows were inserted'));
                    }
                }
                $this->error(__('Parameter %s can not be empty', ''));
            }
            return $this->view->fetch();
        }
        
        /**
         * 编辑
         */
        public function edit($ids = null)
        {
            
            $province = new ProvinceModel();
            
            if ($this->request->isPost()) {
                $params = $this->request->post("row/a");
                if ($params) {
                    
                    $params = $this->preExcludeFields($params);
                    $result = false;
                    
                    
                    $result = $province->updateProvince($params);
                    
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error(__('No rows were updated'));
                    }
                    
                    
                }
                
                
                $this->error(__('Parameter %s can not be empty', ''));
            }
            
            
            $row = $province->getOneProvince($ids);
            
            
            if (!$row) {
                $this->error(__('No Results were found'));
            }
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                if (!in_array($row[$this->dataLimitField], $adminIds)) {
                    $this->error(__('You have no permission'));
                }
            }
            $this->view->assign("row", $row);
            return $this->view->fetch();
        }
        
    }
