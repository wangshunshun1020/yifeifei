define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'carswxsys/sysinit/index' + location.search,
                    add_url: 'carswxsys/sysinit/add',
                    edit_url: 'carswxsys/sysinit/edit',
                    del_url: 'carswxsys/sysinit/del',
                    multi_url: 'carswxsys/sysinit/multi',
                    table: 'carswxsys_sysinit',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('id')},
                        {field: 'name', title: '店铺名称'},
                        {field: 'company_address', title: '店铺地址'},
                        {field: 'company_location', title: '店铺坐标'},
                        {field: 'tags', title: '店铺类型'},
                        {field: 'view', title: __('view')},

                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});