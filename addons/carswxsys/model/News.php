<?php
    
    namespace addons\carswxsys\model;
    

    
    class News extends BaseModel
    {
        protected $name = 'carswxsys_news';
        
        public function getNewsByWhere($map, $Nowpage, $limits, $od)
        {
            $newslist = $this->where($map)->page($Nowpage, $limits)->order($od)->select();
            $data['from'] = 1;
            if ($newslist) {
                foreach ($newslist as $k => $v) {
                    if($v['thumb'])
                        $newslist[$k]['thumb'] = cdnurl($v['thumb'], true);
                    $newslist[$k]['createtime'] = date('Y-m-d', $v['createtime']);
                }
                
            }
            
            
            return $newslist;
            
        }
        
        
        public function getNewsDetail($map)
        {
            
            $newsinfo = self::where($map)->find();
            $data['from'] = 1;
            if($newsinfo['thumb'])
                $newsinfo['thumb'] = self::prefixImgUrl($newsinfo['thumb'], $data);
            $newsinfo['createtime'] = date('Y-m-d', $newsinfo['createtime']);
            return $newsinfo;
            
        }
        
        
    }
