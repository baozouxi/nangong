@extends('layouts.app')


@push('css')
    <link href="{{ asset('css/center.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('main')
    <div class="banner_hyzx">
        <div class="w1000">
            <div class="uesr">
                <div class="imgbox"><a href=""><img src="{{ asset('picture/user.png') }}" alt=""></a></div>
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
        <div class="w1000 clearfix">
            <div class="hyzx_zhye">
                <div class="zhye_box">
                    <div class="title"><i class="zhyeicon"></i>账户余额</div>
                    <div class="num">{{ is_null($capital) ? '0.00' : $capital->money }} 元</div>
                    <a href="/user/profile/pay.html" class="cz">充值</a><a href="/user/profile/themoney.html" class="tx">提现</a>
                </div>
                <div class="geren_infolist">
                    <li><i class="telicon"></i>
                        <div class="text">15977723563</div>
                        <a href="" class="xg"></a></li>
                    </li>
                    <li><i class="qqicon"></i>
                        <div class="text"></div>
                        <a href="" class="xg"></a></li>
                    </li>
                    <li><i class="emailicon"></i>
                        <div class="text">15977723563</div>
                        <div class="name">谭志立</div>
                    </li>
                    <li style="border:none;height:38px;"><i class="yhicon"></i>
                        <div class="text">暂未添加</div>
                    </li>
                    </li>
                </div>
            </div>
            <div class="my_game1 mb40" style="height: 500px;">
                <div class="title">财务记录</div>
                <a href="/user/profile/money.html" class="gdjl"><i class="gdjlicon"></i>更多记录</a>
                <div class="yx_list"></div>
            </div>
            <div class="pagination" id="page_record_list"></div>
        </div>
    </div>
    <br/>
    <br/>
    <script src="{{ asset('js/online.js') }}"></script>
@endsection



@push('scripts')
    <script>
        var kflist = {
            "3": [{
                "id": "6",
                "title": "\u5357\u5bab\u5ba2\u670d",
                "name": "\u5ba2\u670d\u2460",
                "cid": "1",
                "ac": "3",
                "value": "9001723",
                "url": "http:\/\/wpa.qq.com\/msgrd?v=3&amp;uin=7770992&amp;site=qq&amp;menu=yes",
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
    <script src="{{ asset('js/online.js') }}"></script>
    <script type="text/javascript">
        function get_list_page(page) {
            var url, data;
            url = "/user/center/get_account_log_list/page/" + page;
            $.ajax({
                type: "post",
                cache: false,
                url: url,
                datatype: "json",
                error: function (data) {
                    $.message({type: "error", content: '网络超时，请刷新页面后重试', time: 3000});
                },
                beforeSend: function () {
                    $(".yx_list").html("<li class='loading'><span>正在加载数据, 请稍等......</span></li>");
                },
                success: function (data) {
                    var count = Math.ceil(data.count / data.pageSize);
                    $(".yx_list").html(data.list);
                    $("#page_record_list").pager({
                        pagenumber: data.page,
                        pagecout: count,
                        buttonClickCallback: function (page) {
                            get_list_page(page);
                        }
                    });

                }
            });

        }

        $(function () {
            $(".navlist li a:eq(0)").addClass("current");
            get_list_page(1);
        });
    </script>

@endpush