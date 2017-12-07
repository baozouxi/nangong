@extends('layouts.app')


@push('css')
    <link href="{{ asset('css/center.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/page.css') }}" type="text/css"/>
@endpush

@section('main')

    <div class="main_nav">
        <div class="w1000">
            <div class="navlist">
                @include('account.nav')
            </div>
        </div>
    </div>
    <div class="main">
        <div class="w1000">
            <div class="my_game1 mb40">
                <div class="titbox">
                    <li class="tt1"><a href="javascript:;" onclick="get_finance_list(1,1,1)">提现</a></li>
                    <li class="tt1"><a href="javascript:;" onclick="get_finance_list(2,1,1)">充值</a></li>
                    <div class="line"></div>
                    <li class="tt2"><a href="javascript:;" onclick="get_finance_list(tsort,1,1)">最近一个月</a></li>
                    <li class="tt2"><a href="javascript:;" onclick="get_finance_list(tsort,2,1)">最近三个月</a></li>
                    <li class="tt2"><a href="javascript:;" onclick="get_finance_list(tsort,3,1)">全部</a></li>
                </div>
                <div class="yx_list" id="yx_list" style="min-height: 400px;">
                    <li class='loading'><span>正在加载数据, 请稍等......</span></li>
                </div>
                <div class="pagination"></div>
            </div>
        </div>
    </div>
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
        function get_finance_list(t, d, page) {
            var url, data;
            tsort = t;
            url = "/user/profile/get_finance_list/t/" + t + "/d/" + d + "/page/" + page;
            $(".titbox a").removeClass("current");
            var i1 = t - 1;
            var i2 = d - 1;
            $(".tt1 a").eq(i1).addClass("current");
            $(".tt2 a").eq(i2).addClass("current");
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
                    $("#yx_list").html(data.list);
                    $(".pagination").pager({
                        pagenumber: data.page,
                        pagecout: count,
                        buttonClickCallback: function (page) {
                            get_finance_list(t, d, page);
                        }
                    });

                }
            });

        }

        $(function () {
            $(".navlist li a:eq(1)").addClass("current");
            $(".tzfa ul li").toggle(
                function () {
                    $(this).next(".ck_nr").toggle();
                },
                function () {
                    $(this).next(".ck_nr").toggle();
                }
            )
            get_finance_list(tsort, d, page);
        });
    </script>
@endpush
