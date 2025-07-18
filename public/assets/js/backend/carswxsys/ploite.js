define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'carswxsys/ploite/index' + location.search,
                    add_url: 'carswxsys/ploite/add',
                    edit_url: 'carswxsys/ploite/edit',
                    del_url: 'carswxsys/ploite/del',
                    multi_url: 'carswxsys/ploite/multi',
                    table: 'carswxsys_ploite',
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
                        {field: 'type', title: __('type')},
                        {field: 'title', title: __('title'), formatter:Table.api.formatter.image},
                        {field: 'nickname', title: __('nickname')},
                        {field: 'tel', title: __('tel')},
                        {field: 'content', title: __('content')},
                        {field: 'createtime', title: __('createtime')},
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