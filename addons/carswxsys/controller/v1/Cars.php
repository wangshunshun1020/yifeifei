<?php


namespace addons\carswxsys\controller\v1;


use addons\carswxsys\controller\BaseController;

use addons\carswxsys\model\Cars as CarsModel;
use addons\carswxsys\model\Brand as BrandModel;
use addons\carswxsys\model\Carprice as CarpriceModel;
use addons\carswxsys\model\Province as ProvinceModel;
use addons\carswxsys\model\City as CityModel;
use addons\carswxsys\model\Areainfo as AreaModel;
use addons\carswxsys\model\Sysinit as SysinitModel;
use addons\carswxsys\model\Carsave as CarsaveModel;
use addons\carswxsys\lib\exception\MissException;
use addons\carswxsys\service\Token;
use app\common\library\Upload;

class Cars extends BaseController
{


    public function getPubInit()
    {

        $smap = ['id' => ['gt', 1]];
        $datainfo = [];
        $provincelist = ProvinceModel::getAll($smap);

        foreach ($provincelist as $k => $v) {
            # code...

            $citylist = CityModel::getAll(array('pid' => $v['id']));

            $datainfo[$v['id']]['citylist'] = $citylist;


            foreach ($citylist as $k2 => $v2) {


                $arealist = AreaModel::getAll(array('pid' => $v['id'], 'cityid' => $v2['id']));

                $datainfo[$v['id']][$v2['id']]['arealist'] = $arealist;

            }

        }


        $cityinfo = CityModel::getAll(array('pid' => $provincelist[0]['id']));


        $areainfo = AreaModel::getAll(array('cityid' => $cityinfo[0]['id']));

        $list[0] = $provincelist;
        $list[1] = $cityinfo;
        $list[2] = $areainfo;


        $data = array(
            'list' => $list,
            'datainfo' => $datainfo
        );

        return json_encode($data);

    }


    public function getCarslist()
    {
        $shopid = input('post.shopid');

        $uid = Token::getCurrentUid();

        if ($shopid > 0) {

            $map['r.shopid'] = $shopid;
        }


        $od = "r.createtime desc";
        $map['r.uid'] = $uid;
        $map['r.status'] = 1;
        $map['r.ischeck'] = 1;

        $Nowpage = input('post.page');
        if ($Nowpage) $Nowpage = $Nowpage; else
            $Nowpage = 1;

        $limits = $Nowpage * 10;
        $Nowpage = 1;


        $CarsModel = new CarsModel();
        $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);


        $data = array(
            'carslist' => $carslist
        );


