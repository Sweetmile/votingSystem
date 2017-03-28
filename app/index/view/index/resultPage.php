<?php
/**
 * 结果界面
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/12
 * Time: 23:30
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
    <title>投票结果-投票系统</title>

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

<span class="am-show-lg-only">
<div class="am-g">
    <div class="am-u-sm-2">&nbsp;</div>
    <div class="am-u-sm-8">
        <div class="am-container">&nbsp;</div>
        <section data-am-widget="accordion" class="am-accordion am-accordion-default">
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                标题
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                {$vote.title}
            </div>
            </dd>
            </dl>
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                介绍
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                {$vote.introduction}
            </div>
            </dd>
            </dl>
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                说明
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                <table class="am-table am-table-bordered">
                    <tbody>
                    <tr>
                        <td>发起人</td>
                        <td>{$vote.create_name}</td>
                    </tr>
                    <tr>
                        <td>开始时间</td>
                        <td>{$vote.create_time}</td>
                    </tr>
                    <tr  class="am-danger">
                        <td>截止日期</td>
                        <td>{$vote.end_time}</td>
                    </tr>
                    <tr>
                        <td>是否匿名</td>
                        <td>
                            {if condition="($vote.anonymity == 1)"}是
                            {else \} 否
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td>每人最多投票数</td>
                        <td>{$vote.vote_number}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </dd>
            </dl>
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                投票结果
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                <div class="am-form-group">
                    <ul class="am-list am-list-static">
                        {volist name='optionList' id='option'}
                        <li>
                            <div class="am-g">
                                <div class="am-u-lg-1">&nbsp;</div>
                            <div class="am-u-lg-9">
                            <div class="am-input-group">
                             {if condition="($option.content == 'null0_')"}
                                <span>
                                <img src="{$Think.config.WEB_ROOT}/public/uploads/{$option.img}" class="am-img-responsive" alt=""/>
                            {elseif condition="($option.img == 'null')" \}
                                <span>&nbsp;</span>
                            <span>
                                <blockquote>
                            <p>{$option.content}</p>
                            </blockquote>
                            {else /}
                                <span>&nbsp;</span>
                            <span>
                                <blockquote>
                            <p>{$option.content}</p>
                            </blockquote>
                                <img src="{$Think.config.WEB_ROOT}/public/uploads/{$option.img}" class="am-img-responsive" alt=""/>
                            {/if}


                            </span>
                            </div>
                            </div>
                                 <div class="am-u-lg-2">&nbsp;</div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-lg-1">&nbsp;</div>
                                <div class="am-u-lg-10">
                                    <div class="am-progress">
                                <div class="am-progress-bar am-progress-bar-success" style="width: {$option.percent}%">{$option.percent}%</div>
                                </div>
                                    {if condition="($vote['anonymity'] == 0)"}
                            <div class="am-panel am-panel-default am-panel-success">
                            <div class="am-panel-hd">投票人</div>
                            <div class="am-panel-bd">
                                {foreach $optionLog[$option['id']] as $vo}
                                {$vo}&nbsp;|&nbsp;
                                {/foreach}
                            </div>
                            </div>
                            {/if}
                                </div>
                                <div class="am-u-lg-1">&nbsp;</div>
                            </div>
                        </li>
                        {/volist}
                    </ul>
                </div>
            </div>
            </dd>
            </dl>
        </section>
    </div>
    <div class="am-u-sm-2">&nbsp;</div>
</div>
</span>

<!--移动端-->
<span class="am-show-md-down">
<div class="am-g">

        <div class="am-container">&nbsp;</div>
        <section data-am-widget="accordion" class="am-accordion am-accordion-default">
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                标题
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                {$vote.title}
            </div>
            </dd>
            </dl>
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                介绍
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                {$vote.introduction}
            </div>
            </dd>
            </dl>
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                说明
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                <table class="am-table am-table-bordered">
                    <tbody>
                    <tr>
                        <td>发起人</td>
                        <td>{$vote.create_name}</td>
                    </tr>
                    <tr>
                        <td>开始时间</td>
                        <td>{$vote.create_time}</td>
                    </tr>
                    <tr  class="am-danger">
                        <td>截止日期</td>
                        <td>{$vote.end_time}</td>
                    </tr>
                    <tr>
                        <td>是否匿名</td>
                        <td>
                            {if condition="($vote.anonymity == 1)"}是
                            {else \} 否
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td>每人最多投票数</td>
                        <td>{$vote.vote_number}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </dd>
            </dl>
            <dl class="am-accordion-item am-active am-disabled">
                <dt class="am-accordion-title">
                投票结果
                </dt>
            <dd class="am-accordion-bd am-collapse am-in">
                 <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
            <div class="am-accordion-content">
                <div class="am-form-group">
                    <ul class="am-list am-list-static">
                        {volist name='optionList' id='option'}
                        <li>
                            <div class="am-g">
                                <div class="am-u-lg-1">&nbsp;</div>
                            <div class="am-u-lg-9">
                            <div class="am-input-group">
                            <span class="am-input-group-label">
                            <input class="option" type="checkbox" value="{$option.id}">
                            </span>

                             {if condition="($option.content == 'null0_')"}
                                <span>
                                <img src="{$Think.config.WEB_ROOT}/public/uploads/{$option.img}" class="am-img-responsive" alt=""/>
                            {elseif condition="($option.img == 'null')" \}
                                <span>&nbsp;</span>
                            <span>
                                <blockquote>
                            <p>{$option.content}</p>
                            </blockquote>
                            {else /}
                                <span>&nbsp;</span>
                            <span>
                                <blockquote>
                            <p>{$option.content}</p>
                            </blockquote>
                                <img src="{$Think.config.WEB_ROOT}/public/uploads/{$option.img}" class="am-img-responsive" alt=""/>
                            {/if}


                            </span>
                            </div>
                            </div>
                                 <div class="am-u-lg-2">&nbsp;</div>
                            </div>
                            <div class="am-g">
                                <div class="am-u-lg-1">&nbsp;</div>
                                <div class="am-u-lg-10">
                                    <div class="am-progress">
                                <div class="am-progress-bar am-progress-bar-success" style="width: {$option.percent}%">{$option.percent}%</div>
                                </div>
                                    {if condition="($vote['anonymity'] == 0)"}
                            <div class="am-panel am-panel-default am-panel-success">
                            <div class="am-panel-hd">投票人</div>
                            <div class="am-panel-bd">
                                {foreach $optionLog[$option['id']] as $vo}
                                {$vo}&nbsp;|&nbsp;
                                {/foreach}
                            </div>
                            </div>
                            {/if}
                                </div>
                                <div class="am-u-lg-1">&nbsp;</div>
                            </div>
                        </li>
                        {/volist}
                    </ul>
                </div>
            </div>
            </dd>
            </dl>
        </section>
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
<script src="{$Think.config.WEB_ROOT}/public/static/js/header.js"></script>
</body>
</html>
