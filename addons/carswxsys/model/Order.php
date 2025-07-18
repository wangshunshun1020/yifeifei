<?php
    
    namespace addons\carswxsys\model;
    
    
    class Order extends BaseModel
    {
        protected $hidden = ['user_id', 'delete_time', 'update_time'];
        protected $autoWriteTimestamp = true;
        
        protected $name = 'carswxsys_order';
    
        public function getListByWhere($map,$od)
        {
            $list = $this->alias('o')
                ->field('o.id AS id,o.order_no AS order_no,o.create_time AS create_time,o.total_price AS total_price,o.snap_name AS snap_name,r.content AS content,r.carfuel AS carfuel,r.carage AS carage,r.cartype AS cartype,r.carrate AS carrate,r.carchange AS carchange,r.carspl AS carspl,r.carpos AS carpos,r.carcolor AS carcolor,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,p.name AS provincename,c.name AS cityname,a.name AS areaname,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,p.name AS provincename,c.name AS cityname,a.name AS areaname,r.id AS carid,r.title AS title, r.money AS money,r.newmoney AS newmoney,r.carkm AS carkm, r.carnumdate AS carnumdate,r.thumb AS thumb,r.thumb_url AS thumb_url,r.carspl AS carspl,b.name AS brandname,o.status AS status,r.ischeck AS ischeck ,o.user_id AS uid')
                ->join('carswxsys_cars r', 'r.id = o.pid','left')
                ->join('carswxsys_brand b', 'b.id = r.brandid','left')
                ->join('carswxsys_brandcars s', 's.id = r.sbrandid','left')
                ->join('carswxsys_province p', 'p.id = r.provinceid')
                ->join('carswxsys_city c', 'c.id = r.cityid')
                ->join('carswxsys_area a', 'a.id = r.areaid')
                ->where($map)
                ->order($od)
                ->select();
        
        
            if ($list) {
                foreach ($list as $k => $v) {
    
                    $list[$k]['thumb'] = cdnurl($v['thumb'], true);
                
                
                }
            
            }
        
        
            return $list;
        
        }
    
    
        public function getCount($map)
        {
            $count = $this->alias('o')
                ->field('o.order_no AS order_no,o.create_time AS create_time,o.total_price AS total_price,o.snap_name AS snap_name,r.content AS content,r.carfuel AS carfuel,r.carage AS carage,r.cartype AS cartype,r.carrate AS carrate,r.carchange AS carchange,r.carspl AS carspl,r.carpos AS carpos,r.carcolor AS carcolor,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,p.name AS provincename,c.name AS cityname,a.name AS areaname,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,p.name AS provincename,c.name AS cityname,a.name AS areaname,r.id AS carid,r.title AS title, r.money AS money,r.newmoney AS newmoney,r.carkm AS carkm, r.carnumdate AS carnumdate,r.thumb AS thumb,r.thumb_url AS thumb_url,r.carspl AS carspl,b.name AS brandname,o.status AS status,r.ischeck AS ischeck ,o.user_id AS uid')
                ->join('carswxsys_cars r', 'r.id = o.pid','left')
                ->join('carswxsys_brand b', 'b.id = r.brandid','left')
                ->join('carswxsys_brandcars s', 's.id = r.sbrandid','left')
                ->join('carswxsys_province p', 'p.id = r.provinceid')
                ->join('carswxsys_city c', 'c.id = r.cityid')
                ->join('carswxsys_area a', 'a.id = r.areaid')
                ->where($map)
                ->count();
            
        
        
            return $count;
        
        }
        
        public function getSnapItemsAttr($value)
        {
            if (empty($value)) {
                return null;
            }
            return json_decode($value);
        }
        
        public function getSnapAddressAttr($value)
        {
            if (empty($value)) {
                return null;
            }
            return json_decode(($value));
        }
        
        public static function getSummaryByUser($uid, $page = 1, $size = 15)
        {
            $pagingData = self::where('user_id', '=', $uid)->order('create_time desc')->paginate($size, true, ['page' => $page]);
            return $pagingData;
        }
        
        public static function getSummaryByPage($page = 1, $size = 20)
        {
            $pagingData = self::order('create_time desc')->paginate($size, true, ['page' => $page]);
            return $pagingData;
        }
        
        public function products()
        {
            return $this->belongsToMany('Product', 'order_product', 'product_id', 'order_id');
        }
    }
