<?php
    
    namespace addons\carswxsys\model;
    
    class Adv extends BaseModel
    {
        
        protected $name = 'carswxsys_adv';
        
        public function items()
        {
            return $this->hasMany('BannerItem', 'banner_id', 'id');
        }
       
       
        public static function getBannerById($id)
        {
            $banner = self::with(['items', 'items.img'])->find($id);
            
            
            return $banner;
        }
        
        public static function getBanner($map)
        {
            
            $bannerlist = self::where($map)->order('sort desc')->select();
            
            foreach ($bannerlist as $k => $v) {
                if($v['thumb'])
                    $bannerlist[$k]['thumb'] = cdnurl($v['thumb'], true);
            }
            
            return $bannerlist;
            
            
        }
    }
