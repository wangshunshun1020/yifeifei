<?php
    
    namespace app\admin\model\carswxsys;
    
    use think\Model;
    use think\Db;
    
    class Brandcars extends Model
    {
        protected $name = 'carswxsys_brandcars';
        
        // 开启自动写入时间戳字段
        protected $autoWriteTimestamp = true;
        
        /**
         * 根据搜索条件列表信息
         * @author
         */
        public function getBrandcarsByWhere($map, $Nowpage, $limits, $od)
        {
            file_put_contents(__DIR__.'/b.log', json_encode(array($map, $limits, $od)).PHP_EOL, FILE_APPEND);
            return $this->alias('c')->field('c.id AS id,c.name AS name,c.sort AS sort,c.enabled AS enabled,b.name AS brandname')->join('carswxsys_brand b', 'b.id = c.pid')->where($map)->page($Nowpage, $limits)->order($od)->select();
    
        }
        
        public function getBrandcarsCount($map)
        {
            return $this->alias('c')->field('c.id AS id,c.sort AS sort,c.enabled AS enabled,b.name AS brandname')->join('carswxsys_brand b', 'b.id = c.pid')->where($map)->count();
            
        }
        
        public function getAllBrandcars($map, $od)
        {
            
            
            return $this->where($map)->order($od)->select();
            
            
        }
        
        public static function  getList($map)
        {
            return self::where($map)->order('sort desc')->select();
        }
        
        /**
         * [insertBrandcars 添加]
         * @author
         */
        public function insertBrandcars($param)
        {
            file_put_contents(__DIR__.'/b_inser.log', json_encode(array($param)).PHP_EOL, FILE_APPEND);
            
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
         * [updateBrandcars 编辑]
         * @author
         */
        public function updateBrandcars($param)
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
         * [getOneBrandcars 根据id获取一条信息]
         * @author
         */
        public function getOneBrandcars($id)
        {
            return $this->where('id', $id)->find();
        }
        
        
        public function getBrandcars()
        {
            return $this->order('sort desc')->select();
        }
        
        
        /**
         * [delBrandcars 删除]
         * @author
         */
        public function delBrandcars($id)
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