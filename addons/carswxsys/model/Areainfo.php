<?php
    
    namespace addons\carswxsys\model;
    
    
    class Areainfo extends BaseModel
    {
        
        
        protected $name = 'carswxsys_area';
        
       
        public static function getAreaByCityid($cityid)
        {
            
            
            $arealist = Areainfo::where('cityid', '=', $cityid)->order('sort desc')->select();
            
            return $arealist;
        }
        
        
        public static function getAreaByIdRow($map)
        {
            
            
            $areainfo = self::where($map)->find();
            
            return $areainfo;
        }
    
        public static function getAll($map)
        {
        
            return self::where($map)->select();
        }
        
    }
