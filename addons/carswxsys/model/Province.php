<?php
    
    namespace addons\carswxsys\model;
    

    class Province extends BaseModel
    {
    
        protected $name = 'carswxsys_province';
        
        public static function getOne($map)
        {
            
            return self::where($map)->find();
        }
        
        
        public static function getAll($map)
        {
            
            return self::where($map)->order('id asc')->select();
        }
        
        public static function getListByName($name)
        {
            
            
            $map= array('name'=>$name, 'enabled'=>1);
            $info = self::where('name', '=', $name)
                ->find();
            
            if(!$info)
            {
                $mapon= array('ison'=>1, 'enabled'=>1);
                $info = self::where($mapon)
                    ->find();
            }
            
            return $info;
            
        }
        
        
        public  function getListByWhere($map,$od)
        {
            $list =  $this->where($map)
                ->order($od)
                ->select();
            
            return  $list;
            
        }
        
        
     
        
    }

