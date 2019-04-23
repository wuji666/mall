<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Credits_EweiShopV2Page extends MobileLoginPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $_GPC['type'] = intval($_GPC['type']);
        include $this->template();
    }

}

?>
