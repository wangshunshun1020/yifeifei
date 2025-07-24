<?php
    
    namespace addons\carswxsys\model;
    
    use think\Db;

    class Cars extends BaseModel
    {
        protected $name = 'carswxsys_cars';
        
        public function getCarsByCityWhere($map, $Nowpage, $limits, $od)
        {
            $carslist = $this->alias('r')->field('r.transfer_num, r.scrap_time, r.car_number_city,r.per AS per,r.ischeck AS ischeck,r.id AS id,r.title AS title, r.money AS money,r.newmoney AS newmoney,r.carkm AS carkm, r.carnumdate AS carnumdate,r.thumb AS thumb,r.thumb_url AS thumb_url,r.carspl AS carspl,c.name AS cityname,b.name AS brandname ')->join('carswxsys_brand b', 'b.id = r.brandid')
             
                ->join('carswxsys_city c', 'c.id = r.cityid')->where($map)->page($Nowpage, $limits)->order($od)->select();
            
   
            
            if ($carslist) {
                foreach ($carslist as $k => $v) {
                    
                      
                    
                      if($v['thumb']!='')
                         $carslist[$k]['thumb'] = cdnurl($v['thumb'], true);
                    
                    
                }
                
            }
            
            
            return $carslist;
            
        }
        
        
        public function getCarsByWhere($map, $Nowpage, $limits, $od)
        {
            $carslist = $this->alias('r')
                ->field('r.transfer_num,r.is_sell ,r.scrap_time, r.car_number_city,r.per AS per,r.content AS content,r.carfuel AS carfuel,r.carage AS carage,r.cartype AS cartype,r.carrate AS carrate,r.carchange AS carchange,r.carspl AS carspl,r.carpos AS carpos,r.carcolor AS carcolor,b.name AS brandname,r.tel AS tel, b.name AS brandname,r.tel AS tel,r.id AS id,r.title AS title, r.money AS money,r.newmoney AS newmoney,r.carkm AS carkm, r.carnumdate AS carnumdate,r.thumb AS thumb,r.thumb_url AS thumb_url,r.carspl AS carspl,b.name AS brandname,r.status AS status,r.ischeck AS ischeck,r.toptime AS toptime ')
                ->join('carswxsys_brand b', 'b.id = r.brandid','left')
//                ->join('carswxsys_brandcars s', 's.id = r.sbrandid','left')
//                ->join('carswxsys_province p', 'p.id = r.provinceid')
//                ->join('carswxsys_city c', 'c.id = r.cityid')
//                ->join('carswxsys_area a', 'a.id = r.areaid')
                ->where($map)->page($Nowpage, $limits)->order($od)->select();

            
            if ($carslist) {
                foreach ($carslist as $k => $v) {
                    
                      if($v['toptime']>time())
                      {
                          
                          $carslist[$k]['toptime_str'] = date('Y-m-d',$v['toptime']); 
                          
                      }else{
                          
                          $carslist[$k]['toptime_str'] = '未置顶';
                      }
                    
                      if($v['thumb']!='')
                         $carslist[$k]['thumb'] = cdnurl($v['thumb'], true);
                    
                    
                }
                
            }
            
            
            return $carslist;
            
        }
        
        
        public function getCarsTotal($map)
        {
            
            $count = Cars::where($map)->count();
            return $count;
            
        }
        
        
        public function getCars($map)
        {
            
            

            $carsinfo = $this->alias('r')
                ->field('r.transfer_num,r.is_sell ,r.scrap_time, r.car_number_city,r.per AS per,r.content AS content,r.carfuel AS carfuel,r.carage AS carage,r.cartype AS cartype,r.carrate AS carrate,r.carchange AS carchange,r.carspl AS carspl,r.carpos AS carpos,r.carcolor AS carcolor,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,s.name AS sbrandname,b.name AS brandname,r.tel AS tel,r.id AS id,r.title AS title, r.money AS money,r.newmoney AS newmoney,r.carkm AS carkm, r.carnumdate AS carnumdate,r.thumb AS thumb,r.thumb_url AS thumb_url,r.carspl AS carspl,b.name AS brandname,r.status AS status,r.ischeck AS ischeck,r.toptime AS toptime,r.factory_date,r.airworthy,r.history_complete,r.accident_history,r.usage_env,r.modification_record,r.insurance_record,r.property_dispute,r.is_domestic,r.can_view_deliver')
                ->join('carswxsys_brand b', 'b.id = r.brandid','left')
                ->join('carswxsys_brandcars s', 's.id = r.sbrandid','left')
//                ->join('carswxsys_province p', 'p.id = r.provinceid')
//                ->join('carswxsys_city c', 'c.id = r.cityid')
//                ->join('carswxsys_area a', 'a.id = r.areaid')
                ->where($map)->find();
    
    
            $piclist = explode(',', $carsinfo['thumb_url']);
            
            if($carsinfo['thumb'])
             $carsinfo['thumb'] = cdnurl($carsinfo['thumb'], true);
            
            if ($piclist) {
                
                foreach ($piclist as $k => $v) {
                    if($v)
                    {
                        $piclist[$k] = cdnurl($v, true);
                    }else{
                        $piclist[$k] = '';
                        
                    }
                   
                    
                    
                }
                
                
            }
            
            
            $carsinfo['piclist'] = $piclist;
            
            
            return $carsinfo;
            
        }
        
        
        public function shopinfo()
        {
            
            return $this->hasOne('Shop', 'id', 'shopid');
        }
        
        
        public function insertCars($param)
        {
            
            Db::startTrans();// 启动事务
            try {
                
                $this->allowField(true)->save($param);
                Db::commit();// 提交事务
                $data = array('status' => 0);
            } catch (\Exception $e) {
                
                file_put_contents(__DIR__.'/car_add.log', json_encode(array($e->getMessage(), $e->getLine(), $e->getFile())).PHP_EOL, FILE_APPEND);
                Db::rollback();// 回滚事务
                
                $data = array('status' => 1);
            }
            
            return json_encode($data);
            
            
        }
        
        
        public function updateCars($param)
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
        
        
        public function delCars($param)
        {
            $title = $this->where($param)->value('id');
            Db::startTrans();// 启动事务
            try {
                $this->where($param)->delete();
                Db::commit();// 提交事务
                
                $data = array('status' => 0, 'msg' => '删除成功');
            } catch (\Exception $e) {
                Db::rollback();// 回滚事务
                $data = array('status' => 1, 'msg' => '删除失败');
                
            }
            return json_encode($data);
            
        }
        
        
    }
