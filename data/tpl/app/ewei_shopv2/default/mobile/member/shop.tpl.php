<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .fui-cell-group .fui-cell .fui-cell-label{
        width:4.2rem;
    }
</style>
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back" onclick='location.back()'></a>
        </div>
        <div class="title">绑定店铺ID</div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content' style='margin-top:5px;'>
        <div class="fui-cell-group">
            <div class="fui-cell must">
                <div class="fui-cell-label">手机号</div>
                <div class="fui-cell-info"><input type="tel" class='fui-input' id='mobile' name='mobile' placeholder="请输入您的手机号"  value="<?php  echo $member['mobile'];?>" maxlength="11" disabled /></div>
            </div>
            <div class="fui-cell must">
                <div class="fui-cell-label">短信验证码</div>
                <div class="fui-cell-info"><input type="tel" class='fui-input' id='verifycode' name='verifycode' placeholder="5位验证码"  value="" maxlength="5" /></div>
                <div class="fui-cell-remark noremark"><a class="btn btn-default btn-default-o btn-sm" id="btnCode">获取验证码</a></div>
            </div>
            <div class="fui-cell must">
                <div class="fui-cell-label">店 铺 I D</div>
                <div class="fui-cell-info"><input type="text" class='fui-input' id='shop_id' name='shopid' placeholder="请输入所在的店铺ID"  value="" /></div>
            </div>
        </div>

        <a href='#' id='binding' class='btn btn-danger block mtop'>立即绑定</a>

    </div>

    <script language='javascript'>

        require(['biz/member/account'], function (modal) {
            modal.initBind({
                endtime: <?php  echo intval($endtime)?>,
                backurl: "<?php  echo $_GPC['backurl'];?>",
                imgcode: <?php  echo intval($wapset['smsimgcode'])?>
        });
        });

        $('#binding').click(function () {
            var mobile = $('#mobile').val();
            var verifycode = $('#verifycode').val();
            var shopid = $('#shop_id').val();

            $.post("http://www.hmj.cn/app/index.php?i=2&j=2&c=entry&m=ewei_shopv2&do=mobile&r=member.shop.bound",{
                'mobile':mobile,
                'verifycode':verifycode,
                'shopid':shopid,
            },function (res) {
                alert(res.result.message)
            })
        })
    </script>



</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>



