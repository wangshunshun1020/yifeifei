<?php
/**
 * 菜单配置文件
 */

return [
    [
        'type' => 'file',
        'name' => 'carswxsys',
        'title' => '二手车系统',
        'icon' => 'fa fa-list',
        'condition' => '',
        'remark' => '',
        'ismenu' => 1,
        'sublist' => [


        	[
                'type' => 'file',
                'name' => 'carswxsys/sysinit',
                'title' => '系统设置',
                'icon' => 'fa fa-cogs',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/sysinit/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/sysinit/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/sysinit/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/sysinit/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],


//            [
//                'type' => 'file',
//                'name' => 'carswxsys/province',
//                'title' => '省份管理',
//                'icon' => 'fa fa-location-arrow',
//                'condition' => '',
//                'remark' => '',
//                'ismenu' => 1,
//                'sublist' => [
//
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/province/index',
//                        'title' => '查看',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/province/add',
//                        'title' => '添加',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/province/edit',
//                        'title' => '编辑',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/province/del',
//                        'title' => '删除',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//
//                ],
//            ],


//            [
//                'type' => 'file',
//                'name' => 'carswxsys/city',
//                'title' => '城市管理',
//                'icon' => 'fa fa-location-arrow',
//                'condition' => '',
//                'remark' => '',
//                'ismenu' => 1,
//                'sublist' => [
//
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/city/index',
//                        'title' => '查看',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/city/add',
//                        'title' => '添加',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/city/edit',
//                        'title' => '编辑',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/city/del',
//                        'title' => '删除',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//
//                ],
//            ],


//            [
//                'type' => 'file',
//                'name' => 'carswxsys/area',
//                'title' => '区域管理',
//                'icon' => 'fa fa-compass',
//                'condition' => '',
//                'remark' => '',
//                'ismenu' => 1,
//                'sublist' => [
//
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/area/index',
//                        'title' => '查看',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/area/add',
//                        'title' => '添加',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/area/edit',
//                        'title' => '编辑',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//                    [
//                        'type' => 'file',
//                        'name' => 'carswxsys/area/del',
//                        'title' => '删除',
//                        'icon' => 'fa fa-circle-o',
//                        'condition' => '',
//                        'remark' => '',
//                        'ismenu' => 0,
//                    ],
//
//                ],
//            ],


            [
                'type' => 'file',
                'name' => 'carswxsys/ploite',
                'title' => '举报信息管理',
                'icon' => 'fa fa-film',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/ploite/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                 
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/ploite/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/brand',
                'title' => '品牌管理',
                'icon' => 'fa fa-navicon',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brand/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brand/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brand/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brand/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/guest',
                'title' => '商机大厅管理',
                'icon' => 'fa fa-user',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/guest/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/guest/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/brandcars',
                'title' => '车系管理',
                'icon' => 'fa fa-server',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brandcars/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brandcars/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brandcars/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/brandcars/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/cars',
                'title' => '二手车管理',
                'icon' => 'fa fa-sitemap',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cars/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cars/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cars/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cars/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/user',
                'title' => '用户管理',
                'icon' => 'fa fa-user',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/user/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/user/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/user/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/user/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],
            [
                'type' => 'file',
                'name' => 'carswxsys/cate',
                'title' => '资讯分类管理',
                'icon' => 'fa fa-newspaper-o',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cate/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cate/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cate/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/cate/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],
            [
                'type' => 'file',
                'name' => 'carswxsys/news',
                'title' => '资讯内容管理',
                'icon' => 'fa fa-newspaper-o',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/news/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/news/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/news/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/news/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],


            [
                'type' => 'file',
                'name' => 'carswxsys/adv',
                'title' => '幻灯片管理',
                'icon' => 'fa fa-picture-o',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/adv/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/adv/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/adv/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/adv/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],


            [
                'type' => 'file',
                'name' => 'carswxsys/nav',
                'title' => '自定义导航管理',
                'icon' => 'fa fa-navicon',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/nav/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/nav/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/nav/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/nav/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

        

            [
                'type' => 'file',
                'name' => 'carswxsys/lookrole',
                'title' => '置顶套餐管理',
                'icon' => 'fa fa-gittip',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/lookrole/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/lookrole/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/lookrole/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/lookrole/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/carprice',
                'title' => '价格筛选管理',
                'icon' => 'fa fa-arrows',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/carprice/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/carprice/add',
                        'title' => '添加',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/carprice/edit',
                        'title' => '编辑',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/carprice/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],

            [
                'type' => 'file',
                'name' => 'carswxsys/order',
                'title' => '订单管理',
                'icon' => 'fa fa-arrows',
                'condition' => '',
                'remark' => '',
                'ismenu' => 1,
                'sublist' => [
                   
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/order/index',
                        'title' => '查看',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                    [
                        'type' => 'file',
                        'name' => 'carswxsys/order/del',
                        'title' => '删除',
                        'icon' => 'fa fa-circle-o',
                        'condition' => '',
                        'remark' => '',
                        'ismenu' => 0,
                    ],
                  
                ],
            ],



            
        ],
    ],
];