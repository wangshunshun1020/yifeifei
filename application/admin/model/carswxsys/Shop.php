<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    use think\Db;
    
    class Shop extends Model
    {
        protected $name = 'carswxsys_shop';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        /**
         * 根据搜索条件获取列表信息
         * @author
         */
        public function getShopByWhere($map, $Nowpage, $limits, $od)
        {
    
            return $this->alias ('g')
                ->field('g.id AS id, g.shopname AS shopname,g.name AS name, g.tel AS tel,g.address AS address,g.createtime AS createtime,g.sort AS sort,g.status AS status,c.id AS cityid, c.name AS cityname')
                ->join('carswxsys_city c', 'g.cityid = c.id')
                ->where($map)
                ->page($Nowpage, $limits)
                ->order($od)
                ->select();
            
            
        }
        
        public function getShopCount($map)
        {
            return $this->alias ('g')
                ->field('g.id AS id, g.shopname AS shopname,g.name AS name, g.tel AS tel,g.address AS address,g.createtime AS createtime,g.sort AS sort,g.status AS status,c.id AS cityid, c.name AS cityname')
                ->join('carswxsys_city c', 'g.cityid = c.id')
                ->where($map)
                ->count();
        }
        
        
        
        public function getAllShopList($map, $od)
        {
    
            return $this->alias ('g')
                ->field('g.id AS id, g.shopname AS shopname,g.name AS name, g.tel AS tel,g.address AS address,g.createtime AS createtime,g.sort AS sort,c.id AS cityid, c.name AS cityname')
                ->join('carswxsys_city c', 'g.cityid = c.id')
                // ->join('areainfo a', 'g.areaid = a.id')
                ->where($map)
                ->order($od)
                ->select();
        }
        
        
        public static function getCount()
        {
            
            $map = [];
            $count = self::where($map)->count();
            return $count;
        }
        
        /**
         * [insertShop 添加]
         * @author
         */
        public function insertShop($param)
        {
            Db::startTrans();// 启动事务
            try {
                
                
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '企业添加成功'];
            } catch (\Exception $e) {
                
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '企业添加失败'];
            }
        }
        
        
        /**
         * [updateShop 编辑]
         * @author
         */
        public function updateShop($param)
        {
            Db::startTrans();// 启动事务
            try {
                
                $this->allowField(true)->save($param, ['id' => $param['id']]);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '编辑成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '编辑失败'];
            }
        }
        
        
        /**
         * [getOneShop 根据id获取一条信息]
         * @author
         */
        public function getOneShop($id)
        {
            return $this->where('id', $id)->find();
        }
        
        
        /**
         * [delShop 删除]
         * @author
         */
        public function delShop($id)
        {
            $title = $this->where('id', $id)->value('companyname');
            Db::startTrans();// 启动事务
            try {
                $this->where('id', $id)->delete();
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '企业删除成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '企业删除失败'];
            }
        }
        
        
    }
