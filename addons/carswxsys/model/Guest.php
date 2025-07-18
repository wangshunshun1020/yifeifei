<?php
    
    namespace addons\carswxsys\model;
    
    use think\Db;
    
    class Guest extends BaseModel
    {
        protected $name = 'carswxsys_guest';
        
        
        public static function  getOne($map)
        {
            
            $info = self::where($map)->find();
            
            return $info;
            
        }
        
        
        
        public function guestSave($param)
        {
            
            Db::startTrans();// 启动事务
            try{
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                $data = array('status'=>0,'msg'=>'操作成功');
            }catch( \Exception $e){
                Db::rollback();// 回滚事务
                
                $data = array('status'=>1,'msg'=>'操作失败');
            }
            
            
            return json_encode($data);
            
        }
    
    
        public function updateGuest($param)
        {
        
            Db::startTrans();// 启动事务
            try {
            
                $this->allowField(true)->save($param, ['id' => $param['id']]);
                Db::commit();// 提交事务
                $data = array('status' => 0);
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
            
            
                $data = array('status' => 1);
            }
        
            return json_encode($data);
        
        
        }

        
        
        
        
    }