<?php

namespace addons\carswxsys\model;


class Brand extends BaseModel
{


    protected $name = 'carswxsys_brand';

    public function getListByWhere($map, $od)
    {
        $list = $this
            ->field('id,name,thumb')
            ->where($map)
            ->order($od)
            ->select();


        if ($list) {
            foreach ($list as $k => $v) {
                if ($v['thumb'])
                    $list[$k]['thumb'] = cdnurl($v['thumb'], true);


            }

        }


        return $list;

    }


    public static function getOne($id)
    {

        $brandinfo = self::where('id', '=', $id)->find();


        return $brandinfo;

    }


    public function getBrandlistgroup($map)
    {

        // 获取所有符合条件的数据，按 firstname 排序
        $allBrands = $this->where($map)
            ->order('firstname')
            ->select()
            ->toArray(); // ThinkPHP5中记得加 toArray()

        $groupedBrands = [];

        foreach ($allBrands as $brand) {
            $key = $brand['firstname'];
            // 每个 firstname 只取第一个品牌作为代表
            if (!isset($groupedBrands[$key])) {
                $brand['thumb'] = cdnurl($brand['thumb'], true); // 处理图片路径
                $groupedBrands[$key] = $brand;
            }
        }

        // 转为索引数组返回
        return array_values($groupedBrands);
    }

}
