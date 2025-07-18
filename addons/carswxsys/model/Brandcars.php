<?php
    namespace addons\carswxsys\model;
    
    class Brandcars extends BaseModel
    {
        protected $name = 'carswxsys_brandcars';
      
        public static function getList($map)
        {
            
            
            $list = self::where($map)->order('id desc')->select();
            
            return $list;
        }
        
        
        
        
        
    }

