define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'carswxsys/cars/index' + location.search,
                    add_url: 'carswxsys/cars/add',
                    edit_url: 'carswxsys/cars/edit',
                    del_url: 'carswxsys/cars/del',
                    multi_url: 'carswxsys/cars/multi',
                    table: 'carswxsys_cars',
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
                        {field: 'id', title: __('id'), operate:false},
                        {field: 'nickname', title: __('nickname'), operate:false,},
                        {field: 'provincename', title: __('provinceid'), operate:false,},
                        {field: 'cityname', title: __('cityid'), operate:false,},
                        {field: 'areaname', title: __('areaid'), operate:false,},
                        {field: 'car_number_city', title: __('注册号'), operate:false,},
                        {field: 'brandname', title: __('brandname')},
                        {field: 'scrap_time', title: __('报废日期')},
                        {field: 'transfer_num', title: __('过户次数')},
                        {field: 'sbrandname', title: __('sbrandname'), operate:false},
                        {field: 'title', title: __('title')},
                        {field: 'thumb', title: __('thumb'), operate:false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'money', title: __('售价') ,operate:false,},
                        {field: 'carkm', title: __('carkm'), operate:false,},
                        {field: 'carnumdate', title: __('carnumdate'), operate:false,},
                        {
                            field: 'sort',
                            title: __('sort'),
                            formatter: function (value, row, index) {
                                return '<input type="number" class="form-control text-center text-sort" data-id="' + row.id + '" value="' + value + '" style="width:100px;margin:0 auto;" />';
                            },
                            events: {
                                "dblclick .text-sort": function (e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    return false;
                                }
                            }
                            , operate:false
                        },
                        {field: 'ischeck', title: __('ischeck'), operate:false, formatter: Table.api.formatter.toggle},
                        {field: 'status', title: __('status'), operate:false, formatter: Table.api.formatter.toggle},
                        {field: 'operate', title: __('Operate'), operate:false, table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
        add: function () {


            $(document).on("change", "#selectBrand", function (a) {

                var brandid = $("#selectBrand").val();
                // alert(cityid);
                Fast.api.ajax({
                    url: "carswxsys/cars/getbrandcarslist",
                    type: "post",
                    data: {brandid: brandid},
                }, function (res) {

                    console.log(res);
                    var list = res;
                    $("#sbrandid").empty();
                    $("#sbrandid").append("<option value='0'>请选择车系</option>");
                    $.each(list, function (index) {
                        //循环获取数据
                        console.log(list[index].name);

                        $("#sbrandid").append("<option value="+list[index].id+">"+list[index].name+"</option>");
                    });


                });
            });


            $(document).on("change", "#selectProvince", function (a) {

                var provinceid = $("#selectProvince").val();
                Fast.api.ajax({
                    url: "carswxsys/cars/getCitylist",
                    type: "post",
                    data: {provinceid: provinceid},
                }, function (res) {

                    console.log(res);
                    var list = res;
                    $("#selectCity").empty();
                    $("#selectCity").append("<option value='0'>请选择城市</option>");

                    $("#selectArea").empty();
                    $("#selectArea").append("<option value='0'>请选择区域</option>");

                    $.each(list, function (index) {
                        //循环获取数据
                        $("#selectCity").append("<option value="+list[index].id+">"+list[index].name+"</option>");
                    });


                });
            });

            $(document).on("change", "#selectCity", function (a) {

                var cityid = $("#selectCity").val();
                Fast.api.ajax({
                    url: "carswxsys/cars/getArealist",
                    type: "post",
                    data: {cityid: cityid},
                }, function (res) {

                    console.log(res);
                    var list = res;
                    $("#selectArea").empty();
                    $("#selectArea").append("<option value='0'>请选择区域</option>");
                    $.each(list, function (index) {
                        //循环获取数据
                        $("#selectArea").append("<option value="+list[index].id+">"+list[index].name+"</option>");
                    });


                });
            });




            Controller.api.bindevent();





        },
        edit: function () {


            $(document).on("change", "#selectBrand", function (a) {

                var brandid = $("#selectBrand").val();
                // alert(cityid);
                Fast.api.ajax({
                    url: "carswxsys/cars/getbrandcarslist",
                    type: "post",
                    data: {brandid: brandid},
                }, function (res) {

                    console.log(res);
                    var list = res;
                    $("#sbrandid").empty();
                    $("#sbrandid").append("<option value='0'>请选择车系</option>");
                    $.each(list, function (index) {
                        //循环获取数据
                        console.log(list[index].name);

                        $("#sbrandid").append("<option value="+list[index].id+">"+list[index].name+"</option>");
                    });


                });
            });


            $(document).on("change", "#selectProvince", function (a) {

                var provinceid = $("#selectProvince").val();
                Fast.api.ajax({
                    url: "carswxsys/cars/getCitylist",
                    type: "post",
                    data: {provinceid: provinceid},
                }, function (res) {

                    console.log(res);
                    var list = res;
                    $("#selectCity").empty();
                    $("#selectCity").append("<option value='0'>请选择城市</option>");

                    $("#selectArea").empty();
                    $("#selectArea").append("<option value='0'>请选择区域</option>");


                    $.each(list, function (index) {
                        //循环获取数据
                        $("#selectCity").append("<option value="+list[index].id+">"+list[index].name+"</option>");
                    });


                });
            });

            $(document).on("change", "#selectCity", function (a) {

                var cityid = $("#selectCity").val();
                Fast.api.ajax({
                    url: "carswxsys/cars/getArealist",
                    type: "post",
                    data: {cityid: cityid},
                }, function (res) {

                    console.log(res);
                    var list = res;
                    $("#selectArea").empty();
                    $("#selectArea").append("<option value='0'>请选择区域</option>");
                    $.each(list, function (index) {
                        //循环获取数据
                        $("#selectArea").append("<option value="+list[index].id+">"+list[index].name+"</option>");
                    });


                });
            });



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