<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\model\Lookrole as LookroleModel;

    
    class Lookrole extends BaseController
    {
        
        public function getLookRoleList()
        {
            
            
            $od = "sort desc";
            $map['enabled'] = 1;
            
            $LookroleModel = new LookroleModel();
            $lookrolelist = $LookroleModel->getLookroleByWhere($map, $od);

            $data = array('lookrolelist' => $lookrolelist);
            
            
            return json_encode($data);
            
            
        }
        
        
    }