<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?><style>    .fui-list-inner .text{        color: #999;        font-size: .6rem;    }    .fui-list-inner .title{        font-size: .65rem;    }    .fui-list.goods-item{        height: 3rem;    }    .fui-list{        background: #fff;    }</style><div class='fui-page  fui-page-current member-log-page'>    <div class="fui-header">        <div class="fui-header-left">            <a class="back"></a>        </div>        <div class="title">积分记录</div>    </div></div><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>