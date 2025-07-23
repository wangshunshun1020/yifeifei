<?php

namespace app\admin\controller\carswxsys;

use app\common\controller\Backend;
use app\admin\model\carswxsys\Brand as BrandModel;
use app\admin\model\carswxsys\Brandcars as BrandcarsModel;
use app\admin\model\carswxsys\Cars as CarsModel;
use app\admin\model\carswxsys\Province as ProvinceModel;
use app\admin\model\carswxsys\City as CityModel;
use app\admin\model\carswxsys\Area as AreaModel;


/**
 *
 *
 * 二手车管理
 */
class Cars extends Backend
{


    protected $model = null;
    protected $noNeedRight = ['*'];
    protected $multiFields = ['enabled', 'sort', 'status', 'ischeck'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\carswxsys\Cars;

    }


    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);


        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }

            $map = [];

            $field = input('field');//字段
            $order = input('order');//排序方式
            if ($field && $order) {
                $od = $field . " " . $order;
            } else {
                $od = "g.id desc";

            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $filter = $this->request->get("filter", '');
            $filter = (array)json_decode($filter, true);

            if (count($filter) > 0) {

                if (array_key_exists("brandname", $filter)) {

                    $map['b.name'] = $filter['brandname'];
                }


                if (array_key_exists("title", $filter)) {

                    $map['g.title'] = ['like', "%" . $filter['title'] . "%"];
                }

            }

            $cars = new CarsModel();
            $count = $cars->getCarsCount($map);
            $Nowpage = $offset / $limit + 1;

            $list = $cars->getCarsByWhere($map, $Nowpage, $limit, $od);



            if ($list) {
                foreach ($list as $k => $v) {
                    if ($v['uid'] == 0) {
                        $list[$k]['nickname'] = '管理员';
                    }
                    if ($v['toptime'] > time()) {

                        $list[$k]['toptime_str'] = date('Y-m-d', $v['toptime']);

                    } else {

                        $list[$k]['toptime_str'] = '未置顶';
                    }


                }
            }


            $result = array("total" => $count, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    //AJAX获取品牌

    public function getbrandcarslist()
    {

        if ($this->request->isAjax()) {
            $BrandcarsModel = new BrandcarsModel();

            $brandid = input('post.brandid');//字段

            $map['pid'] = $brandid;

            $od = 'sort desc';

            $brandcarslist = $BrandcarsModel->getAllBrandcars($map, $od);


            $this->success('', '', $brandcarslist);

        }


    }

    //Ajax 按省份ID获取城市列表

    public function getCitylist()
    {

        if ($this->request->isAjax()) {

            $provinceid = input('post.provinceid');//字段

            $map['pid'] = $provinceid;
            $map['enabled'] = 1;

            $od = 'sort desc';

            $citylist = CityModel::getCitylist($map);

            $this->success('', '', $citylist);

        }


    }

    //Ajax 按城市ID获取区域列表
    public function getArealist()
    {
        if ($this->request->isAjax()) {

            $cityid = input('post.cityid');//字段

            $map['cityid'] = $cityid;

            $map['enabled'] = 1;

            $od = 'sort desc';

            $arealist = AreaModel::getArealist($map);

            $this->success('', '', $arealist);

        }

    }

    /**
     * 添加
     */
    public function add()
    {


        if ($this->request->isPost()) {


            $params = $this->request->post("row/a");

            file_put_contents(__DIR__ . '/car_add.log', json_encode(array($params)) . PHP_EOL, FILE_APPEND);
            if ($params) {
                $params = $this->preExcludeFields($params);
                // 处理 factory_date 空值
                if (isset($params['factory_date']) && $params['factory_date'] === '') {
                    $params['factory_date'] = null; // 设置为 NULL
                }
                foreach ($params as $k => $v){
                    if ($v === ''){
                        //设置为null
                        $params[$k] = null;
                    }
                    if($k == 'money' && $v == '面议'){
                        $params[$k] = null;
                    }
                }
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                $cars = new CarsModel();

                // if (!empty($params['spe']))
                // $params['special'] = implode(',', $params['special']??"");
                $params['createtime'] = time();


                $result = $cars->insertCars($params);
                if ($result['code'] == 100){
                    $this->error($result['msg']);
                }

                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }


        $brand = new BrandModel();

        $map = [];

        $od = 'sort desc';

        $brandlist = $brand->getAllBrand($map, $od);


        $this->view->assign("brandlist", $brandlist);

        $pmap = [];
        $this->view->assign('provincelist', ProvinceModel::getProvinceList($pmap));

        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = null)
    {

        $cars = new CarsModel();

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            file_put_contents(__DIR__ . '/car_up.log', json_encode(array($params)) . PHP_EOL, FILE_APPEND);

            if ($params) {

                $params = $this->preExcludeFields($params);
                if (isset($params['factory_date']) && $params['factory_date'] === '') {
                    $params['factory_date'] = null; // 设置为 NULL
                }
                foreach ($params as $k => $v){
                    if ($v === ''){
                        //设置为null
                        $params[$k] = null;
                    }
                }
                $result = false;

                // $params['special'] = implode(',', $params['special']??'');

                // file_put_contents(__DIR__.'/car_up.log', json_encode(array($params)).PHP_EOL, FILE_APPEND);
                $result = $cars->updateCars($params);

                if ($result['code'] == 100){
                    $this->error($result['msg']);
                }

                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }


            }


            $this->error(__('Parameter %s can not be empty', ''));
        }


        $row = $cars->getOneCars($ids);


        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }


        $brand = new BrandModel();

        $map = [];

        $od = 'sort desc';

        $brandlist = $brand->getAllBrand($map, $od);

        $this->view->assign("brandlist", $brandlist);

        $bmap = [];
        $bmap['pid'] = $row['brandid'];
        $this->view->assign("brandcarslist", BrandcarsModel::getList($bmap));

        //省份
        $pmap = [];
        $this->view->assign('provincelist', ProvinceModel::getProvinceList($pmap));
        //城市
        $cmap = [];
        $cmap['enabled'] = 1;
        $cmap['pid'] = $row['provinceid'];
        $this->view->assign('citylist', CityModel::getCitylist($cmap));
        //区域
        $amap = [];
        $amap['cityid'] = $row['cityid'];
        $amap['enabled'] = 1;
        $this->view->assign('arealist', AreaModel::getArealist($amap));

        $speciallist = array('准新车', '练手代步', '热销SUV', '舒适MPV');

        $this->view->assign("speciallist", $speciallist);

        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

}
