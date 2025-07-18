<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    use think\Db;
    
    class Brand extends Model
    {
        protected $name = 'carswxsys_brand';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        /**
         * 根据搜索条件文章列表信息
         * @author
         */
        public function getBrandByWhere($map, $Nowpage, $limits, $od)
        {
            return $this->where($map)->page($Nowpage, $limits)->order($od)->select();
            
        }
        
        public function getBrandCount($map)
        {
            return $this->where($map)->count();
            
        }
        
        public function getAllBrand($map, $od)
        {
            
            
            return $this->where($map)->order($od)->select();
            
            
        }
        
        
        /**
         * [insertBrand 添加]
         * @author
         */
        public function insertBrand($param)
        {
            Db::startTrans();// 启动事务
            try {
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '分类添加成功'];
            } catch (\Exception $e) {
                
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '分类添加失败'];
            }
        }
        
        
        /**
         * [updateBrand 编辑]
         * @author
         */
        public function updateBrand($param)
        {
            Db::startTrans();// 启动事务
            try {
                $this->allowField(true)->save($param, ['id' => $param['id']]);
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '分类编辑成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '分类编辑失败'];
            }
        }
        
        
        /**
         * [getOneBrand 根据id获取一条信息]
         * @author
         */
        public function getOneBrand($id)
        {
            return $this->where('id', $id)->find();
        }
        
        
        public function getBrand()
        {
            return $this->order('sort desc')->select();
        }
        
        
        /**
         * [delBrand 删除]
         * @author
         */
        public function delBrand($id)
        {
            $title = $this->where('id', $id)->value('name');
            Db::startTrans();// 启动事务
            try {
                $this->where('id', $id)->delete();
                Db::commit();// 提交事务
                return ['code' => 200, 'data' => '', 'msg' => '分类删除成功'];
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                return ['code' => 100, 'data' => '', 'msg' => '分类删除失败'];
            }
        }
        
        
    }