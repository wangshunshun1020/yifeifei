<?php
    
    namespace addons\carswxsys\model;

    
    class Brand extends BaseModel
    {
    
    
        protected $name = 'carswxsys_brand';
        
        public  function getListByWhere($map,$od)
        {
            $list =  $this
                ->field('id,name,thumb')
                ->where($map)
                ->order($od)
                ->select();
            

            
            if($list)
            {
                foreach ($list as $k=>$v)
                {
                    if($v['thumb'])
                        $list[$k]['thumb'] = cdnurl($v['thumb'], true);
                    
                    
                }
                
            }
            
            
            
            
            return  $list;
            
        }
        
        
    
        
        
        
        public static function getOne($id)
        {
            
            $brandinfo = self::where('id', '=', $id)->find();
            
            
            
            return $brandinfo;
            
        }
        
        
        public  function getBrandlistgroup($map)
        {
            
            
            $brandlist = $this->where($map)->group('firstname')->order('firstname')
                ->select();
            
         
            
            if($brandlist)
            {
                foreach ($brandlist as $k=>$v)
                {
    
                    $brandlist[$k]['thumb'] =cdnurl($v['thumb'], true);
                    
                    
                }
                
            }
            
            
            
            return $brandlist;
        }
        
    }
