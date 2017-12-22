@extends('layouts.app')


@push('css')
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/css/center.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/page.css" type="text/css"/>
    <link href="/themes/simplebootx/Public/agent/user.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/agent/proxy.css" rel="stylesheet" type="text/css"/>
    <style>
        .my_game1 .yx_list li .yxmc,
        .my_game1 .yx_list li.first .yxmc {
            width: 15%;
        }

        .my_game1 .yx_list li .yl,
        .my_game1 .yx_list li.first .yl {
            width: 10%;
        }

        .my_game1 .yx_list li .gl,
        .my_game1 .yx_list li.first .gl {
            width: 15%;
        }

        .my_game1 .yx_list li .time,
        .my_game1 .yx_list li.first .time {
            width: 15%;
        }
    </style>
@endpush

@push('init-scripts')

    <script type="text/javascript" src="/themes/simplebootx/Public/js/page.js"></script>
@endpush


@section('main')
    <div class="banner_hyzx">
        <div class="w1000">
            <div class="uesr">
                <div class="imgbox"><a href="manage.html"><img src="/themes/simplebootx/Public/images/user.png" alt=""></a>
                </div>
                <div class="name_box">
                    <div class="name"><span>{{ $user->username }}</span>
                        <div class="uid">uid：{{ $user->id }}</div>
                    </div>
                    <div class="time">上次登录时间：{{ $lastLogin? $lastLogin->login_time : ''  }}</div>
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
            <div class="right-side">
                <div class="sidewrap merge-footer" style="min-height:auto;">
                    <div class="content" id="user-proxy">
                        <div class="body-row">
                            <div class="statistical-info">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td width="20%">团队成员：<span class="boldtext">0人</span></td>
                                        <td width="40%">团队余额：<span class="boldtext">0.00元（不包含自己）</span></td>
                                        <td width="15%">当前返点：<span class="boldtext">%</span></td>
                                        <td>总提成：<span class="boldtext">0.00元</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my_game1 mb20" style="min-height:300px;">
                <div class="title">团队成员</div>
                <!--a href="/user/profile/money.html" class="gdjl"><i class="gdjlicon"></i>更多记录</a-->
                <div class="yx_list"></div>
            </div>
            <div class="pagination" id="page_record_list"></div>
        </div>
    </div>

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
    <script type="text/javascript">
        function get_list_page(page) {
            var url, data;
            url = "/team/load-manager";
            $.ajax({
                type: "get",
                cache: false,
                url: url,
                data: {page: page},
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
            $(".navlist li a:eq(5)").addClass("current");
            get_list_page(1);
        });
    </script>

@endpush