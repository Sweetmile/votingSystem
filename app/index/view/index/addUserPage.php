<?php
/**
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/13
 * Time: 0:24
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
    <title>添加用户</title>

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




<div class="am-container">
    &nbsp;
</div>

<div class="am-g">
    <div class="am-u-lg-3">
        &nbsp;
    </div>
    <div class="am-u-lg-6">
        <!--  移动端适配      -->
        <span class="am-show-md-down">
            <form class="am-form">
  <fieldset>

    <legend>
        <h2 class="am-titlebar-title" style="color: #0e90d2">
        Register
        </h2>
    </legend>


    <div class="am-form-group">
      <label for="doc-ipt-email-1">账号</label>
      <input type="text" class="account"  placeholder="请输入账号">
        <span>(只能输入数字，下划线，字母，且不能以下划线作为开头和结尾)</span>
    </div>

    <div class="am-form-group">
      <label for="doc-ipt-pwd-1">密码</label>
      <input type="password"  class="pwd1"  placeholder="请输入密码">
        <span>(只能输入数字，下划线，字母，且不能以下划线作为开头和结尾)</span>
    </div>
      <div class="am-form-group">
      <label for="doc-ipt-pwd-1">确认密码</label>
      <input type="password"  class="pwd2" placeholder="请再次输入密码">
    </div>
      <div class="am-form-group">
      <label for="doc-select-1">等级</label>
      <select class="grade" id="doc-select-1">
          <option value="">请选择</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
      <label for="doc-select-1">开启管理员权限</label>
      <select  class="admin" id="doc-select-1">
          <option value="">请选择</option>
        <option value="1">是</option>
        <option value="0">否</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
      <label for="doc-ipt-pwd-1">验证码</label>
          <div class="am-g">
        <div class="am-u-sm-7">
            <input type="text"  class="captcha" placeholder="请输入右侧四位验证码"></div>
        <div class="am-u-sm-5"><img class="captchaImg" src="{:captcha_src()}" alt="captcha" /></div>
        </div>
    </div>
      <button  type="button" class="am-btn am-btn-primary am-btn-block">登&nbsp;陆</button>
  </fieldset>
    </form>
        </span>
        <!--  PC端适配      -->
        <span class="am-show-lg-only">
            <form class="am-form">
  <fieldset>

    <legend>
        <h2 class="am-titlebar-title" style="color: #0e90d2">
        Register
        </h2>
    </legend>


    <div class="am-form-group">
      <label for="doc-ipt-email-1">账号</label>
      <input type="text" class="account"  placeholder="请输入登陆账号">
        <span>(只能输入数字，下划线，字母，且不能以下划线作为开头和结尾)</span>
    </div>

    <div class="am-form-group">
      <label for="doc-ipt-pwd-1">密码</label>
      <input type="password"  class="pwd1" placeholder="请输入密码">
        <span>(只能输入数字，下划线，字母，且不能以下划线作为开头和结尾)</span>
    </div>
      <div class="am-form-group">
      <label for="doc-ipt-pwd-1">确认密码</label>
      <input type="password"  class="pwd2" placeholder="请再次输入密码">
    </div>
      <div class="am-form-group">
      <label for="doc-select-1">等级</label>
      <select class="grade" id="doc-select-1">
          <option value="">请选择</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
      <label for="doc-select-1">开启管理员权限</label>
      <select  class="admin" id="doc-select-1">
          <option value="">请选择</option>
        <option value="1">是</option>
        <option value="0">否</option>
      </select>
      <span class="am-form-caret"></span>
    </div>
      <div class="am-form-group">
      <label for="doc-ipt-pwd-1">验证码</label>
          <div class="am-g">
        <div class="am-u-sm-7"><input type="text" class="captcha"  placeholder="请输入右侧四位验证码"></div>
        <div class="am-u-sm-5"><img class="captchaImg" src="{:captcha_src()}" alt="captcha" />点击图片刷新</div>
        </div>
    </div>
      <button type="button" class="am-btn am-btn-primary am-btn-block">添&nbsp;加</button>
  </fieldset>
    </form>
        </span>
    </div>
    <div class="am-u-lg-3">
        <span class="am-show-md-down">&nbsp;</span>
        <span class="am-show-lg-only">&nbsp;</span>
    </div>
</div>
<!--交互信息提示-->
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
<script src="{$Think.config.WEB_ROOT}/public/static/js/header.js"></script>
<script src="{$Think.config.WEB_ROOT}/public/static/js/addUser.js"></script>
<script>
    var captchaUrl = "{:captcha_src()}";
    var rootUrl = "{$Think.config.WEB_ROOT}";
    var name = "{$user.name}";
    var admin = "{$user.admin}";
    var grade = "{$user.grade}";
</script>
</body>
</html>
