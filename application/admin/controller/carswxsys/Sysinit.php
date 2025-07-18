<?php
    
    namespace app\admin\controller\carswxsys;
    
    use app\common\controller\Backend;
    use app\admin\model\carswxsys\Sysinit as SysinitModel;

    /**
     *
     *
     * 系统设置
     */
    class Sysinit extends Backend
    {
        
        
        protected $model = null;
        protected $noNeedRight = ['*'];
        protected $multiFields = ['enabled', 'sort'];
        
        public function _initialize()
        {
            parent::_initialize();
            $this->model = new \app\admin\model\carswxsys\Sysinit;
            // $this->view->assign("statusList", $this->model->getStatusList());
        }
        
        
        public function add()
        {
            //当前是否为关联查询
            $this->relationSearch = true;
            //设置过滤方法
            $this->request->filter(['strip_tags', 'trim']);
            
            
            if ($this->request->isAjax()) {
                extract(input());
                $params = $this->request->post("row/a");
                
                //   unset($param['file']);
                
                $sysinit = new SysinitModel();
                
                $sysinfo = $sysinit->getOneSysinit();
                
                if ($sysinfo) {
                    $flag = $sysinit->updateSysinit($params);
                } else {
                    
                    $flag = $sysinit->insertSysinit($params);
                    
                }
                
                
                if ($flag !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            } else {
                
                $sysinit = new SysinitModel();
                $sysinfo = $sysinit->getOneSysinit();
                $this->view->assign("row", $sysinfo);
                
                
            }
            
            
            return $this->view->fetch();
        }
        
        
        public function edit($ids = null)
        {
            //当前是否为关联查询
            $this->relationSearch = true;
            //设置过滤方法
            $this->request->filter(['strip_tags', 'trim']);
            
            
            if ($this->request->isAjax()) {
                extract(input());
                $params = $this->request->post("row/a");
                
                //   unset($param['file']);
                
                $sysinit = new SysinitModel();
                
                $sysinfo = $sysinit->getOneSysinit();
                
                if ($sysinfo) {
                    $flag = $sysinit->updateSysinit($params);
                } else {
                    
                    $flag = $sysinit->insertSysinit($params);
                    
                }
                
                
                if ($flag !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            } else {
                
                $sysinit = new SysinitModel();
                $sysinfo = $sysinit->getOneSysinit();
                $this->view->assign("row", $sysinfo);
                
                
            }
            
            
            return $this->view->fetch('carswxsys/sysinit/add');
        }
        
        
    }
