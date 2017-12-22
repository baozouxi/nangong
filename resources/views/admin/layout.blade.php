<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>中资盛世后台</title>
    <meta name="keywords" content="index">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/app.css">

    @stack('css')
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/amazeui.min.js"></script>
    @stack('init-scripts')

</head>

<body data-type="generalComponents">


<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <a href="javascript:;" class="tpl-logo">
            <img src="/assets/img/logo.png" alt="">
        </a>
    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
                class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">


            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span
                            class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>

            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick">管理员</span><span class="tpl-header-list-user-ico"> <img
                                src="/assets/img/user01.png"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                    <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                    <li><a href="{{ route('admin.logout') }}"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin.logout')  }}" class="tpl-header-list-link"><span
                            class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
        </ul>
    </div>
</header>


<div class="tpl-page-container tpl-page-header-fixed">


    <div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-title">
            中资盛世
        </div>
        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <li class="tpl-left-nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>首页</span>
                    </a>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-bar-chart"></i>
                        <span>用户列表</span>
                    </a>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="{{ route('admin.capital-logs') }}" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-key"></i>
                        <span>财务记录</span>
                    </a>
                </li>

                <li class="tpl-left-nav-item">
                    <a href="{{ route('admin.withDraws') }}" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-key"></i>
                        <span>提现请求</span>
                    </a>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="{{ route('admin.articles') }}" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-key"></i>
                        <span>网站公告</span>
                    </a>
                </li>

                <li class="tpl-left-nav-item">
                    <a href="{{ route('admin.ad') }}" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-key"></i>
                        <span>红包广告</span>
                    </a>
                </li>

                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-wpforms"></i>
                        <span>投注记录</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                    </a>



                    <ul class="tpl-left-nav-sub-menu" style="display: block;">


                        <li>
                            @foreach($games as $game)

                            <a href="{{ route('admin.bets', ['game'=>$game->id]) }}">
                                <i class="am-icon-angle-right"></i>
                                <span>{{ $game->name }}</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                            @endforeach

                        </li>
                    </ul>
                </li>
                {{--

                                <li class="tpl-left-nav-item">
                                    <!-- 打开状态 a 标签添加 active 即可   -->
                                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                                        <i class="am-icon-table"></i>
                                        <span>表格</span>
                                        <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                                    </a>
                                    <ul class="tpl-left-nav-sub-menu" style="display:block">
                                        <li>
                                            <!-- 打开状态 a 标签添加 active 即可   -->
                                            <a href="table-font-list.html" class="active">
                                                <i class="am-icon-angle-right"></i>
                                                <span>文字表格</span>
                                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                            </a>

                                            <a href="table-images-list.html">
                                                <i class="am-icon-angle-right"></i>
                                                <span>图片表格</span>
                                                <i class="tpl-left-nav-content tpl-badge-success">
                                                    18
                                                </i>

                                                <a href="form-news.html">
                                                    <i class="am-icon-angle-right"></i>
                                                    <span>消息列表</span>
                                                    <i class="tpl-left-nav-content tpl-badge-primary">
                                                        5
                                                    </i>


                                                    <a href="form-news-list.html">
                                                        <i class="am-icon-angle-right"></i>
                                                        <span>文字列表</span>

                                                    </a>
                                        </li>
                                    </ul>
                                </li>
                --}}

                {{--                <li class="tpl-left-nav-item">
                                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                                        <i class="am-icon-wpforms"></i>
                                        <span>表单</span>
                                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                                    </a>
                                    <ul class="tpl-left-nav-sub-menu">
                                        <li>
                                            <a href="form-amazeui.html">
                                                <i class="am-icon-angle-right"></i>
                                                <span>Amaze UI 表单</span>
                                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                            </a>

                                            <a href="form-line.html">
                                                <i class="am-icon-angle-right"></i>
                                                <span>线条表单</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>--}}

            </ul>
        </div>
    </div>


    <div class="tpl-content-wrapper">
        @yield('main')

    </div>

</div>

<script src="/assets/js/app.js"></script>
@stack('scripts')
</body>

</html>