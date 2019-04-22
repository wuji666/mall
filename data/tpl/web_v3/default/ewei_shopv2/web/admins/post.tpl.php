<?php defined('IN_IA') or exit('Access Denied');?><?php  $no_left =true;?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>



<script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/area/cascade.js"></script>

<script type="text/javascript" src="../web/resource/js/lib/moment.js"></script>

<link rel="stylesheet" href="../web/resource/components/datetimepicker/jquery.datetimepicker.css">

<link rel="stylesheet" href="../web/resource/components/daterangepicker/daterangepicker.css">

<style type='text/css'>

    .tabs-container .form-group {overflow: hidden;}

    .tabs-container .tabs-left > .nav-tabs {}

    .tab-goods .nav li {float:left;}

    .spec_item_thumb {position: relative; width: 30px; height: 20px; padding: 0; border-left: none;}

    .spec_item_thumb i {position: absolute; top: -5px; right: -5px;}

    .multi-img-details, .multi-audio-details {margin-top:.5em;max-width: 700px; padding:0; }

    .multi-audio-details .multi-audio-item {width:155px; height: 40px; position:relative; float: left; margin-right: 5px;}

    .region-goods-details {

        background: #f8f8f8;

        margin-bottom: 10px;

        padding: 0 10px;

    }

    .region-goods-left{

        text-align: center;

        font-weight: bold;

        color: #333;

        font-size: 14px;

        padding: 20px 0;

    }

    .region-goods-right{

        border-left: 3px solid #fff;

        padding: 10px 10px;

    }

    <?php  if($item['type']==4) { ?>

    .type-4 {display: none;}

    <?php  } ?>

</style>

<div class="page-header">

    当前位置：

    <span class="text-primary">

    <?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>管理员 <small><?php  if(!empty($item['id'])) { ?>修改【<span class="text-info"><?php  echo $item['title'];?></span>】<?php  } ?><?php  if(!empty($merch_user['merchname'])) { ?>商户名称:【<span class="text-info"><?php  echo $merch_user['merchname'];?></span>】<?php  } ?></small>

    </span>

</div>

<div class="page-content">

    <form method="post">

    <input type="hidden" id="tab" name="tab" value="#tab_basic" />

    <div class="tabs-container tab-goods">

        <div class="tabs-left">

            <ul class="nav nav-tabs" id="myTab">
                <li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">基本</a></li>
            </ul>

            <div class="tab-content  ">
                <div class="region-goods-details row">
                    <div class="region-goods-left col-sm-2">
                        管理员信息
                    </div>
                    <div class="region-goods-right col-sm-10">
                        <input type="hidden" name="uid" id="uid" class="form-control" value="<?php  echo $item['uid'];?>" data-rule-required="true" />

                        <div class="form-group">
                            <label class="col-sm-2 control-label must">管理员账号</label>
                            <div class="col-sm-5"  style="padding-right:0;" >
                                <input type="text" name="username" id="username" class="form-control" value="<?php  echo $item['username'];?>" data-rule-required="true" />
                            </div>
                        </div> <div class="form-group">
                            <label class="col-sm-2 control-label must">手机号码</label>
                            <div class="col-sm-5"  style="padding-right:0;" >
                                <input type="text" name="phone" id="phone" class="form-control" value="<?php  echo $item['phone'];?>" data-rule-required="true" />
                            </div>
                        </div> <div class="form-group">
                            <label class="col-sm-2 control-label must">管理员密码</label>
                            <div class="col-sm-5"  style="padding-right:0;" >
                                <input type="password" name="password" id="password" class="form-control" value="" data-rule-required="true" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">真实姓名</label>

                            <div class="col-sm-5">
                                <input type="text" name="truename" id="truename" class="form-control" value="<?php  echo $item['truename'];?>"/>
                            </div>
                        </div>
                        <div class="form-group dispatch_info">
                        <label class="col-sm-2 control-label">角色信息</label>
                            <div class="col-sm-5">
                                <select class="form-control tpl-category-parent select2" id="job" name="jobid"  data-rule-required="true" >
                                    <?php  if(is_array($category)) { foreach($category as $row) { ?>
                                    <option value="<?php  echo $row['id'];?>" <?php  if($item['jobid']==$row['id']) { ?> selected <?php  } ?> ><?php  echo $row['jobtitle'];?></option>
                                    <?php  } } ?>
                                </select>
                        </div>
                    </div>
                </div>
</div>
</div>
</div>
</div>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 subtitle">
            <input type="submit" value="保存管理" class="btn btn-primary"/>
            <a class="btn btn-default" href="<?php  echo webUrl('admins')?>">返回列表</a>
        </div>
    </div>
    </form>
</div>



<script type="text/javascript">
    window.type = "<?php  echo $item['type'];?>";
    window.virtual = "<?php  echo $item['virtual'];?>";
    require(['bootstrap'], function () {
        $('#myTab a').click(function (e) {
            $('#tab').val( $(this).attr('href'));
            e.preventDefault();
            $(this).tab('show');
        })
    });
    window.optionchanged = false;
    $('form').submit(function () {
        var check = true;
        var uid = $('#uid').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var phone = $('#phone').val();
        var truename = $('#truename').val();
        var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
        var jobid = $("#job option:selected").val();
        if (username == '') {
           tip.msgbox.err('请填写管理员账号!');
            return false;
        }
        if (phone == '') {
           tip.msgbox.err('请填写手机号!');
            return false;
        }
        if (!myreg.test(phone)) {
            tip.msgbox.err('请填写正确的手机号!');
            return false;
        }
        if (password == '') {
             tip.msgbox.err('密码不能为空!');
            return false;
        }
        if (password.length < 6){
            tip.msgbox.err('密码的长度要大于或等于六位!');
            return false;
        }

        $.post("http://app.ahlzzn.com/web/index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=admins.doadd", {
            uid: uid,
            username: username,
            password: password,
            phone:phone,
            truename:truename,
            jobid:jobid
        }, function (res) {
            if (res.code == 0) {
                tip.msgbox.err(res.msg);
            }else{
                tip.msgbox.err(res.msg);
            }
        },'json')


    });

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

