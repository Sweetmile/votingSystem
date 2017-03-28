<?php
/**
 * 显示所有投票
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/10
 * Time: 21:57
 */
?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>投票系统</title>

    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="icon" type="image/png" href="">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="apple-touch-icon-precomposed" href="http://cdn.amazeui.org/amazeui/2.7.2/i/app-icon72x72@2x.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="http://cdn.amazeui.org/amazeui/2.7.2/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">

    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css">

</head>
<body>
{$header}


<span class="am-show-md-down">
    <div class="am-g">
    <div class="am-u-sm-12">
        <ul class="am-list am-list-static am-list-border">
            {volist name='list' id='vote'}
            <li>
                <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
                    <!--列表标题-->
                    <div class="am-list-news-hd am-cf">
                        <!--带更多链接-->
                        {if condition="(strtotime($vote.end_time) > time())"}
                        <a href="{$Think.config.WEB_ROOT}/public/index.php/index/Index/votingPage?id={$vote.id}" class="">
                            <h2>{$vote.title}</h2>
                            <span class="am-list-news-more am-fr">{$vote.end_time}截至 | 投票 &raquo;</span>
                        </a>
                        {else /}
                        <a href="{$Think.config.WEB_ROOT}/public/index.php/index/Index/resultPage?id={$vote.id}" class="">
                            <h2>{$vote.title}</h2>
                            <span class="am-list-news-more am-fr"> &nbsp; 查看结果 &raquo;</span>
                            <span class="am-list-news-more am-btn-danger am-fr">投票已结束</span>
                        </a>
                        {/if}
                    </div>
                    <div class="am-list-news-bd">
                        <ul class="am-list">
                            <li class="am-g am-list-item-dated">
                               <p>{$vote.introduction}</p>
                            </li>
                        </ul>
                    </div>
            </li>
            {/volist}
        </ul>
        <div class="am-g">
            <div class="am-u-sm-4"> &nbsp;</div>
            <div id="page" class="am-u-sm-4">
             {$list->render()}
            </div>
            <div class="am-u-sm-4"> &nbsp;</div>
        </div>
    </div>
</div>
</span>


<span class="am-show-lg-only">
    <div class="am-g">
    <div class="am-u-sm-2">&nbsp;</div>
    <div class="am-u-sm-8">
        <ul class="am-list am-list-static am-list-border">
            {volist name='list' id='vote'}
            <li>
                <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
                    <!--列表标题-->
                    <div class="am-list-news-hd am-cf">
                        <!--带更多链接-->
                        {if condition="(strtotime($vote.end_time) > time())"}
                        <a href="{$Think.config.WEB_ROOT}/public/index.php/index/Index/votingPage?id={$vote.id}" class="">
                            <h2>{$vote.title}</h2>
                            <span class="am-list-news-more am-fr">{$vote.end_time}截至 | 投票 &raquo;</span>
                        </a>
                        {else /}
                        <a href="{$Think.config.WEB_ROOT}/public/index.php/index/Index/resultPage?id={$vote.id}" class="">
                            <h2>{$vote.title}</h2>
                            <span class="am-list-news-more am-fr"> &nbsp; 查看结果 &raquo;</span>
                            <span class="am-list-news-more am-btn-danger am-fr">投票已结束</span>
                        </a>
                        {/if}
                    </div>
                    <div class="am-list-news-bd">
                        <ul class="am-list">
                            <li class="am-g am-list-item-dated">
                               <p>{$vote.introduction}</p>
                            </li>
                        </ul>
                    </div>
            </li>
            {/volist}
        </ul>
        <div class="am-g">
            <div class="am-u-sm-4"> &nbsp;</div>
            <div id="page" class="am-u-sm-4">
             {$list->render()}
            </div>
            <div class="am-u-sm-4"> &nbsp;</div>
        </div>
    </div>
    <div class="am-u-sm-2">&nbsp;</div>
</div>
</span>


{$footer}
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
<script src="{$Think.config.WEB_ROOT}/public/static/js/votePage.js"></script>
<script src="{$Think.config.WEB_ROOT}/public/static/js/header.js"></script>
<script>
    var rootUrl = "{$Think.config.WEB_ROOT}";
    var name = "{$user.name}";
    var admin = "{$user.admin}";
</script>
</body>
</html>

