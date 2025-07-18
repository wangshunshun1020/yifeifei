<?php
    
    namespace addons\carswxsys\model;
    
    
    class Nav extends BaseModel
    {
        protected $name = 'carswxsys_nav';
        
        public static function getOne($map)
        
        {
            return self::where($map)->find();
            
            
        }
        
        
        public static function getNav()
        {
            $map['enabled'] = 1;
            
            $navlist = self::where($map)->order('sort desc')->select();
         
            
            
            $data['from'] = 1;
            
            foreach ($navlist as $k => $v) {
                
                if($v['thumb'])
                    $navlist[$k]['thumb'] = cdnurl($v['thumb'], true);
                
            }
            
            
            return $navlist;
            
            
        }
    }
