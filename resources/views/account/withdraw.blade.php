@extends('layouts.app')

@push('css')
    <link href="/themes/simplebootx/Public/css/center.css" rel="stylesheet" type="text/css"/>

@endpush

@push('init-scripts')
    <script src="/public/dialog/jquery.artDialog.js?skin=default" language="javascript"></script>
    <script src="/themes/simplebootx/Public/js/themoney.js"></script>
@endpush






@section('main')


    <div class="banner_hyzx">
        <div class="w1000">
            <div class="uesr">
                <div class="imgbox"><a href="themoney.html"><img src="/themes/simplebootx/Public/images/user.png"
                                                                 alt=""></a></div>
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
    <form onsubmit="return checkdb(this)">
        <div class="main">
            <div class="w1000">
                <div class="hyzx_zhye">
                    <div class="zhye_box">
                        <div class="title"><i class="zhyeicon"></i>账户余额</div>
                        <div class="num">{{ number_format($capital->money, 2) }} 元</div>
                        <a href="http://ng077.com/user/profile/pay.html" class="cz">充值</a><a href="themoney.html"
                                                                                             class="tx">提现</a></div>
                    <div class="geren_infolist">
                        <li><i class="telicon"></i>
                            <div class="text">13228595558</div>
                            <a href="themoney.html" class="xg"></a></li>
                        </li>
                        <li><i class="qqicon"></i>
                            <div class="text"></div>
                            <a href="themoney.html" class="xg"></a></li>
                        </li>
                        <li><i class="emailicon"></i>
                            <div class="text">123456123456</div>
                            <div class="name">asdas</div>
                        </li>
                        <li style="border:none;height:38px;"><i class="yhicon"
                                                                style="background: url(/themes/simplebootx/Public/images/00001.png) no-repeat center center;"></i>
                            <div class="text">123131231321232312312312332</div>
                            <div class="name">asdas</div>
                        </li>
                        </li>
                    </div>
                </div>
                <div class="xuanzeyinhang">
                    <div class="slideTxtBox">
                        <div class="hd">
                            <ul>
                                <li onclick="selthetype(2771);">
                                    <div class="title"><i class="bankicoall"
                                                          style="background: url(/themes/simplebootx/Public/images/00001.png) no-repeat center center;"></i>工商银行
                                    </div>
                                    <div class="num">123131231321232312312312332 <span>asdas</span></div>
                                </li>
                                <li onclick="selthetype(2770);">
                                    <div class="title"><i class="bankicoall"
                                                          style="background: url(/themes/simplebootx/Public/images/99999.png) no-repeat center center;"></i>支付宝
                                    </div>
                                    <div class="num">123456123456 <span>asdas</span></div>
                                </li>
                            </ul>
                        </div>
                        <div class="bd">
                            <ul>
                                <div class="jinebox">
                                    <li style="margin-top:36px;">
                                        <div class="name">提现金额</div>
                                        <input type="text" class="textin" name="t1" onkeyup="onlynum(this);" value="50">
                                        <div class="clear"></div>
                                        <div class="tips">当前可提现金额：<span>{{ number_format($capital->money, 2) }}</span>元</div>
                                    </li>
                                    <li>
                                        <div class="name">资金密码</div>
                                        <input type="password" class="textin" name="passmoney"></li>
                                </div>
                                <input type="hidden" name="thetype" id="thetype" value="2771"/>
                                <input type="submit" class="qrtx0000" name="bnt" value="确认提现"></ul>
                        </div>
                    </div>
                    <script type="text/javascript">
                        jQuery(".slideTxtBox").slide({trigger: "click", delayTime: 0});
                    </script>
                </div>
            </div>
        </div>
    </form>


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

@endpush