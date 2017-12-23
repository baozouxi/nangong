<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>中资盛世</title>
    <script>
        var webroot = "/";
    </script>
    <meta name="keywords" content=""/>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/animate.min.css"/>
    <link href="/themes/simplebootx/Public/css/css.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/page.css" type="text/css"/>
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
        <div class="gg">{{ $ad->body }}</div>
        @if(!Auth::check())
            <div class="user" id="userpanel"><span>欢迎您，新用户！请先 </span><a href="{{ route('login') }}">登录</a><a
                        href="{{ route('register') }}">注册</a></div>
        @else
            <div class="user" id="userpanel">
                <span>欢迎您，{{ Auth::user()->username }}</span><span>账户余额：<i>￥{{ number_format(Auth::user()->capital->money, 2) }}</i></span><a
                        href="{{ route('account.recharge') }}">充值</a><a href="{{ route('account.withdraw') }}">提现</a><a
                        href="#" class="logout">退出</a></div>
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
                {{--<dd><a href="javascript:;" onclick="cakenogame();">加拿大28</a></dd>--}}
            </div>
        </li>
        <li><a href="javascript:;"><i class="navicon2"></i><span class="cn" style="color:#999">彩票游戏</span><span
                        class="en" style="color:#999">lottery</span></a></li>
        <li><a href="javascript:;"><i class="navicon2"></i><span class="cn" style="color:#999">香港六合彩</span><span
                        class="en" style="color:#999">games</span></a></li>
        <li><a href="{{ route('account.user') }}"><i class="navicon5"></i><span class="cn">账户管理</span><span class="en">account</span></a>
            <div class="ssnav">
                <div class="h14"></div>
                <a href="{{ route('account.user') }}">个人中心</a> <a href="{{ route('account.capital_log') }}">财务记录</a> <a
                        href="{{ route('account.agency') }}">代理中心</a> <a href="{{ route('account.safe') }}">安全中心</a>
            </div>
        </li>
        <li><a href="#"><i class="navicon6"></i><span class="cn">团队代理</span><span
                        class="en">team</span></a></li>
        <li><a href="#"><i class="navicon7"></i><span class="cn">系统公告</span><span class="en">discount</span></a>
            <div class="ssnav">
                <div class="h14"></div>
                <a href="{{ route('articles.index') }}">最新公告</a></div>
        </li>
    </div>
</div>

@yield('main')

<script src="/plug/pc28game/online.js"></script>


<div class="footer">
    <div class="w1000">
        <div class="hzhb"><img src="/themes/simplebootx/Public/images/hzhb.png" alt=""></div>
        <div class="copyright"> Copyright (c) 中资盛世. 版权由中资盛世所有。
            <span>注：未满18岁严禁注册娱乐</span></div>
    </div>
</div>

<script>var kflist = {
        "3": [

                @foreach($kefus as $kefu)
                @if($kefu->type == '1')
            {
                "id": "6",
                "title": "中资盛世",
                "name": "\u5ba2\u670d{{ $loop->index + 1 }}",
                "cid": "1",
                "ac": "3",
                "value": "{{ $kefu->way }}",
                "url": "http:\/\/wpa.qq.com\/msgrd?v=3&amp;uin={{ $kefu->way }}&amp;site=qq&amp;menu=yes",
                "img": "",
                "status": "1",
                "remark": "",
                "sort": "0"
            },
            @endif
            @endforeach

        ],
        "4": [
                @foreach($kefus as $kefu)
                @if($kefu->type == '2')
            {
                "id": "7",
                "title": "中资盛世Q群",
                "name": "\u4ea4\u6d41\u7fa4\u2460",
                "cid": "1",
                "ac": "4",
                "value": "{{ $kefu->way }}",
                "url": "",
                "img": "",
                "status": "1",
                "remark": "",
                "sort": "0"
            }
            @endif
            @endforeach

        ]
    };
    var appdownload = null
</script>
<script src="/plug/service/online.js?v0.1"></script>
<script>
    $(function () {
        $('body').on('click', '.logout', function (event) {
            event.preventDefault();
            $.post('{{ route('logout') }}', null, function () {
                window.location = '/';
            });
        });
    });
</script>


@stack('scripts')


</body>

</html>