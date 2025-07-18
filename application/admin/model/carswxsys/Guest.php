<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    
    class Guest extends Model
    {
        protected $name = 'carswxsys_guest';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        /**
         * 根据搜索条件获取列表信息
         * @author
         */
        public function getGuestByWhere($map, $Nowpage, $limits, $od)
        {
            return $this->alias ('t')
                ->field('t.num AS num, t.createtime AS createtime , t.updatetime AS updatetime,p.name AS provincename,u.nickname AS nickname,g.uid AS uid, c.name AS cityname,g.thumb AS thumb, a.name AS areaname,g.id AS id, g.title AS title ,u.tel AS tel,g.money AS money, g.newmoney AS newmoney,g.carkm AS carkm,g.carnumdate AS carnumdate,g.carcolor AS carcolor,g.carrate AS carrate,g.carspl AS carspl,g.createtime AS createtime,g.sort AS sort, g.status AS status,g.ischeck AS ischeck ,g.uid AS uid,g.issale AS issale,b.name AS brandname , e.name AS sbrandname ')
                ->join('carswxsys_cars g', 'g.id = t.carid','left')
                ->join('carswxsys_city c', 'g.cityid = c.id','left')
                ->join('carswxsys_area a', 'g.areaid = a.id','left')
                ->join('carswxsys_province p', 'p.id = g.provinceid','left')
                ->join('carswxsys_brand b', 'b.id = g.brandid','left')
                ->join('carswxsys_brandcars e', 'e.id = g.sbrandid','left')
                ->join('carswxsys_user u', 'u.id = t.uid','left')
                ->where($map)
                ->page($Nowpage, $limits)
                ->order($od)
                ->select();
        }
        
        public function getGuestCount($map)
        {
            return $this->alias ('t')
                ->field('p.name AS provincename,u.nickname AS nickname,g.uid AS uid, c.name AS cityname,g.thumb AS thumb, a.name AS areaname,g.id AS id, g.title AS title ,u.tel AS tel,g.money AS money, g.newmoney AS newmoney,g.carkm AS carkm,g.carnumdate AS carnumdate,g.carcolor AS carcolor,g.carrate AS carrate,g.carspl AS carspl,g.createtime AS createtime,g.sort AS sort, g.status AS status,g.ischeck AS ischeck ,g.uid AS uid,g.issale AS issale,b.name AS brandname , e.name AS sbrandname ')
                ->join('carswxsys_cars g', 'g.id = t.carid','left')
                ->join('carswxsys_city c', 'g.cityid = c.id','left')
                ->join('carswxsys_area a', 'g.areaid = a.id','left')
                ->join('carswxsys_province p', 'p.id = g.provinceid','left')
                ->join('carswxsys_brand b', 'b.id = g.brandid','left')
                ->join('carswxsys_brandcars e', 'e.id = g.sbrandid','left')
                ->join('carswxsys_user u', 'u.id = t.uid','left')
                ->where($map)
                ->count();
        }
        
   
 
        
        
        
        
        
    }
