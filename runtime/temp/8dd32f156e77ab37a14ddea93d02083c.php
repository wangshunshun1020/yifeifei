<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"D:\work\ershoucar\yifeifei\public/../application/admin\view\carswxsys\sysinit\add.html";i:1706286952;s:69:"D:\work\ershoucar\yifeifei\application\admin\view\layout\default.html";i:1689043528;s:66:"D:\work\ershoucar\yifeifei\application\admin\view\common\meta.html";i:1689043528;s:68:"D:\work\ershoucar\yifeifei\application\admin\view\common\script.html";i:1689043528;}*/ ?>
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
                                


<div class="panel panel-default panel-intro">

    <div class="panel-heading">
        <?php echo build_heading(null,FALSE); ?>
        <ul class="nav nav-tabs" data-field="status">
            <li class="<?php echo \think\Request::instance()->get('status') === null ? 'active' : ''; ?>"><a href="#t-all" data-value="" data-toggle="tab"><?php echo __('All'); ?></a></li>
        </ul>
    </div>


    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">

                    <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">




                        <input type="hidden" value="<?php echo $row['id']; ?>" name="row[id]"/>





                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2" >店铺名称:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-name" data-rule="required" class="form-control" name="row[name]" type="text" value="<?php echo htmlentities($row['name']); ?>">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2" >店铺地址:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-name" data-rule="required" class="form-control" name="row[company_address]" type="text" value="<?php echo htmlentities($row['company_address']); ?>">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2" >店铺坐标（经度,纬度）英文逗号分割:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-name" data-rule="required" class="form-control" name="row[company_location]" type="text" value="<?php echo htmlentities($row['company_location']); ?>">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2" >店铺类型(二手车,维修)英文逗号分割:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-name" data-rule="required" class="form-control" name="row[tags]" type="text" value="<?php echo htmlentities($row['tags']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2" ><?php echo __('view'); ?>:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-notecount" data-rule="required" class="form-control" name="row[view]" type="number" value="<?php echo htmlentities($row['view']); ?>">
                            </div>
                        </div>



                        <div class="form-group" data-field="description">
                            <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('content'); ?></label>
                            <div class="col-xs-12 col-sm-8">

                                <textarea id="c-content" class="form-control editor" name="row[content]" cols="30" rows="10" ><?php echo htmlentities($row['content']); ?></textarea>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
