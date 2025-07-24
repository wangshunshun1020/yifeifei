<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"D:\work\ershoucar\yifeifei\public/../application/admin\view\carswxsys\cars\edit.html";i:1753339545;s:69:"D:\work\ershoucar\yifeifei\application\admin\view\layout\default.html";i:1689043528;s:66:"D:\work\ershoucar\yifeifei\application\admin\view\common\meta.html";i:1689043528;s:68:"D:\work\ershoucar\yifeifei\application\admin\view\common\script.html";i:1689043528;}*/ ?>
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
    <input type="hidden" value="<?php echo $row['id']; ?>" name="row[id]"/>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('sort'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sort" data-rule="required" class="form-control" name="row[sort]" type="number" value="<?php echo htmlentities($row['sort']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities($row['title']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('售价'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-money" data-rule="required" class="form-control" name="row[money]" type="text" value="<?php echo htmlentities($row['money']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('飞行小时数'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carkm"  class="form-control" name="row[carkm]" type="text" value="<?php echo htmlentities($row['carkm']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" >类型:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="brandid form-control" name="row[is_sell]"  id="selectType"   >
                <option value="1" <?php if($row['is_sell'] == '1'): ?>selected<?php endif; ?>>出售</option>
                <option value="0" <?php if($row['is_sell'] == '0'): ?>selected<?php endif; ?>>出租</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('brandid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="brandid form-control" name="row[brandid]" id="selectBrand">
                <option value="0" <?php if($row['brandid'] == '0'): ?>selected<?php endif; ?>>请选择品牌</option>
                <?php if(is_array($brandlist) || $brandlist instanceof \think\Collection || $brandlist instanceof \think\Paginator): if( count($brandlist)==0 ) : echo "" ;else: foreach($brandlist as $key=>$v): ?>
                <option value="<?php echo $v['id']; ?>" <?php if($row['brandid'] == $v['id']): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>

<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('sbrandid'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <select class="sbrandid form-control" name="row[sbrandid]" id="sbrandid">-->
<!--                <option value="0" <?php if($row['sbrandid'] == '0'): ?>selected<?php endif; ?>>请选择车系</option>-->
<!--                <?php if(is_array($brandcarslist) || $brandcarslist instanceof \think\Collection || $brandcarslist instanceof \think\Paginator): if( count($brandcarslist)==0 ) : echo "" ;else: foreach($brandcarslist as $key=>$v): ?>-->
<!--                <option value="<?php echo $v['id']; ?>" <?php if($row['sbrandid'] == $v['id']): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>-->
<!--                <?php endforeach; endif; else: echo "" ;endif; ?>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">出厂时间:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-factory_date" class="form-control" name="row[factory_date]" type="text" value="<?php echo (isset($row['factory_date']) && ($row['factory_date'] !== '')?$row['factory_date']:''); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">是否持续适航:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="form-control" name="row[airworthy]">
                <option value="">请选择</option>
                <option value="1" <?php if($row['airworthy'] == '1'): ?>selected<?php endif; ?>>是</option>
                <option value="0" <?php if($row['airworthy'] == '0'): ?>selected<?php endif; ?>>否</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">履历资料是否齐全:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="form-control" name="row[history_complete]">
                <option value="">请选择</option>
                <option value="1" <?php if($row['history_complete'] == '1'): ?>selected<?php endif; ?>>是</option>
                <option value="0" <?php if($row['history_complete'] == '0'): ?>selected<?php endif; ?>>否</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">事故及损伤历史:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea class="form-control" name="row[accident_history]"><?php echo htmlentities($row['accident_history']); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">使用环境:</label>
        <div class="col-xs-12 col-sm-8">
            <input class="form-control" name="row[usage_env]" type="text" value="<?php echo htmlentities($row['usage_env']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">配置及改装记录:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea class="form-control" name="row[modification_record]"><?php echo htmlentities($row['modification_record']); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">保险记录:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea class="form-control" name="row[insurance_record]"><?php echo htmlentities($row['insurance_record']); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">有无产权纠纷:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="form-control" name="row[property_dispute]">
                <option value="">请选择</option>
                <option value="0" <?php if($row['property_dispute'] == '0'): ?>selected<?php endif; ?>>无</option>
                <option value="1" <?php if($row['property_dispute'] == '1'): ?>selected<?php endif; ?>>有</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">是否国内现机:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="form-control" name="row[is_domestic]">
                <option value="">请选择</option>
                <option value="1" <?php if($row['is_domestic'] == '1'): ?>selected<?php endif; ?>>是</option>
                <option value="0" <?php if($row['is_domestic'] == '0'): ?>selected<?php endif; ?>>否</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">能否随时看机交付:</label>
        <div class="col-xs-12 col-sm-8">
            <select class="form-control" name="row[can_view_deliver]">
                <option value="">请选择</option>
                <option value="1" <?php if($row['can_view_deliver'] == '1'): ?>selected<?php endif; ?>>是</option>
                <option value="0" <?php if($row['can_view_deliver'] == '0'): ?>selected<?php endif; ?>>否</option>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('carcolor'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <select class="carcolor form-control" name="row[carcolor]"     >
                <option value="" >请选择颜色</option>
                <option value="银灰色" <?php if($row['carcolor'] == '银灰色'): ?>selected<?php endif; ?> >银灰色</option>
                <option value="深灰" <?php if($row['carcolor'] == '深灰'): ?>selected<?php endif; ?>>深灰</option>
                <option value="黑色" <?php if($row['carcolor'] == '黑色'): ?>selected<?php endif; ?>>黑色</option>
                <option value="白色" <?php if($row['carcolor'] == '白色'): ?>selected<?php endif; ?>>白色</option>
                <option value="红色" <?php if($row['carcolor'] == '红色'): ?>selected<?php endif; ?>>红色</option>
                <option value="蓝色" <?php if($row['carcolor'] == '蓝色'): ?>selected<?php endif; ?>>蓝色</option>
                <option value="咖啡色" <?php if($row['carcolor'] == '咖啡色'): ?>selected<?php endif; ?>>咖啡色</option>
                <option value="香槟色" <?php if($row['carcolor'] == '香槟色'): ?>selected<?php endif; ?>>香槟色</option>
                <option value="黄色" <?php if($row['carcolor'] == '黄色'): ?>selected<?php endif; ?>>黄色</option>
                <option value="紫色" <?php if($row['carcolor'] == '紫色'): ?>selected<?php endif; ?>>紫色</option>
                <option value="绿色" <?php if($row['carcolor'] == '绿色'): ?>selected<?php endif; ?>>绿色</option>
                <option value="橙色" <?php if($row['carcolor'] == '橙色'): ?>selected<?php endif; ?>>橙色</option>
                <option value="粉红色" <?php if($row['carcolor'] == '粉红色'): ?>selected<?php endif; ?>>粉红色</option>
                <option value="棕色" <?php if($row['carcolor'] == '棕色'): ?>selected<?php endif; ?>>棕色</option>
                <option value="冰川白" <?php if($row['carcolor'] == '冰川白'): ?>selected<?php endif; ?>>冰川白</option>
                <option value="银色" <?php if($row['carcolor'] == '银色'): ?>selected<?php endif; ?>>银色</option>
                <option value="金色" <?php if($row['carcolor'] == '金色'): ?>selected<?php endif; ?>>金色</option>
                <option value="其他" <?php if($row['carcolor'] == '其他'): ?>selected<?php endif; ?>>其他</option>
            </select>
        </div>
    </div>

<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('tel'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <input id="c-tel" data-rule="required" class="form-control" name="row[tel]" type="text" value="<?php echo htmlentities($row['tel']); ?>">-->
<!--        </div>-->
<!--    </div>-->

    <div class="form-group">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"  ><?php echo __('thumb'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" data-rule="" class="form-control" size="50" name="row[thumb]" type="text" value="<?php echo htmlentities($row['thumb']); ?>">
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
        <label for="c-images" class="control-label col-xs-12 col-sm-2"><?php echo __('thumb_url'); ?></label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-images" class="form-control" size="50" name="row[thumb_url]" type="text" value="<?php echo htmlentities($row['thumb_url']); ?>" placeholder="组图可以直接从正文进行提取,可以为空">
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
        <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('content'); ?></label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" class="form-control editor" name="row[content]" cols="30" rows="10"><?php echo htmlentities($row['content']); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('isrecommand'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label><input name="row[isrecommand]" type="radio" value="1" <?php echo $row['isrecommand']==1?'checked' : ''; ?>> 是 </label>
                <label><input name="row[isrecommand]" type="radio" value="0" <?php echo $row['isrecommand']==0?'checked' : ''; ?>> 否</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('ischeck'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label><input name="row[ischeck]" type="radio" value="1" <?php echo $row['ischeck']==1?'checked' : ''; ?>> 启用</label>
                <label><input name="row[ischeck]" type="radio" value="0" <?php echo $row['ischeck']==0?'checked' : ''; ?>> 禁用</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2" ><?php echo __('status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label><input name="row[status]" type="radio" value="1" <?php echo $row['status']==1?'checked' : ''; ?>> 启用</label>
                <label><input name="row[status]" type="radio" value="0" <?php echo $row['status']==0?'checked' : ''; ?>> 禁用</label>
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
