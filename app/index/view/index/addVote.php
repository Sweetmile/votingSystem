<?php
/**
 * 添加投票
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/11
 * Time: 15:56
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
    <title>发起投票-投票系统</title>

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
<!--交互信息提示-->


<div class="am-container">
    &nbsp;
</div>

<div class="am-g">
    <div class="am-u-lg-3">
        <span class="am-show-md-down">&nbsp;</span>
        <span class="am-show-lg-only">&nbsp;</span>
    </div>
    <div class="am-u-lg-6">
        <!--  移动端适配      -->
        <span class="am-show-md-down">
            <form class="am-form">
  <fieldset>

    <legend>
        <h2 class="am-titlebar-title" style="color: #0e90d2">
        发起投票
        </h2>
    </legend>
      <div class="am-form-group">
      <label for="doc-ipt-email-1">投票标题</label>
        <input type="text"  class="voteTitle"  placeholder="请输入标题">
    </div>
    <div class="am-form-group">
      <label for="doc-ta-1">投票介绍</label>
      <textarea class="voteIntro" rows="5" id="doc-ta-1"></textarea>
    </div>
      <div class="am-form-group">
      <label for="doc-select-1">最低等级限制</label>
      <select class="voteGrade" id="doc-select-1">
          <option value="">请选择</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
      <label for="doc-ipt-email-1">每人最大投票数</label>
        <input type="text"  class="voteNumber"  placeholder="请输入每人最大投票数">
    </div>
      <div class="am-form-group">
           <label>截至日期</label>
    <i class="am-icon-calendar"></i>
    <input type="datetime-local" class="voteEndTime" placeholder="请输入截至日期">
  </div>

      <div class="am-form-group">
      <label for="doc-select-1">是否匿名</label>
      <select  class="voteAno" id="doc-select-1">
          <option value="">请选择</option>
        <option value="1">是</option>
        <option value="0">否</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
          <label for="doc-ta-1">选项</label><span>（图片或者描述必有一项）</span><br>
          <div class="option"></div>
          <div><a class="am-icon-btn am-icon-plus"></a><a class="am-icon-btn am-icon-minus"></a></div>
      </div>
      <div class="am-form-group">
      <label for="doc-ipt-pwd-1">验证码</label>
          <div class="am-g">
        <div class="am-u-sm-7"><input type="text" class="voteCaptcha"  placeholder="请输入右侧四位验证码"></div>
        <div class="am-u-sm-5"><img class="captchaImg" src="{:captcha_src()}" alt="captcha" />点击刷新</div>
        </div>
    </div>
      <button type="button" class="am-btn am-btn-primary am-btn-block">发起投票</button>
  </fieldset>
    </form>
        </span>
        <!--  PC端适配      -->
        <span class="am-show-lg-only">
            <form class="am-form">
  <fieldset>

    <legend>
        <h2 class="am-titlebar-title" style="color: #0e90d2">
        发起投票
        </h2>
    </legend>
      <div class="am-form-group">
      <label for="doc-ipt-email-1">投票标题</label>
        <input type="text"  class="voteTitle"  placeholder="请输入标题">
    </div>
    <div class="am-form-group">
      <label for="doc-ta-1">投票介绍</label>
      <textarea class="voteIntro" rows="5" id="doc-ta-1"></textarea>
    </div>
      <div class="am-form-group">
      <label for="doc-select-1">最低等级限制</label>
      <select class="voteGrade" id="doc-select-1">
          <option value="">请选择</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
      <label for="doc-ipt-email-1">每人最大投票数</label>
        <input type="text"  class="voteNumber"  placeholder="请输入每人最大投票数">
    </div>
       <div class="am-form-group">
           <label>截至日期</label>
    <i class="am-icon-calendar"></i>
    <input type="datetime-local" class="voteEndTime" placeholder="请输入截至日期">
  </div>

      <div class="am-form-group">
      <label for="doc-select-1">是否匿名</label>
      <select  class="voteAno" id="doc-select-1">
          <option value="">请选择</option>
        <option value="1">是</option>
        <option value="0">否</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
          <label for="doc-ta-1">选项</label><span>（图片或者描述必有一项）</span><br>
          <div class="option"></div>
          <a class="am-icon-btn am-icon-plus"></a><a class="am-icon-btn am-icon-minus"></a>
      </div>
      <div class="am-form-group">
      <label for="doc-ipt-pwd-1">验证码</label>
          <div class="am-g">
        <div class="am-u-sm-7"><input type="text" class="voteCaptcha"  placeholder="请输入右侧四位验证码"></div>
        <div class="am-u-sm-5"><img class="captchaImg" src="{:captcha_src()}" alt="captcha" />点击刷新</div>
        </div>
    </div>
      <button type="button" class="am-btn am-btn-primary am-btn-block">发起投票</button>
  </fieldset>
    </form>
        </span>
    </div>
    <div class="am-u-lg-3">
        <span class="am-show-md-down">&nbsp;</span>
        <span class="am-show-lg-only">&nbsp;</span>
    </div>
</div>
<div id="response">
</div>
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
<script src="{$Think.config.WEB_ROOT}/public/static/js/addVote.js"></script>
<script src="{$Think.config.WEB_ROOT}/public/static/js/header.js"></script>
<script>
    var captchaUrl = "{:captcha_src()}";
    var rootUrl = "{$Think.config.WEB_ROOT}";
    var name = "{$user.name}";
    var admin = "{$user.admin}";
    var grade = "{$user.grade}";
</script>
</body>
</html>
