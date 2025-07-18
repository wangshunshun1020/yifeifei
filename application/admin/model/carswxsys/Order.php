<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    use think\Db;
    
    class Order extends Model
    {
        protected $name = 'carswxsys_order';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        
        /**
         * 根据搜索条件获取列表信息
         * @author
         */
        public function getListByWhere($map, $Nowpage, $limits, $od)
        {
            $list = $this->alias('o')
                ->field('u.nickname AS nickname, u.tel AS tel,o.id AS id,o.order_no AS order_no,o.create_time AS create_time,o.total_price AS total_price,o.snap_name AS snap_name,r.content AS content,r.carfuel AS carfuel,r.carage AS carage,r.cartype AS cartype,r.carrate AS carrate,r.carchange AS carchange,r.carspl AS carspl,r.carpos AS carpos,r.carcolor AS carcolor,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,p.name AS provincename,c.name AS cityname,a.name AS areaname,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,p.name AS provincename,c.name AS cityname,a.name AS areaname,r.id AS carid,r.title AS title, r.money AS money,r.newmoney AS newmoney,r.carkm AS carkm, r.carnumdate AS carnumdate,r.thumb AS thumb,r.thumb_url AS thumb_url,r.carspl AS carspl,b.name AS brandname,o.status AS status,r.ischeck AS ischeck ,o.user_id AS uid')
                ->join('carswxsys_cars r', 'r.id = o.pid','left')
                ->join('carswxsys_brand b', 'b.id = r.brandid','left')
                ->join('carswxsys_brandcars s', 's.id = r.sbrandid','left')
                ->join('carswxsys_province p', 'p.id = r.provinceid')
                ->join('carswxsys_city c', 'c.id = r.cityid')
                ->join('carswxsys_area a', 'a.id = r.areaid')
                ->join('carswxsys_user u', 'u.id = o.user_id')
                ->page($Nowpage, $limits)->order($od)->select();
            return $list;
            
        }
        
        public function getListCount($map)
        {
            return $this->where($map)->count();
            
        }
        
        
        /**
         * [delOrder 删除]
         * @author
         */
        public function delOrder($id)
        {
            $title = $this->where('id', $id)->value('id');
            Db::startTrans();// 启动事务
            try {
                $this->where('id', $id)->delete();
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '删除成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '删除失败'];
            }
        }
        
        
    }