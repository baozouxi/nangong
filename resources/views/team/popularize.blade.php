@extends('layouts.app')


@push('css')
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/css/center.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/agent/user.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/agent/proxy.css" rel="stylesheet" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="/themes/simplebootx/Public/agent/laydate.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/agent/style.css?v=1"/>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/agent/js-ui.css?v=2"/>
    <style>
        #qrcode {
            display: none;
        }

        #qrcode .qrcodebg,
        #qrcode .qrsrc {
            position: fixed;
        }

        #qrcode .qrcodebg {
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 100;
            top: 0;
            left: 0;
        }

        #qrcode .qrsrc {
            width: 200px;
            height: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            z-index: 101;
            background: url(/themes/simplebootx/Public/agent/loading-1.gif) center center no-repeat white;
        }

        #qrcode .qrsrc img {
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@push('init-scripts')
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/event.js?1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/msgbox.js?1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery.SuperSlide.2.1.1.js"></script>

    <script type="text/javascript" src="/themes/simplebootx/Public/agent/jquery-ui-1.10.2.js?v=1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/jquery.zclip.min.js?v=2"></script>
@endpush

@section('main')
    <div class="banner_hyzx">
        <div class="w1000">
            <div class="uesr">
                <div class="imgbox"><a href="agentlink.html"><img src="/themes/simplebootx/Public/images/user.png"
                                                                  alt=""></a></div>
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
                            <!-- end -->
                        </div>
                    </div>
                </div>
                <div class="content" id="user-proxy">
                    <div class="body-row">
                        <ul class="ui-tab-title tab-title-from clearfix">
                            <li id="addaguser"><a href="javascript:;">下级直接开户</a></li>
                            <li class="current">推广链接开户</li>
                        </ul>
                        <ul class="ui-form ui-tab-content ui-tab-content-current" style="padding:32px 48px;">
                            <li class="ui-item">
                                <label for="info">会员类别：</label>
                                <select class="ui-select" name="userType" id="userType" style="width:96px">
                                    <option value="1" selected="selected">代理</option>
                                    <!--option value="0">会员</option-->
                                </select>
                            </li>
                            <li class="ui-item">
                                <label for="checkInfo">彩票返点：</label> <span class="inputTextLabel"><div id="userBounds2"
                                                                                                       class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                                                                                       aria-disabled="false"><a
                                                class="ui-slider-handle ui-state-default ui-corner-all"
                                                href="agentlink.html#" style="left: 0%;"></a></div></span> &nbsp; &nbsp;
                                <span class="ui-prompt" id="userBoundsText2">0</span></li>
                            <li class="ui-item">
                                <label for="name"></label> <span style="color:#999">可以拖动滑块调节用户返点</span></li>
                            <li class="ui-item">
                                <label>&nbsp;</label> <a href="javascript:void(0);" class="btn"
                                                         id="J-button-submit">生成链接</a></li>
                            <div class="body-row" style="padding-top:24px;">
                                <table class="table table-info">
                                    <thead>
                                    <tr>
                                        <th>注册链接</th>
                                        <th>会员类别</th>
                                        <th>返点(%)</th>
                                        <th>已注册</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="row-list-85">
                                        <td>
                                            <input type="input" class="ip-text ip-text-link"
                                                   value="http://t.cn/RToQnYI"> <a
                                                    href="javascript:void(0)" name="a-copy" class="">复制</a> <span
                                                    style="color:#ccc">|</span> <a href="javascript:void(0);"
                                                                                   class="createqrcode">生成二维码</a></td>
                                        <td>代理用户</td>
                                        <td>0.0</td>
                                        <td>0</td>
                                        <td><a name="a-userdelete" href="javascript:void(0);" remark="85">删除</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <div id="qrcode">
        <div class="qrcodebg"></div>
        <div class="qrsrc"><img src="agentlink.html"/></div>
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
    <script src="/plug/service/online.js?v0.1"></script>
    <script>
        var E = $.myAjax,
            tmp, msgbox = layer,
            mtipsOK = {icon: 1, time: 1000, shade: [0.2, '#000000']},
            mtipsErr = {icon: 2, time: 1000, shade: [0.2, '#000000']},
            $submit = $('#J-button-submit'),
            MinChangeValue = 0,
            MaxChangeValue2 = parseInt('') - 0.1,
            Value = 0,
            SmallChange = 0.1;
        //提交
        $submit.click(function () {
            if ($(this).hasClass('btn-disable')) {
                return false;
            }
            $(this).addClass('btn-disable');
            E.get('createlink').load({
                data: {
                    'ltpoint': $.trim($("#userBounds2").slider("value"))
                }
            });
        });

        $('#addaguser').click(function () {
            msgbox.msg('暂未开放账号注册', mtipsErr);
        })
        //生成二维码
        $('.createqrcode').click(function (event) {
            event.stopPropagation();
            var path = $(this).parent('td').find('input').val();
            if (!path) {
                msgbox.msg('推广链接不存在，生成失败', mtipsErr);
            } else {
                path = 'http://qr.liantu.com/api.php?&bg=ffffff&fg=000000&text=' + path;
                var _width = $(window).width();
                var _height = $(window).height();
                var top = (_height - $('#qrcode .qrsrc').height()) / 2,
                    left = (_width - $('#qrcode .qrsrc').width()) / 2;
                $('#qrcode .qrsrc').css({left: left, top: top}).find('img').attr('src', path);
                $('#qrcode .qrcodebg').css('opacity', 0.5);
                $('#qrcode').show();
            }
        });

        $('#qrcode .qrsrc').click(function (event) {
            event.stopPropagation();
        })
        $('body').click(function () {
            if ($('#qrcode').is(':visible')) {
                $('#qrcode').hide();
            }
        })
        E.get('deletelink', {url: '/user/ltagent/dellink.html'}).bind(function (data) {
            if (data.status == 'ok') {
                $('#row-list-' + data.id).remove();
                msgbox.msg(data.msg, mtipsOK);
            } else {
                msgbox.msg(data.msg, mtipsErr);
            }
        });

        E.get('createlink', {url: '/user/ltagent/createlink.html'}).bind(function (data) {
            if (data.status == 'ok') {
                msgbox.msg(data.msg, mtipsOK, function () {
                    window.location.reload(1);
                });
            } else {
                $submit.removeClass().addClass('btn');
                msgbox.msg(data.msg, mtipsErr);
            }
        });

        $("[name='a-copy']").each(function () {
            $(this).zclip({
                path: '/themes/simplebootx/Public/agent/ZeroClipboard.swf',
                copy: function () {
                    return $(this).parent().find("input").val();
                },
                afterCopy: function () {
                    msgbox.msg('复制成功!', mtipsOK);
                }
            });
        });

        $("[name='a-userdelete']").click(function () {
            var me = $(this);
            msgbox.confirm('您确定要删除该条链接？', {move: false}, function (_id) {
                E.get('deletelink').load({
                    data: {
                        'id': me.attr('remark')
                    }
                });
                msgbox.close(_id);
            });
        });


        $("#userBounds2").slider({
            value: Value,
            min: MinChangeValue,
            max: MaxChangeValue2,
            step: SmallChange,
            slide: function (event, ui) {
                $("#userBoundsText2").text(ui.value);
            }
        });
        $("#userBoundsText2").text($("#userBounds2").slider("value"))

        $(".navlist li a:eq(6)").addClass("current");
    </script>

@endpush