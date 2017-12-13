<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title> NG南宫国际娱乐</title>
    <script>
        var webroot = "/";
    </script>
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <meta name="keywords" content=""/>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/animate.min.css"/>
    <link href="/themes/simplebootx/Public/css/css.css" rel="stylesheet" type="text/css"/>

    @stack('css')

    <script src="/themes/simplebootx/Public/js/min/jquery-v1.10.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery.SuperSlide.2.1.1.js"></script>
    <!--[if (gte IE 6)&(lte IE 10)]>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/html5.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/selectivizr.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/PIE.js"></script> 
    <![endif]-->
    <script src="/public/js/base.js" type="text/javascript"></script>
    <script src="/themes/simplebootx/Public/js/base.js"></script>
    <script src="/themes/simplebootx/Public/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>
    <link href="/themes/simplebootx/Public/css/flickerplate.css" type="text/css" rel="stylesheet">
    <script src="/themes/simplebootx/Public/js/min/flickerplate.min.js" type="text/javascript"></script>

    @stack('init-scripts')
</head>

<body>
<div class="header">
    <div class="w1000">
        <div class="logo"><a href="index.html"><img src="/themes/simplebootx/Public/images/logo.png" alt=""></a></div>
        <div class="gg">刘晓明在872355期红包接龙中夺得运气王!</div>
        @if(!Auth::check())
            <div class="user" id="userpanel"><span>欢迎您，新用户！请先 </span><a href="{{ route('login') }}">登录</a><a
                        href="http://ng077.com/user/register/index.html">注册</a></div>
        @else
            <div class="user" id="userpanel"><span>欢迎您，baozouxi</span><span>账户余额：<i>￥{{ number_format(Auth::user()->capital->money, 2) }}</i></span><a href="/user/profile/pay.html">充值</a><a href="/user/profile/themoney.html">提现</a><a href="/user/message/index?v1">消息中心 <i>5</i></a><a href="#"  class="logout">退出</a></div>
        @endif
    </div>
</div>
<div class="nav">
    <div class="w1000">
        <li><a href="/"><i class="navicon1"></i><span class="cn">首页</span><span class="en">home</span></a></li>
        <li><a href="javascript:;"><i class="navicon3"></i><span class="cn">幸运28</span><span
                        class="en">28 game</span></a>
            <div class="ssnav">
                <div class="h14"></div>
                <dd><a href="javascript:;" onclick="hbgame();">北京快乐8</a></dd>
                <dd><a href="javascript:;" onclick="cakenogame();">加拿大28</a></dd>
            </div>
        </li>
        <li><a href="javascript:;"><i class="navicon2"></i><span class="cn" style="color:#999">彩票游戏</span><span
                        class="en" style="color:#999">lottery</span></a></li>
        <li><a href="javascript:;"><i class="navicon2"></i><span class="cn" style="color:#999">红包游戏</span><span
                        class="en" style="color:#999">games</span></a></li>
        <li><a href="{{ route('account.user') }}"><i class="navicon5"></i><span class="cn">账户管理</span><span class="en">account</span></a>
            <div class="ssnav">
                <div class="h14"></div>
                <a href="{{ route('account.user') }}">个人中心</a> <a href="{{ route('account.capital_log') }}">财务记录</a> <a
                        href="{{ route('account.agency') }}">代理中心</a> <a href="{{ route('account.safe') }}">安全中心</a>
            </div>
        </li>
        <li><a href="/user/ltagent/index.html"><i class="navicon6"></i><span class="cn">团队代理</span><span
                        class="en">team</span></a></li>
        <li><a href="/portal/index/notice.html"><i class="navicon7"></i><span class="cn">系统公告</span><span class="en">discount</span></a>
            <div class="ssnav">
                <div class="h14"></div>
                <a href="/portal/index/notice/cid/31.html">最新公告</a> <a href="/portal/index/notice/cid/32.html">会员必读</a>
                <a href="/portal/index/notice/cid/33.html">活动公告</a></div>
        </li>
    </div>
</div>

@yield('main')

<script src="/plug/pc28game/online.js"></script>


<div class="footer">
    <div class="w1000">
        <div class="hzhb"><img src="/themes/simplebootx/Public/images/hzhb.png" alt=""></div>
        <div class="copyright"> Copyright (c) 2017 NG娱乐（No good）. 版权由NG娱乐所有。
            <span>注：未满18岁严禁注册娱乐</span></div>
    </div>
</div>


<script>
    $(function () {
        $('.logout').click(function () {
            $.post('{{ route('logout') }}', null, function () {
                window.location = '/';
            });
        });
    });

</script>


@stack('scripts')


</body>

</html>