        return json_encode($data);


    }


    public function myPubcars()
    {

        $uid = Token::getCurrentUid();


        $od = "r.createtime desc";
        $map['r.uid'] = $uid;

        $limits = 100;
        $Nowpage = 1;


        $CarsModel = new CarsModel();
        $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);


        $data = array(
            'carslist' => $carslist
        );


        return json_encode($data);


    }


    public function getShopcenterCarslist()
    {
        $shopid = input('post.shopid');

        $uid = Token::getCurrentUid();

        if ($shopid > 0) {

            $map['r.shopid'] = $shopid;
        }


        $od = "r.createtime desc";
        $map['r.uid'] = $uid;
        $limits = 100;
        $Nowpage = 1;


        $CarsModel = new CarsModel();
        $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);


        $data = array(
            'carslist' => $carslist
        );


        return json_encode($data);


    }


    public function getCarslistIndex()
    {



        $btprice = input('post.btprice');

        $newtitle = input('post.newtitle');


        $brandid = input('post.brandid');

        $sbrandid = input('post.sbrandid');

        $is_sell = input('post.is_sell');


        if ($is_sell !== null && $is_sell !== '') {

            $map['r.is_sell'] = $is_sell;
        }




        if ($brandid > 0) {
            $map['r.brandid'] = $brandid;

        }

        if ($sbrandid > 0) {
            $map['r.sbrandid'] = $sbrandid;

        }


        $od = "r.createtime desc";


        if ($newtitle != '') {
            if ($newtitle == '价格最低') {
                $od = "r.money asc";

            } elseif ($newtitle == '价格最高') {

                $od = "r.money desc";

            } elseif ($newtitle == '里程最少') {

                $od = "r.carkm asc";

            } elseif ($newtitle == '车龄最短') {

                $od = "r.carage asc";

            } else {

                $od = "r.createtime desc";

            }

        }

        if (!empty($btprice)) {

            if ($btprice == '从低到高') {
                $od = "r.money asc";


            } elseif ($btprice == '从高到低') {

                $od = "r.money desc";


            } elseif ($btprice == '不限价格') {


            } else {

                // echo 'd';

                $btprice_arr = explode('-', $btprice);
                $am = $btprice_arr[0];
                $bm = $btprice_arr[1];

                $map['r.money'] = array(array('gt', $am), array('elt', $bm));


            }


        }

        $map['r.status'] = 1;
        $map['r.ischeck'] = 1;
        $map['r.toptime'] = array('lt', time());
        $Nowpage = input('post.page');
        if ($Nowpage) $Nowpage = $Nowpage; else
            $Nowpage = 1;

        $limits = $Nowpage * 10;
        $Nowpage = 1;

        $CarsModel = new CarsModel();
        $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);

        $map['r.toptime'] = array('gt', time());

        $topcarslist = $CarsModel->getCarsByWhere($map, 1, 50, $od);

        $data = array(
            'topcarslist' => $topcarslist,
            'carslist' => $carslist
        );

        return json_encode($data);


    }


    public function getCarslistCount()
    {

        $cartype = input('post.cartype');
        $carkm = input('post.carkm');
        $carage = input('post.carage');
        $carchange = input('post.carchange');
        $carpl = input('post.carpl');
        $carrate = input('post.carrate');
        $carcolor = input('post.carcolor');
        $carfuel = input('post.carfuel');
        $carpos = input('post.carpos');


        $od = "r.createtime desc";

        $map = array();

        if ($cartype) {

            $map['r.cartype'] = $cartype;
        }

        if ($carkm) {

            $carkm_arr = explode('-', $carkm);
            $am = $carkm_arr[0];
            $bm = $carkm_arr[1];
            $map['r.carkm'] = array(array('gt', $am), array('elt', $bm));


        }

        if ($carage) {

            $carage_arr = explode('-', $carage);
            $am = $carage_arr[0];
            $bm = $carage_arr[1];
            $map['r.carage'] = array(array('gt', $am), array('elt', $bm));
        }

        if ($carchange) {

            $map['r.carchange'] = $carchange;
        }

        if ($carpl) {

            $map['r.carpl'] = $carpl;
        }

        if ($carrate) {

            $map['r.carrate'] = $carrate;
        }

        if ($carcolor) {

            $map['r.carcolor'] = $carcolor;
        }

        if ($carfuel) {

            $map['r.carfuel'] = $carfuel;
        }

        if ($carpos) {

            $map['r.carpos'] = $carpos;
        }

        $map['r.status'] = 1;
        $map['r.ischeck'] = 1;

        $limits = 1000000;
        $Nowpage = 1;

        if (count($map) > 0) {
            $CarsModel = new CarsModel();
            $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);
            $carscount = count($carslist);
        } else {

            $carscount = 0;
        }


        $data = array(
            'carscount' => $carscount
        );


        return json_encode($data);


    }


    public function getCarsSearchlist()
    {

        $cartype = input('post.cartype');
        $carkm = input('post.carkm');
        $carage = input('post.carage');
        $carchange = input('post.carchange');
        $carpl = input('post.carpl');
        $carrate = input('post.carrate');
        $carcolor = input('post.carcolor');
        $carfuel = input('post.carfuel');
        $carpos = input('post.carpos');


        $od = "r.createtime desc";

        $map = array();

        if ($cartype) {

            $map['r.cartype'] = $cartype;
        }

        if ($carkm) {

            $carkm_arr = explode('-', $carkm);
            $am = $carkm_arr[0];
            $bm = $carkm_arr[1];
            $map['r.carkm'] = array(array('gt', $am), array('elt', $bm));


        }

        if ($carage) {

            $carage_arr = explode('-', $carage);
            $am = $carage_arr[0];
            $bm = $carage_arr[1];
            $map['r.carage'] = array(array('gt', $am), array('elt', $bm));
        }

        if ($carchange) {

            $map['r.carchange'] = $carchange;
        }

        if ($carpl) {

            $map['r.carpl'] = $carpl;
        }

        if ($carrate) {

            $map['r.carrate'] = $carrate;
        }

        if ($carcolor) {

            $map['r.carcolor'] = $carcolor;
        }

        if ($carfuel) {

            $map['r.carfuel'] = $carfuel;
        }

        if ($carpos) {

            $map['r.carpos'] = $carpos;
        }


        $Nowpage = input('post.page');
        if ($Nowpage) $Nowpage = $Nowpage; else
            $Nowpage = 1;

        $limits = $Nowpage * 10;
        $Nowpage = 1;

        if (count($map) > 0) {
            $CarsModel = new CarsModel();
            $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);
        } else {

            $carslist = array();
        }


        $data = array(
            'carslist' => $carslist
        );


        return json_encode($data);


    }


    public function getSelectCars()
    {

        $priceid = input('post.priceid');
        $brandid = input('post.brandid');

        $special = input('post.special');
        $keyword = input('post.keyword');


        $od = "r.createtime desc";

        $map = array();

        $brandinfo = [];
        $priceinfo = [];

        if ($keyword != '') {

            $map['r.title'] = ['like', "%" . $keyword . "%"];;

        }
        if ($brandid > 0) {

            $map['r.brandid'] = $brandid;
            $brandinfo = BrandModel::getOne($brandid);
        }

        if ($priceid > 0) {

            $priceinfo = CarpriceModel::getOne($priceid);

            $am = $priceinfo['beginprice'];
            $bm = $priceinfo['endprice'];
            $map['r.money'] = array(array('gt', $am), array('elt', $bm));

        }

        if ($special != '') {
            $map['r.special'] = ['like', "%" . $special . "%"];
        }


        $map['r.status'] = 1;
        $map['r.ischeck'] = 1;

        $Nowpage = input('post.page');
        if ($Nowpage) $Nowpage = $Nowpage; else
            $Nowpage = 1;

        $limits = $Nowpage * 10;
        $Nowpage = 1;


        $CarsModel = new CarsModel();
        $carslist = $CarsModel->getCarsByWhere($map, $Nowpage, $limits, $od);


        $data = array(
            'carslist' => $carslist,
            'brandinfo' => $brandinfo,
            'priceinfo' => $priceinfo
        );


        return json_encode($data);


    }


    public function getCarsDetail()
    {

        $id = input('post.id');

        $CarsModel = new CarsModel();

        $map = array('r.id' => $id);

        $carsinfo = $CarsModel->getCars($map);


        $count = 10;
        if ($count) {
            $carsinfo['carscount'] = $count;
        } else {

            $carsinfo['carscount'] = 0;
        }

        if (!$carsinfo) {
            throw new MissException([
                'msg' => '请求数据不存在',
                'errorCode' => 40000
            ]);
        }


        return $carsinfo;
    }


    public function saveCars()
    {
        if (request()->isPost()) {


            $param = input('post.');

            file_put_contents(__DIR__ . '/car_add.log', json_encode(array($param)) . PHP_EOL, FILE_APPEND);

            $param['uid'] = Token::getCurrentUid();

            $param['status'] = 1;

            $param['createtime'] = time();


            $cars = new CarsModel();

            $data = $cars->insertCars($param);

            return $data;
        }


    }


    public function updateCars()
    {
        if (request()->isPost()) {


            $param = input('post.');

            file_put_contents(__DIR__ . '/car_up.log', json_encode(array($param)) . PHP_EOL, FILE_APPEND);

            $param['uid'] = Token::getCurrentUid();

            $param['createtime'] = time();


            $cars = new CarsModel();

            $data = $cars->updateCars($param);

            return $data;
        }


    }


    public function delCars()
    {
        if (request()->isPost()) {

            $param = input('post.');
            $param['uid'] = Token::getCurrentUid();

            $cars = new CarsModel();

            $data = $cars->delCars($param);

            return $data;
        }


    }

    public function downCars()
    {
        if (request()->isPost()) {

            $param = input('post.');
            $param['uid'] = Token::getCurrentUid();
            $param['status'] = 1;

            $cars = new CarsModel();

            $data = $cars->updateCars($param);

            return $data;
        }


    }

    public function upCars()
    {
        if (request()->isPost()) {

            $param = input('post.');
            $param['uid'] = Token::getCurrentUid();
            $param['status'] = 0;

            $cars = new CarsModel();

            $data = $cars->updateCars($param);

            return $data;
        }


    }

    public function uploadImg()
    {

        $upload = new Upload();

        $file = request()->file('file');
        $upload->setFile($file);
        $fileinfo = $upload->upload();
        $data = array('imgpath' => $fileinfo['url']);
        return json_encode($data);

    }

    public function getXypub()
    {

        $sysinfo = SysinitModel::getSysinfo();

        $data = array(
            'sysinfo' => $sysinfo
        );


        return json_encode($data);

    }


    public function carSave()//收藏车辆
    {
        if (request()->isPost()) {

            $param = input('post.');
            $param['uid'] = Token::getCurrentUid();

            $map['carid'] = $param['carid'];
            $map['uid'] = $param['uid'];

            $carsave = CarsaveModel::getCarsaveWhere($map);
            $carsavemodel = new CarsaveModel();
            if ($carsave) {


                $carsavemodel->delCarsave($map);

                $data = json_encode(array('status' => 2, 'msg' => '取消收藏'));

            } else {

                $param['createtime'] = time();

                $data = $carsavemodel->carSave($param);
            }


            return $data;
        }

    }


    public function mySavecar()
    {

        if (request()->isPost()) {

            $uid = Token::getCurrentUid();
            $od = "r.createtime desc";
            $map['r.uid'] = $uid;
            $carsave = new CarsaveModel();
            $list = $carsave->getMySaveList($map, $od);

            $data = array('carsavelist' => $list);
            return json_encode($data);
        }

    }


}
