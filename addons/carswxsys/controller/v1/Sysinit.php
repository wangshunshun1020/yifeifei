<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    use addons\carswxsys\controller\BaseController;
    
    use addons\carswxsys\model\Adv as BannerModel;
    use addons\carswxsys\model\Nav as NavModel;
    use addons\carswxsys\model\Province as ProvinceModel;
    use addons\carswxsys\model\City as CityModel;
    use addons\carswxsys\model\Brand as BrandModel;
    use addons\carswxsys\model\User as UserModel;
    use addons\carswxsys\model\Sysinit as SysinitModel;
    use addons\carswxsys\model\Carprice as CarpriceModel;

    use addons\carswxsys\service\WXBizDataCrypt;
    use addons\carswxsys\service\Token;
    use think\Config;
    use think\Hook;
 
    
    
    class Sysinit extends BaseController
    {
    
        protected $noNeedLogin = '*';
     
        public function getSysinit()
        {
            
            //读取配置信息
            $sysinfo = SysinitModel::getSysinfo();
            
            //调用幻灯片
            $mapbanner['enabled'] = 1;
            $bannerlist = BannerModel::getBanner($mapbanner);
            
            $navlist = NavModel::getNav();
            
            
            //更新访问量
            $param['id'] = $sysinfo['id'];
            $param['view'] = $sysinfo['view'] + 1;
            $sysinitModel = new SysinitModel();
            $sysinitModel->updateSysView($param);
            //获取推荐品牌
            $BrandModel  = new BrandModel();
            $brandlist =  $BrandModel->getListByWhere(array('enabled'=>1),'sort desc');
            $brandlist = array_slice($brandlist, 0, 15);
            // file_put_contents(__DIR__.'/sysinit.log', json_encode(array($brandlist)).PHP_EOL, FILE_APPEND);
    
            //省市关联
            $smap=[];
            $datainfo =[];
            $provincelist = ProvinceModel::getAll($smap);
            foreach ($provincelist as $k => $v) {

                $citylist = CityModel::getAll(array('pid'=>$v['id']));
                $datainfo[$v['id']]['citylist']  = $citylist;
                
            }
            
            $cityinfo = CityModel::getAll(array('pid'=>$provincelist[0]['id']));
            $list[0] = $provincelist;
            $list[1] = $cityinfo;
            
            //获取自定义价格
            $carpricelist = CarpriceModel::getCarpricelist();
    
    
    
            //配置信息
            $uploadInfo = Config::get('upload');
            
            //如果非服务端中转模式需要修改为中转
            if ($uploadInfo['storage'] != 'local' && isset($uploadInfo['uploadmode']) && $uploadInfo['uploadmode'] != 'server') {
                //临时修改上传模式为服务端中转
                set_addon_config($uploadInfo['storage'], ["uploadmode" => "server"], false);
    
                $uploadInfo = \app\common\model\Config::upload();
                // 上传信息配置后
                Hook::listen("upload_config_init", $uploadInfo);
    
                $uploadInfo = Config::set('upload', array_merge(Config::get('upload'), $uploadInfo));
            }
    
            $uploadInfo['cdnurl'] = $uploadInfo['cdnurl'] ? $uploadInfo['cdnurl'] : cdnurl('', true);
            $uploadInfo['uploadurl'] = preg_match("/^((?:[a-z]+:)?\/\/)(.*)/i", $uploadInfo['uploadurl']) ? $uploadInfo['uploadurl'] : url($uploadInfo['storage'] == 'local' ? '/api/common/upload' : $uploadInfo['uploadurl'], '', false, true);
            
            $data = array( 'cityinfo'=>$cityinfo, 'list'=>$list, 'datainfo'=>$datainfo,'bannerlist' => $bannerlist, 'navlist' => $navlist,'sysinfo' => $sysinfo,'brandlist'=>$brandlist,'carpricelist'=>$carpricelist,'uploadInfo'=>$uploadInfo);
            
            return json_encode($data);
            
        }
        
        public function getUserinit()
        {
            $uid = Token::getCurrentUid();
            
            if (empty($uid)) {
                return json_encode(array('isuser'=>false,'userinfo'=>[]));
            }
            
            $umap['id'] = $uid;
    
            $userinfo =  UserModel::getByUserWhere($umap);
    
            if($userinfo['tel']!='')
            {
                $isuser = true;
            }else{
        
                $isuser =false;
            }
            
            
            $data = array('isuser'=>$isuser,'userinfo'=>$userinfo);
            
            return json_encode($data);
            
            
        }
        
        
        public function getPhone()
        {
            
            $config = get_addon_config('carswxsys');
            
            
            $encryptedData = $this->request->post('encryptedData', '', 'trim');
            $iv = $this->request->post('iv');
            
            if (!$encryptedData || !$iv) {
                $this->error('参数错误！');
            }
            if (strlen($iv) != 24) {
                $this->error('iv不正确！');
            }
            
            $appid = $config['wxappid'];
            $appsecret = $config['wxappsecret'];
            
            $session_key = cache('session_key');
            
            
            $pc = new WXBizDataCrypt($appid, $session_key);
            
            $errCode = $pc->decryptData($encryptedData, $iv, $data);
            $obj = json_decode($data);
            
            
            $tel = $obj->phoneNumber;
            
            $data = array('msg' => '更新成功', 'status' => 0, 'tel' => $tel);
            
            return json_encode($data);
            
            
        }
        
        
        public function updateUsertel()
        {
            
            $uid = Token::getCurrentUid();
            $tel = input('post.tel');
            
            $userModel = new UserModel();
            
            $param['id'] = $uid;
            $param['tel'] = $tel;
            
            $userModel->Updateuser($param);
            $data = array('msg' => '更新成功', 'status' => 0);
            
            return json_encode($data);
        }
        
        
        public function updateUser()
        {
            $nickname = input('post.nickname');
            
            $avatarUrl = input('post.avatarUrl');
    
            $tel = input('post.tel');
            
            $uid = Token::getCurrentUid();
            
            
            $userModel = new UserModel();
            
            $param['id'] = $uid;
            $param['nickname'] = $nickname;
            $param['avatarUrl'] = $avatarUrl;
            $param['tel'] = $tel;
            $param['update_time'] = time();
            
            
            $userModel->Updateuser($param);
            
            
            $map['id'] = $uid;
            
            $userinfo = UserModel::getByUserWhere($map);
            
            
            if ($userinfo['tel'] != '') {
                
                $istel = true;
            } else {
                
                $istel = false;
            }
            
            
            $data = array('msg' => '更新成功', 'status' => 0, 'istel' => $istel);
            
            return json_encode($data);
            
            
        }
        
        
    }