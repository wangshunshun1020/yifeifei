<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    use think\Db;
    
    class Cars extends Model
    {
        protected $name = 'carswxsys_cars';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        /**
         * 根据搜索条件获取列表信息
         * @author
         */
        public function getCarsByWhere($map, $Nowpage, $limits, $od)
        {
            return $this->alias ('g')
                ->field('g.transfer_num, g.scrap_time, 
            u.nickname AS nickname, g.uid AS uid,
            g.id AS id, g.title AS title, g.thumb AS thumb, g.tel AS tel,
            g.money AS money, g.newmoney AS newmoney, g.carkm AS carkm,
            g.carnumdate AS carnumdate, g.carcolor AS carcolor,
            g.carrate AS carrate, g.carspl AS carspl,
            g.createtime AS createtime, g.sort AS sort, g.status AS status,
            g.ischeck AS ischeck, g.uid AS uid, g.issale AS issale,
            b.name AS brandname, e.name AS sbrandname,
            g.toptime AS toptime,
            g.factory_date, g.airworthy, g.history_complete,
            g.accident_history, g.usage_env, g.modification_record,
            g.insurance_record, g.property_dispute,
            g.is_domestic, g.can_view_deliver,g.is_sell')
//                ->join('carswxsys_city c', 'g.cityid = c.id','left')
//                ->join('carswxsys_area a', 'g.areaid = a.id','left')
//                ->join('carswxsys_province p', 'p.id = g.provinceid','left')
                ->join('carswxsys_brand b', 'b.id = g.brandid','left')
                ->join('carswxsys_brandcars e', 'e.id = g.sbrandid','left')
                ->join('carswxsys_user u', 'u.id = g.uid','left')
                ->where($map)
                ->page($Nowpage, $limits)
                ->order($od)
                ->select();
        }
        
        public function getCarsCount($map)
        {
            return $this->alias ('g')
                ->field('g.id AS id, g.title AS title ,g.tel AS tel,g.money AS money, g.newmoney AS newmoney,g.carkm AS carkm,g.carnumdate AS carnumdate,g.carcolor AS carcolor,g.carrate AS carrate,g.carspl AS carspl,g.createtime AS createtime,g.sort AS sort, g.status AS status ,g.ischeck AS ischeck,g.uid AS uid,g.issale AS issale,b.name AS brandname , e.name AS sbrandname ')
//                ->join('carswxsys_city c', 'g.cityid = c.id')
//                ->join('carswxsys_area a', 'g.areaid = a.id')
//                ->join('carswxsys_province p', 'p.id = g.provinceid','left')
                ->join('carswxsys_brand b', 'b.id = g.brandid','left')
                ->join('carswxsys_brandcars e', 'e.id = g.sbrandid','left')
                ->join('carswxsys_user u', 'u.id = g.uid','left')
                ->where($map)
                ->count();
        }
        
        
        public static function getCount()
        {
            
            $map = [];
            $count = self::where($map)->count();
            
            return $count;
            
        }
        
        /**
         * [insertCars 添加]
         * @author
         */
        public function insertCars($param)
        {
            Db::startTrans();// 启动事务
            try {
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '添加成功'];
            } catch (\Exception $e) {

                Db::rollback();// 回滚事务
                return [
                    'code' => 100,
                    'data' => '',
                    'msg'  => '添加失败: ' . $e->getMessage()
                ];
            }
        }
        
        
        /**
         * [updateCars 编辑]
         * @author
         */
        public function updateCars($param)
        {
            Db::startTrans();// 启动事务
            try {
                $this->allowField(true)->save($param, ['id' => $param['id']]);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '编辑成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                return [
                    'code' => 100,
                    'data' => '',
                    'msg'  => '编辑失败: ' . $e->getMessage()
                ];
            }
        }
        
        
        /**
         * [getOneCars 根据id获取一条信息]
         * @author
         */
        public function getOneCars($id)
        {
            return $this->where('id', $id)->find();
        }
        
        
        /**
         * [delCars 删除]
         * @author
         */
        public function delCars($id)
        {
            $title = $this->where('id', $id)->value('jobtitle');
            Db::startTrans();// 启动事务
            try {
                $this->where('id', $id)->delete();
                Db::commit();// 提交事务
                // writelog(session('uid'),session('username'),'文章【'.$title.'】删除成功',1);
                return ['code' => 200, 'data' => '', 'msg' => '删除成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                //  writelog(session('uid'),session('username'),'文章【'.$title.'】删除失败',2);
                return ['code' => 100, 'data' => '', 'msg' => '删除失败'];
            }
        }
        
        
    }
