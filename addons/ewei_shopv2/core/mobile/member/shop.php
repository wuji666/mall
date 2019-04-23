<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Shop_EweiShopV2Page extends MobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $member = pdo_get('ewei_shop_member', array('id' => $_W['ewei_shopv2_member']['id']));
        $shopid = $member['shopid'];
        include $this->template();
    }

    /**
     * 用户绑定店铺 iD
     */
    public function bound()
    {
        global $_W;
        global $_GPC;
        $data = $_POST;
        $verifycode = trim($data['verifycode']);
        $mobile = trim($data['mobile']);
        $shopid = trim($data['shopid']);

        $key = '__ewei_shopv2_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;
        if (!isset($_SESSION[$key]) || $_SESSION[$key] !== $verifycode || !isset($_SESSION['verifycodesendtime']) || $_SESSION['verifycodesendtime'] + 600 < time()) {
            show_json(0, '验证码错误或已过期');
        }
        if (empty($shopid)) {
            show_json(0, '店铺ID不能为空');
        }
        unset($data['mobile']);
        unset($data['verifycode']);
        $a = pdo_update('ewei_shop_member', $data, array('id' => $_W['ewei_shopv2_member']['id'], 'uniacid' => $_W['uniacid']));
        if ($a){
            show_json(1, '店铺ID绑定成功');
        }else{
            show_json(0, '请检查门店ID是否已经绑定');
        }
    }
}