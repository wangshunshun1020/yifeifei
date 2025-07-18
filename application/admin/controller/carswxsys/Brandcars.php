<?php
    
    namespace app\admin\controller\carswxsys;
    
    use app\common\controller\Backend;
    use app\admin\model\carswxsys\Brand as BrandModel;
    use app\admin\model\carswxsys\Brandcars as BrandcarsModel;
    
    
    /**
     *
     *
     * 品牌管理
     */
    class Brandcars extends Backend
    {
        
        
        protected $model = null;
        protected $noNeedRight = ['*'];
        protected $multiFields = ['enabled', 'sort'];
        
        public function _initialize()
        {
            parent::_initialize();
            $this->model = new \app\admin\model\carswxsys\Brandcars;
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
                    $od = "c.sort desc";
                }
                list($where, $sort, $order, $offset, $limit) = $this->buildparams();
                
                $brandcars = new  BrandcarsModel();
                $count = $brandcars->getBrandcarsCount($map);
                $Nowpage = $offset / $limit + 1;
                $list = $brandcars->getBrandcarsByWhere($map, $Nowpage, $limit, $od);
                
                
                file_put_contents(__DIR__.'/b.log', json_encode(array($map, $list, $sort, $order)).PHP_EOL, FILE_APPEND);
                
                
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
                    $brandcars = new BrandcarsModel();
                    
                    $result = $brandcars->insertBrandcars($params);
                    
                    
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error(__('No rows were inserted'));
                    }
                }
                $this->error(__('Parameter %s can not be empty', ''));
            }
    
    
            $brand = new BrandModel();
            $map['enabled'] = 1 ;
            $od = 'sort desc';
            $brandlist = $brand->getAllBrand($map,$od);
    
            $this->view->assign("brandlist", $brandlist);
            
            
            return $this->view->fetch();
        }
        
        /**
         * 编辑
         */
        public function edit($ids = null)
        {
            
            $brandcars = new BrandcarsModel();
            
            if ($this->request->isPost()) {
                $params = $this->request->post("row/a");
                if ($params) {
                    
                    $params = $this->preExcludeFields($params);
                    $result = false;
                    
                    
                    $result = $brandcars->updateBrandcars($params);
                    
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error(__('No rows were updated'));
                    }
                    
                    
                }
                
                
                $this->error(__('Parameter %s can not be empty', ''));
            }
            
            
            $row = $brandcars->getOneBrandcars($ids);
            
            
            if (!$row) {
                $this->error(__('No Results were found'));
            }
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                if (!in_array($row[$this->dataLimitField], $adminIds)) {
                    $this->error(__('You have no permission'));
                }
            }
    
            $brand = new BrandModel();
            $map['enabled'] = 1 ;
            $od = 'sort desc';
            $brandlist = $brand->getAllBrand($map,$od);
    
            $this->view->assign("brandlist", $brandlist);
    
            $this->view->assign("row", $row);
            return $this->view->fetch();
        }
        
    }
