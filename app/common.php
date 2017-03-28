<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 获取footer
 * return footer
 * @return string
 */
function footer() : string {
    $data = date('Y');
    return "<footer data-am-widget=\"footer\"
            class=\"am-footer am-footer-default\"
            data-am-footer=\"{  }\">
            <div class=\"am-footer-miscs \"> 
            <p>CopyRight©$data  <a href='https://blog.coderwu.com' target='_blank'>coderWu</a></p>
            </div>
           </footer>";
}

/**
 * 获取header
 * @param string $title
 * @return string
 */
function getHeader(string $title) : string {
    return '<header class="am-topbar am-topbar-inverse"><h1 class="am-topbar-brand">
            <a href="#">' . $title . '</a></h1>
            <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: \'#doc-topbar-collapse\'}">
            <span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
            <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav">
            <li><a href="' . \think\Config::get("WEB_ROOT") . '/public/index.php/index/Index/votePage">首页</a></li>
            <li><a href="' . \think\Config::get("WEB_ROOT") . '/public/index.php/index/Index/createVote">发起投票</a></li>
            <li><a id="admin">添加用户</a></li>
            </ul><div class="am-topbar-right">
            <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" id="name">
            </div></div></header>';
}
