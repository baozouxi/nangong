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
                    <div class="time">上次登录时间：{{ $lastLogin->login_time }}</div>
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
                    <div class="num">{{ number_format($lastLogin->money, 2) }} 元</div>
                    <a href="{{ route('account.recharge') }}" class="cz">充值</a><a
                            href="{{ route('account.withdraw') }}" class="tx">提现</a></div>
                <div class="geren_infolist">
                    <li class="clearfix">
                        <div class="title">玩家人数</div>
                        <i class="dlzhicon"></i>
                        <div class="text">0 人</div>
                    </li>
                    <li class="clearfix">
                        <div class="title">推广链接</div>
                        <i class="tgljicon"></i>
                        <div class="text" id="tgurl">http://www.ng177.com/sreg?suid=9016</div>
                        <a href="javascript:;" class="fzlj"><span id="d_clip_button"
                                                                  data-clipboard-target="tgurl">复制链接</span></a></li>
                    <li class="clearfix">
                        <div class="title">充值人数</div>
                        <i class="wdxxicon"></i>
                        <div class="text">0 人</div>
                    </li>
                    <li style="border:none;height:38px;" class="clearfix">
                        <div class="title">累计收入</div>
                        <i class="ljsricon"></i>
                        <div class="text">¥0.00 元</div>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="main">
        <div class="w1000">
            <div class="dlzx_tab" style="border:none;">
                <div class="notice">
                    <div class="tab-hd" id="tab-hd">
                        <ul>
                            <li onclick="get_myagent_list(1,d,page,'')">PC蛋蛋</li>
                            <li onclick="get_myagent_list(2,d,page,'')">网站玩家</li>
                            <!--li  onclick="get_myagent_list(3,d,page,'')">QQ玩家</li-->
                            <!--li  onclick="get_myagent_list(4,d,page,'')">代理账务</li-->
                            <!--li  onclick="get_myagent_list(5,d,page,'')">彩票代理</li-->
                        </ul>
                    </div>
                    <div class="tab-bd" id="tab-bd"></div>
                    <div class="clear"></div>
                </div>
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

        function get_myagent_list(t, d, page, keyword) {
            var url, data;
            tsort = t;
            url = "/user/profile/get_myagent_list/t/" + t + "/d/" + d + "/page/" + page;
            if (keyword != '') {
                url += "/kw/" + encodeURIComponent(keyword);
            }
            $("#tab-hd li").removeClass("on");
            var i = t > 2 ? t - 2 : t - 1;
            $("#tab-hd li").eq(i).addClass("on");
            $.ajax({
                type: "post",
                cache: false,
                url: url,
                datatype: "json",
                error: function (data) {
                    $.message({type: "error", content: '网络超时，请刷新页面后重试', time: 3000});
                },
                beforeSend: function () {
                    $("#yx_list").html("<li class='loading'><span>正在加载数据, 请稍等......</span></li>");
                },
                success: function (data) {
                    var count = Math.ceil(data.count / data.pageSize);
                    $("#tab-bd").html(data.list);
                    $(".pagination").pager({
                        pagenumber: data.page,
                        pagecout: count,
                        buttonClickCallback: function (page) {
                            get_myagent_list(t, d, page, keyword);
                        }
                    });

                }
            });

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
            get_myagent_list(tsort, d, page, '');
        });
    </script>
    <br/>
    <br/>


@endsection

@push('scrpits')

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
                "value": "591811597",
                "url": "",
                "img": "",
                "status": "1",
                "remark": "",
                "sort": "0"
            }]
        };
        var appdownload = null
    </script>
@endpush