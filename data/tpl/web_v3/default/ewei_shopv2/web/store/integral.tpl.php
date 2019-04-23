<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    tbody tr td {
        position: relative;
    }

    tbody tr .icow-weibiaoti-- {
        visibility: hidden;
        display: inline-block;
        color: #fff;
        height: 18px;
        width: 18px;
        background: #e0e0e0;
        text-align: center;
        line-height: 18px;
        vertical-align: middle;
    }

    tbody tr:hover .icow-weibiaoti-- {
        visibility: visible;
    }

    tbody tr .icow-weibiaoti--.hidden {
        visibility: hidden !important;
    }

    .full .icow-weibiaoti-- {
        margin-left: 10px;
    }

    .full > span {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        vertical-align: middle;
        align-items: center;
    }

    tbody tr .label {
        margin: 5px 0;
    }

    .goods_attribute a {
        cursor: pointer;
    }

    .newgoodsflag {
        width: 22px;
        height: 16px;
        background-color: #ff0000;
        color: #fff;
        text-align: center;
        position: absolute;
        bottom: 70px;
        left: 57px;
        font-size: 12px;
    }

    .modal-dialog {
        min-width: 720px !important;
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
    }

    .catetag {
        overflow: hidden;

        text-overflow: ellipsis;

        display: -webkit-box;

        -webkit-box-orient: vertical;

        -webkit-line-clamp: 2;
    }
</style>
<div class="page-header">
    当前位置：<span class="text-primary">管理员管理</span>
</div>
<div class="page-content">
    <div class="fixed-header">
        <div style="width:25px;"></div>
        <div style="width:80px;text-align:center;">排序</div>
        <div style="width:80px;">商品</div>
        <div class="flex1">&nbsp;</div>
        <div style="width: 100px;">价格</div>
        <div style="width: 80px;">库存</div>
        <div style="width: 80px;">销量</div>
        <?php  if($goodsfrom!='cycle') { ?>
        <div style="width:80px;">状态</div>
        <?php  } ?>
        <div class="flex1">属性</div>
        <div style="width: 120px;">操作</div>
    </div>
    <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
        <div class="form-group">
            <label class="col-lg control-label">当前积分</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="integral" id="integral" class="form-control" value="<?php  echo $integral['integral'];?>" data-rule-required="true" style="width: 30%;"/>
                <?php  if($_W['user']['jobid'] !=3) { ?>
                <?php  } else { ?>
                <a class="btn btn-primary btn-xs edit_integral" >修改</a>
                <?php  } ?>
            </div>
        </div>

    </form>
    <?php  if($_W['user']['jobid'] !=6) { ?>

    <?php  } else { ?>
    <h2 style="margin-bottom: 10px">积分使用记录</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:15%;">使用日期</th>
                    <th style="width:25%;">积分数量</th>
                    <th style="width:25%;">积分数量</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($integral2)) { foreach($integral2 as $row) { ?>
                <tr>
                    <td><?php  echo date('Y-m-d',$row['usetime'])?></td>
                    <td><?php  echo $row['integralnum'];?></td>
                    <td><?php  if($row['type'] == 1) { ?>增加<?php  } else { ?>减少<?php  } ?></td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php  } ?>
</div>
<script>
    $('.edit_integral').click(function () {
        var integral = $('#integral').val();
        $.post("<?php  echo webUrl('store/index/editintegral')?>",{integral:integral,id:<?php  echo $integral['uid'];?>},function (res) {
            console.log(res);
                tip.msgbox.err(res.result.message);
        },'json')
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/batchcates', TEMPLATE_INCLUDEPATH)) : (include template('goods/batchcates', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
