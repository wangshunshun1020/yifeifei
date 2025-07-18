<?php
    
    namespace addons\carswxsys\model;
    
    
    class Cate extends BaseModel
    {
        
    
        
        protected $name = 'carswxsys_cate';
        
        public static function getCatelist()
        {
            
            
            $catelist = Cate::where(array('enabled' => 1))->order('sort desc')->select();
            
            return $catelist;
        }
        
    }
