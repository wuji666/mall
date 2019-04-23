<?php
if (!(defined('IN_IA'))) {
    exit('Access Denied');
}

class Integral_EweiShopV2Page extends WebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        if ($_W['user']['jobid'] != 6){
            $id = pdo_get('ewei_shop_store', array('id'=>$_GPC['id']));
            $integral = pdo_get('users', array('uid'=>$id['uid']));
            include $this->template();
exit();
        }
        $integral = pdo_get('users', array('uid'=>$_W['user']['uid']));
        $integral2 = pdo_getall('ewei_users_integral', array('mid'=>$_W['user']['uid']));

        include $this->template();
    }
}