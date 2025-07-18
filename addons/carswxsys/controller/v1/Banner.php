<?php
    
    
    namespace addons\carswxsys\controller\v1;
    
    
    use addons\carswxsys\controller\BaseController;
    use addons\carswxsys\validate\IDMustBePositiveInt;
    use addons\carswxsys\model\Adv as BannerModel;
    use addons\carswxsys\lib\exception\MissException;
    
    /**
     * 幻灯片相关接口
     */
    class Banner extends BaseController
    {
        /*
         *
         * 获取某个幻灯片详情信息
         */
        
        public function getBanner()
        {
            $validate = new IDMustBePositiveInt();
            $validate->goCheck();
            $map['enabled'] = 1;
            $banner = BannerModel::getBanner($map);
            if (!$banner) {
                throw new MissException(['msg' => '请求banner不存在', 'errorCode' => 40000]);
            }
            
            return $banner;
        }
    }