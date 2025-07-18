<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\work\ershoucar\yifeifei\public/../application/admin\view\carswxsys\cars\add.html";i:1752820741;s:69:"D:\work\ershoucar\yifeifei\application\admin\view\layout\default.html";i:1689043528;s:66:"D:\work\ershoucar\yifeifei\application\admin\view\common\meta.html";i:1689043528;s:68:"D:\work\ershoucar\yifeifei\application\admin\view\common\script.html";i:1689043528;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">
<meta name="robots" content="noindex, nofollow">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">






    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('sort'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sort" data-rule="required" class="form-control" name="row[sort]" type="number">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('provinceid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="provinceid form-control" name="row[provinceid]"  id="selectProvince"   >

                <option value="">请选择省份</option>
                <?php if(is_array($provincelist) || $provincelist instanceof \think\Collection || $provincelist instanceof \think\Paginator): if( count($provincelist)==0 ) : echo "" ;else: foreach($provincelist as $key=>$v): ?>
                <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('cityid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="cityid form-control" name="row[cityid]"  id="selectCity"   >

                <option value="0">请选择城市</option>

            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('areaid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="areaid form-control" name="row[areaid]"  id="selectArea"   >

                <option value="0">请选择区域</option>

            </select>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('注册号'); ?>(如：B-1234):</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-car_number_city" data-rule="required" class="form-control" name="row[car_number_city]" type="text" >
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('brandid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="brandid form-control" name="row[brandid]"  id="selectBrand"   >

                <option value="0">请选择品牌</option>

                <?php if(is_array($brandlist) || $brandlist instanceof \think\Collection || $brandlist instanceof \think\Paginator): if( count($brandlist)==0 ) : echo "" ;else: foreach($brandlist as $key=>$v): ?>
                <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('sbrandid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="sbrandid form-control" name="row[sbrandid]"  id="sbrandid"   >

                <option value="0">请选择车系</option>

            </select>
        </div>
    </div>




    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text">
        </div>
    </div>





    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('售价'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-money" data-rule="required" class="form-control" name="row[money]" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('飞行小时数'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carkm" data-rule="required" class="form-control" name="row[carkm]" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('注册日期'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carnumdate" data-rule="required" class="form-control" name="row[carnumdate]" type="text">
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('退役日期'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-scrap_time" data-rule="required" class="form-control" name="row[scrap_time]" type="text">
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('过户次数'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-transfer_num" data-rule="required" class="form-control" name="row[transfer_num]" type="text">
        </div>
    </div>


    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('carrate'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <select class="carrate form-control" name="row[carrate]"     >
                <option value="" >请选择排放</option>
                <option value="国一" >国一</option>
                <option value="国二" >国二</option>
                <option value="国三" >国三</option>
                <option value="国四" >国四</option>
                <option value="国五" >国五</option>
                <option value="国六" >国六</option>
                <option value="欧一" >欧一</option>
                <option value="欧二" >欧二</option>
                <option value="欧三" >欧三</option>
                <option value="欧四" >欧四</option>
                <option value="欧五" >欧五</option>
                <option value="欧六" >欧六</option>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('发动机型号/推力'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carspl" data-rule="required" class="form-control" name="row[carspl]" type="text">
        </div>
    </div>
 


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('carcolor'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <select class="carcolor form-control" name="row[carcolor]"     >
                <option value="" >请选择颜色</option>
                <option value="银灰色" >银灰色</option>
                <option value="深灰" >深灰</option>
                <option value="黑色" >黑色</option>
                <option value="白色" >白色</option>
                <option value="红色" >红色</option>
                <option value="蓝色" >蓝色</option>
                <option value="咖啡色" >咖啡色</option>
                <option value="香槟色" >香槟色</option>
                <option value="黄色" >黄色</option>
                <option value="紫色" >紫色</option>
                <option value="绿色" >绿色</option>
                <option value="橙色" >橙色</option>
                <option value="粉红色" >粉红色</option>
                <option value="棕色" >棕色</option>
                <option value="冰川白" >冰川白</option>
                <option value="银色" >银色</option>
                <option value="金色" >金色</option>
                <option value="其他" >其他</option>
            </select>
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-tel" data-rule="required" class="form-control" name="row[tel]" type="text">
        </div>
    </div>

    <div class="form-group">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"  ><?php echo __('thumb'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" data-rule="" class="form-control" size="50" name="row[thumb]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-image"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-image"></ul>
        </div>
    </div>

    <div class="form-group" data-field="images">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('thumb_url'); ?></label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-images" class="form-control" size="50" name="row[thumb_url]" type="text" value="" placeholder="组图可以直接从正文进行提取,可以为空">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-images" class="btn btn-danger plupload" data-input-id="c-images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="true" data-preview-id="p-images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-images" class="btn btn-primary fachoose" data-input-id="c-images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-images"></ul>
        </div>
    </div>


    <div class="form-group" data-field="description">
        <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('content'); ?></label>
        <div class="col-xs-12 col-sm-8">

            <textarea id="c-content" class="form-control editor" name="row[content]" cols="30" rows="10"></textarea>

        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('isrecommand'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label for="row[isrecommand]-normal"><input  name="row[isrecommand]" type="radio" value="1" checked=""> 是 </label>
                <label for="row[isrecommand]-hidden"><input  name="row[isrecommand]" type="radio" value="0">否</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('ischeck'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label for="row[ischeck]-normal"><input  name="row[ischeck]" type="radio" value="1" checked=""> 启用</label>
                <label for="row[ischeck]-hidden"><input  name="row[ischeck]" type="radio" value="0" > 禁用</label>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label for="row[status]-normal"><input  name="row[status]" type="radio" value="1" checked=""> 启用</label>
                <label for="row[status]-hidden"><input  name="row[status]" type="radio" value="0"> 禁用</label>
            </div>
        </div>
    </div>





    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
