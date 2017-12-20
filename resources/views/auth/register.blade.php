<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="Keywords" content=""/>
    <meta name="Description" content=""/>
    <title>注册账户-中资盛世-最用心的娱 乐平台！</title>
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <script>
        var webroot = "/";
    </script>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/animate.min.css"/>
    <link href="/themes/simplebootx/Public/css/css.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/css/register.css?v2" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery.SuperSlide.2.1.1.js"></script>
    <!--[if (gte IE 6)&(lte IE 10)]>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/html5.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/selectivizr.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/PIE.js"></script> <![endif]-->
    <!--<script src="/lib/js/jquery.js" type="text/javascript"></script>-->
    <script src="/public/js/base.js" type="text/javascript"></script>
    <script src="/themes/simplebootx/Public/js/base.js"></script>
    <script src="/themes/simplebootx/Public/js/reg.js?v3"></script>
</head>

<body>
<form id="regdata">
    <div class="zc_main">
        <div class="w1000">
            <div class="imgbox" style="height: auto;"><a href="http://ng077.com/"><img
                            src="/themes/simplebootx/Public/images/titimg_logo.png" alt="南宫国际娱乐"></a></div>
            <div class="registerform" style="height: 610px;">
                <div class="titbox">
                    <div class="title">欢迎来到中资盛世</div>
                    <a href="{{ route('login') }}" class="dl">登录</a></div>
                <div class="biaodan" style="height: 430px;">
                    <input type="hidden" placeholder="推荐人UID" class="yzmin" value="" id="mmzh-puid" name="puid">
                    <input type="hidden" id="ltagent" value=""/>
                    <ul>
                        <li>
                            <input type="text" placeholder="请输入用户名" class="c_username" id="mmzh-user" name="username">
                            <div class="tips" id="reg_username">用户名由5-10位字母或数字组成,字母开头</div>
                        </li>
                        <li>
                            <input type="text" placeholder="请输入手机号码" class="c_mobile" id="mobile" name="mobile"></li>
                      {{--  <li>
                            <input class="yzmin" placeholder="填写验证码" class="c_mobilecode" type="text" name="mobilecode">
                            <button type="button" class="yzmbt" id="zphone">发送验证码</button>
                            <div class="tips">请输入手机收到的验证码</div>
                        </li>--}}
                        <li>
                            <input type="password" placeholder="请输入密码" class="c_password" value="" id="mmzh-pass"
                                   name="password">
                            <input type="password" placeholder="确认密码" class="c_repass" style="margin-top:8px;" value=""
                                   id="mmzh-repass" name="repass">
                            <div class="tips">密码由6至16个字母或者数字组成，可加入标点符号提高安全性</div>
                        </li>
                    </ul>
                </div>
                <input type="button" class="querenzc" onclick="checkreg()" value="确认注册"></div>
        </div>
    </div>
</form>
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
        token: true,
        url: "/user/login/calltoken.html",
        callback: function () {
            setTimeout(function () {
                get_mobile_code($('#checktoken').val());
                $('.activity_codedrag').hide('slow');
            }, 1000);
        }
    };
    $("#zphone").click(function () {
        var mobile = $('#mobile').val();

        if (mobile.length != 11) {
            $.message({
                content: '请输入正确的手机号码',
                type: "error"
            });
            $("#mobile").focus();
            return false;
        }

        if ($('#captcha_div').length > 0) {
            $('#captcha_div,#captcha_bg').remove();
        }
        $.get('/user/index/codedrag.html', function (html) {
            $('body').append(html);
            $('#captcha_bg').fadeTo(400, 0.5, function () {
                $('#captcha_div').show();
            });
            $('#codedrag').drag(dragCfg);
        });
    });
</script>
<script src="/plug/pc28game/online.js"></script>
<div class="footer">
    <div class="w1000">
        <div class="hzhb"><img src="/themes/simplebootx/Public/images/hzhb.png" alt=""></div>
        <div class="copyright"> Copyright (c) 2017 中资盛世（No good）. 版权由中资盛世所有。
            <span>注：未满18岁严禁注册娱乐</span></div>
    </div>
</div>
<script>
    var kflist = {
        "3": [{
            "id": "6",
            "title": "\u5357\u5bab\u5ba2\u670d",
            "name": "\u5ba2\u670d\u2460",
            "cid": "1",
            "ac": "3",
            "value": "9001723",
            "url": "http:\/\/wpa.qq.com\/msgrd?v=3&amp;uin=9001723&amp;site=qq&amp;menu=yes",
            "img": "",
            "status": "1",
            "remark": "",
            "sort": "0"
        }],
        "4": [{
            "id": "7",
            "title": "\u5357\u5bab\u4ea4\u6d41Q\u7fa4",
            "name": "\u4ea4\u6d41\u7fa4\u2460",
            "cid": "1",
            "ac": "4",
            "value": "111590831",
            "url": "",
            "img": "",
            "status": "1",
            "remark": "",
            "sort": "0"
        }]
    };
    var appdownload = null
</script>

</body>

</html>