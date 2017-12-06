<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>会员登陆-NG南宫国际娱乐-最用心的娱乐平台！</title>
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}" />
    <link href="{{ asset('css/css.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.superslide.2.1.1.js') }}"></script>
    <!--[if (gte IE 6)&(lte IE 10)]> <script type="text/javascript" src="{{ asset('js/jquery1.42.min.js"></script> <script type="text/javascript" src="js/html5.js"></script> <script type="text/javascript" src="js/selectivizr.js"></script> <script type="text/javascript" src="js/pie.js') }}"></script> <![endif]-->
<!--<script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>-->
    <script src="{{ asset('js/base.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/base.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <link href="{{ asset('css/codedrag.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/codedrag.js') }}" type="text/javascript"></script>
    <style>
        .login input.input_dlbtn:disabled {
            background: #AE92D7;
        }
        /*IE8-*/

        .login input.input_dlbtn[disabled] {
            background: #AE92D7;
        }
        /*IE6 Using Javascript to add CSS class "disabled"*/

        * html .login input.input_dlbtn.disabled {
            background: #AE92D7;
        }

        i.iconloginyzm,
        #codedrag {
            float: left;
        }

        li.takecode {
            border: none;
        }
    </style>
</head>

<body class="loginbg">
<div class="main" style="height:680px;">
    <div class="w1000 clearfix">
        <div class="logo"><a href="/"><img src="picture/logo_login.png" alt=""></a></div>
        <div class="login">
            <form times="0">
                <li><i class="iconloginuser"></i>
                    <input type="text" name="username" style="display:none;">
                    <input type="text" id="username" name="username" class="login_text" placeholder="请输入用户名/手机号码" autocomplete="off">
                </li>
                <li><i class="iconloginpw"></i>
                    <input type="password" name="password" style="display:none;">
                    <input type="password" name="password" id="password" class="login_text" placeholder="请输入密码" autocomplete="off">
                </li>
                <li class="rows clearfix inputcode" style="display:none"> <i class="iconloginyzm"></i>
                    <div style="float:left;">
                        <input type="text" id="checkcode" style="width:120px;" required name="code" maxlength="4" placeholder="请填写验证码" />
                    </div>
                    <div style="float:left;"><img id=codeimg src='picture/a8377d6a5b59416b93d704e9cfd2e8a3.gif' onclick='this.src=this.src+"?"+Math.random()' title='看不清？点击换一张图片' /></div>
                </li>
                <li class="rows clearfix takecode">
                    <div id="codedrag" style="width:315px;margin:18px 0 0 0;"></div>
                </li>
                <li class="clearfix alj"><a href="/user/register/index.html" class="zczh">注册账号</a><a href="javascript:;" class="wjmm">忘记密码</a></li>
                <li style="border:none;">
                    <input type="button" id="signinButton" onclick="checklogin()" disabled="disabled" class="input_dlbtn" value="登 录">
                </li>
            </form>
        </div>
    </div>
</div>
<div class="lyoushi">
    <div class="w1000">
        <li><i class="iconlyoushi1"></i><span>存款到账</span>
            <p>存款平均10秒极速到账</p>
        </li>
        <li class="line"></li>
        <li><i class="iconlyoushi2"></i><span>余额提现</span>
            <p>提现平均两小时内到账</p>
        </li>
        <li class="line"></li>
        <li><i class="iconlyoushi3"></i><span>便捷的充值服务</span>
            <p> 银行卡，网银，支付宝，微信</p>
        </li>
    </div>
</div>
<script>
    //验证
    var dragCfg = {
        token: false,
        url: "/user/login/calltoken.html",
        callback: function() { $('#signinButton').attr('disabled', false); }
    };
    $('#codedrag').drag(dragCfg);
    $('#username,#password').focus(function() { if ($('#checkcode').val() != '' || $('.takecode:visible #checktoken').length > 0) $('#signinButton').attr('disabled', false); });
    $('#checkcode').keyup(function() {
        var value = $(this).val();
        var chnum = /^[0-9]{1,6}$/;
        if (!chnum.test(value)) $(this).val(value.replace(/[_-w.*]/g, ''));
        if (value.length >= 4) $('#signinButton').attr('disabled', false);
        else $('#signinButton').attr('disabled', true);
    })
</script>
<script src="{{ asset('js/online.js') }}"></script>
<div class="footer">
    <div class="w1000">
        <div class="hzhb"><img src="picture/hzhb.png" alt=""></div>
        <div class="copyright"> Copyright (c) 2017 NG娱乐（No good）. 版权由NG娱乐所有。
            <span>注：未满18岁严禁注册娱乐</span> </div>
    </div>
</div>
<script>
    var kflist = { "3": [{ "id": "6", "title": "\u5357\u5bab\u5ba2\u670d", "name": "\u5ba2\u670d\u2460", "cid": "1", "ac": "3", "value": "9001723", "url": "http:\/\/wpa.qq.com\/msgrd?v=3&amp;uin=7770992&amp;site=qq&amp;menu=yes", "img": "", "status": "1", "remark": "", "sort": "0" }], "4": [{ "id": "7", "title": "\u5357\u5bab\u4ea4\u6d41Q\u7fa4", "name": "\u4ea4\u6d41\u7fa4\u2460", "cid": "1", "ac": "4", "value": "111590831", "url": "", "img": "", "status": "1", "remark": "", "sort": "0" }] };
    var appdownload = null
</script>
<script src="{{ asset('js/online.js') }}"></script>
</body>

</html>