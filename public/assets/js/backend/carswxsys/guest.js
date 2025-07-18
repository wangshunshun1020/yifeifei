define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'carswxsys/guest/index' + location.search,
                    del_url: 'carswxsys/guest/del',
                    multi_url: 'carswxsys/guest/multi',
                    table: 'carswxsys_guest',
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
                        {field: 'nickname', title: __('nickname')},
                        {field: 'tel', title: __('tel')},
                        {field: 'num', title: __('num')},
                        {field: 'updatetime', title: __('updatetime')},
                        {field: 'provincename', title: __('provinceid')},
                        {field: 'cityname', title: __('cityid')},
                        {field: 'areaname', title: __('areaid')},
                        {field: 'brandname', title: __('brandname')},
                        {field: 'sbrandname', title: __('sbrandname')},
                        {field: 'title', title: __('title')},
                        {field: 'thumb', title: __('thumb'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'money', title: __('money')},
                        {field: 'carkm', title: __('carkm')},
                        {field: 'carnumdate', title: __('carnumdate')},

                        {field: 'createtime', title: __('createtime')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });


            $(document).on("change", ".text-sort", function () {
                $(this).data("params", {sort: $(this).val()});
                Table.api.multi('', [$(this).data("id")], table, this);
                return false;
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },

        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});