<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    use think\Db;
    
    class Carprice extends Model
    {
        protected $name = 'carswxsys_carprice';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        
        public function getCarpriceByWhere($map, $Nowpage, $limits, $od)
        {
            return $this->where($map)->page($Nowpage, $limits)->order($od)->select();
            
        }
        
        public function getCarpriceCount($map)
        {
            return $this->where($map)->count();
            
        }
        
        public function getAllCarprice($map, $od)
        {
            
            
            return $this->where($map)->order($od)->select();
            
            
        }
        
        
        /**
         * [insertCarprice 添加]
         * @author
         */
        public function insertCarprice($param)
        {
            Db::startTrans();// 启动事务
            try {
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '添加成功'];
            } catch (\Exception $e) {
                
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '添加失败'];
            }
        }
        
        
        /**
         * [updateCarprice 编辑]
         * @author
         */
        public function updateCarprice($param)
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
         * [getOneCarprice 根据id获取一条信息]
         * @author
         */
        public function getOneCarprice($id)
        {
            return $this->where('id', $id)->find();
        }
        
        
        public static function getOne($map)
        {
            
            return self::where($map)->find();
            
            
        }
        
        
        public function getCarprice()
        {
            return $this->order('sort desc')->select();
        }
        
        
        /**
         * [delCarprice 删除]
         * @author
         */
        public function delCarprice($id)
        {
            $title = $this->where('id', $id)->value('name');
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
