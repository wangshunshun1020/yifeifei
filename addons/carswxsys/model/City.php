<?php
    
    namespace addons\carswxsys\model;
    
    
    class City extends BaseModel
    {
        
       
        protected $name = 'carswxsys_city';
        
        public static function getCityByName($name)
        {
            
            
            $map = array('name' => $name, 'enabled' => 1);
            $cityinfo = self::where('name', '=', $name)->find();
            
            if (!$cityinfo) {
                $mapon = array('ison' => 1, 'enabled' => 1);
                $cityinfo = self::where($mapon)->find();
            }
            
            return $cityinfo;
        }
        
        
        public function getCityByWhere($map, $od)
        {
            $citylist = $this->where($map)->order($od)->select();
            
            return $citylist;
            
        }
        
        
        public function getCityGroupByWhere($map, $od, $group)
        {
            $citylist = $this->where($map)->order($od)->group($group)->select();
            
            return $citylist;
            
        }
    
        public static function getAll($map)
        {
        
            return self::where($map)->select();
        }
        
    }
