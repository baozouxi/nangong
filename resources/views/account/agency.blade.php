@extends('layouts.app')

@push('css')
    <link href="/themes/simplebootx/Public/css/center.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/page.css" type="text/css"/>
@endpush



@push('init-scrpit')
    <script src="/public/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/page.js"></script>
    <script>
        var webroot = "/",
            tsort = "1",
            d = "1",
            page = 1;
    </script>
@endpush


@section('main')

    <div class="banner_hyzx">
        <div class="w1000">
            <div class="uesr">
                <div class="imgbox"><a href="myagent.html"><img src="/themes/simplebootx/Public/images/user.png" alt=""></a>
                </div>
                <div class="name_box">
                    <div class="name"><span>{{ Auth::user()->username }}</span>
                        <div class="uid">uid：{{ Auth::user()->id }}</div>
                    </div>
                    <div class="time">上次登录时间：{{ $lastLogin? $lastLogin->login_time: '' }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_nav">
        <div class="w1000">
            @include('account.nav')
        </div>
    </div>
    <div class="main">
        <div class="w1000">
            <div class="hyzx_zhye">
                <div class="zhye_box">
                    <div class="title"><i class="zhyeicon"></i>账户余额</div>
                    <div class="num">{{ number_format(\Illuminate\Support\Facades\Auth::user()->capital->money, 2) }} 元</div>
                    <a href="{{ route('account.recharge') }}" class="cz">充值</a><a
                            href="{{ route('account.withdraw') }}" class="tx">提现</a></div>
                <div class="geren_infolist">
                    <li class="clearfix">
                        <div class="title">玩家人数</div>
                        <i class="dlzhicon"></i>
                        <div class="text">{{ $user_count }} 人</div>
                    </li>
                    <li class="clearfix">
                        <div class="title">推广链接</div>
                        <i class="tgljicon"></i>
                        <div class="text" id="tgurl">{{ $url }}</div>
                        {{--<a href="javascript:;" class="fzlj"><span id="d_clip_button"--}}
                                                                  {{--data-clipboard-target="tgurl">复制链接</span></a>--}}
                    </li>
                    <li class="clearfix">
                        <div class="title">充值人数</div>
                        <i class="wdxxicon"></i>
                        <div class="text">0 人</div>
                    </li>
                    <li style="border:none;height:38px;" class="clearfix">
                        <div class="title">累计收入</div>
                        <i class="ljsricon"></i>
                        <div class="text">¥{{ number_format($money , 2) }} 元</div>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="main">
        <div class="w1000">
            <div class="dlzx_tab" style="border:none;">

            </div>
        </div>
    </div>
    <script type="text/javascript" src="/public/js/copy/ZeroClipboard.js"></script>
    <script type="text/javascript">
        // 定义一个新的复制对象
        var clip = new ZeroClipboard(document.getElementById("d_clip_button"), {
            moviePath: "/public/js/copy/ZeroClipboard.swf"
        });

        // 复制内容到剪贴板成功后的操作
        clip.on('complete', function (client, args) {
            alert("复制成功，复制内容为：" + args.text);
            //        $.message({type:"OK",content:"复制成功，复制内容为："+ args.text,time:1200});
        });

        function searchByKeyWord() {
            var keyWord = $("#kwd").val();
            get_myagent_list(tsort, d, page, keyWord);
        }



        $(function () {
            $(".navlist li a:eq(2)").addClass("current");
            $(".tzfa ul li").toggle(
                function () {
                    $(this).next(".ck_nr").toggle();
                },
                function () {
                    $(this).next(".ck_nr").toggle();
                }
            )
            // get_myagent_list(tsort, d, page, '');
        });
    </script>
    <br/>
    <br/>


@endsection

