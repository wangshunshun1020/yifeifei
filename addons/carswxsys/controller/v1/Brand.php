<?php


namespace addons\carswxsys\controller\v1;


use addons\carswxsys\controller\BaseController;
use addons\carswxsys\model\Brand as BrandModel;
use addons\carswxsys\model\Brandcars as BrandcarsModel;
use addons\carswxsys\lib\exception\MissException;

/**
 * Banner资源
 */
class Brand extends BaseController
{


    public function getBrandCarsList()
    {

        $id = input('post.id');

        $map['pid'] = $id;
        $list = BrandcarsModel::getList($map);

        return json_encode($list);

    }


    public function getBrandList()
    {


        $BrandModel = new BrandModel();

        $brandlist = $BrandModel->getBrandlistgroup(array('enabled' => 1));


        if (!$brandlist) {
            throw new MissException([
                'msg' => '请求不存在',
                'errorCode' => 40000
            ]);
        }


        $i = 0;

        foreach ($brandlist as $k => $v) {


            $list = $BrandModel->getListByWhere(array('enabled' => 1, 'firstname' => $v['firstname']), 'sort desc');


            $brandlist[$i]['firstname'] = $v['firstname'];
            $brandlist[$i]['brandlist'] = $list;


            unset($list);


            $i++;


        }


        return json_encode($brandlist);
    }
}