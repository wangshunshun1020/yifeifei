<?php
    
    namespace addons\carswxsys\model;
    
    use think\Db;
    
    class Carsave extends BaseModel
    {
        protected $name = 'carswxsys_carsave';
    
    
        public static function  getCarsaveWhere($map)
        {
        
            $info = self::where($map)->find();
            
            return $info;
        
        }
    
        public  function  delCarsave($map)
        {
            
            Db::startTrans();// 启动事务
            try{
                $this->where($map)->delete();
                Db::commit();// 提交事务
                return true;
            }catch( \Exception $e){
                Db::rollback();// 回滚事务
                return false;
            }
        
        
        }
    
    
    
        public function carSave($param)
        {
        
            Db::startTrans();// 启动事务
            try{
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                $data = array('status'=>0,'msg'=>'收藏成功');
            }catch( \Exception $e){
                Db::rollback();// 回滚事务
            
                $data = array('status'=>1,'msg'=>'收藏失败');
            }
        
        
            return json_encode($data);
        
        }
    
        public  function getMySaveList($map,$od)
        {
            $list =  $this->alias ('r')
                ->field('r.id AS id,c.id AS carid, c.title AS title, c.money AS money,c.newmoney AS newmoney,c.carkm AS carkm, c.carnumdate AS carnumdate,c.thumb AS thumb,c.thumb_url AS thumb_url,c.carspl AS carspl,c.is_sell')
                ->join('carswxsys_cars c', 'c.id = r.carid')
                ->where($map)
                ->order($od)
                ->select();
        
            
            if($list)
            {
                foreach ($list as $k=>$v)
                {
                    
                    $list[$k]['thumb'] = cdnurl($v['thumb'], true);
                
                }
            
            }
        
            return  $list;
        }
        
        
        
    
    }