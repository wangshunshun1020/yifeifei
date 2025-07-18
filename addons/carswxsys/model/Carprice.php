<?php
    
    namespace addons\carswxsys\model;
    
    
    class Carprice extends BaseModel
    {
        
     
        protected $name = 'carswxsys_carprice';
        
        public static function getCarpricelist()
        {
            
            
            $list = self::where('enabled', '=', 1)->order('sort asc')->select();
            
            return $list;
        }
        
        public static function getOne($id)
        {
            return self::where('id','=',$id)->find();
        }
        
    }
