<?php
    
    namespace addons\carswxsys\model;
    
    use think\Db;
    
    class User extends BaseModel
    {
        protected $autoWriteTimestamp = true;
//    protected $createTime = ;
        protected $name = 'carswxsys_user';
        
        public function orders()
        {
            return $this->hasMany('Order', 'user_id', 'id');
        }
        
        public function address()
        {
            return $this->hasOne('UserAddress', 'user_id', 'id');
        }
        
        
        public function updateUser($param)
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
        
        /**
         * 用户是否存在
         * 存在返回uid，不存在返回0
         */
        public static function getByOpenID($openid)
        {
            $user = User::where('openid', '=', $openid)->find();
            return $user;
        }
        
        public static function getByUserWhere($map)
        {
            $user = User::where($map)->find();
            $user['avatarUrl'] = cdnurl($user['avatarUrl'], true);
            return $user;
        }
        
        
        public static function getByUserlistWhere($map)
        {
            
            $userlist = user::where($map)->order('create_time desc')->select();
            
            /*
            
            if(!$userlist->isEmpty())
            {
                
                foreach ($userlist as $k=>$v)
                {
                    
                    echo $v['create_time'];
                    
                    //$userlist[$k]['createtime'] = date('Y-m-d',$v['create_time']);
                }
            }
            
            */
            
            return $userlist;
        }
        
    }
