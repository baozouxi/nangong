@extends('layouts.app')



@section('main')
    <div class="w1000">
        <div class="banner">
            <div class="fullSlide">
                <div class="bd">
                    <ul>
                        <li style="background:url(themes/simplebootx/Public/images/banner1.jpg) #fff center center no-repeat;"></li>
                        <li style="background:url(themes/simplebootx/Public/images/banner2.jpg) #fff center center no-repeat;"></li>
                        <li style="background:url(themes/simplebootx/Public/images/banner0.jpg) #fff center center no-repeat;"></li>
                    </ul>
                </div>
                <div class="hd">
                    <ul></ul>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(".fullSlide").slide({
                    titCell: ".hd ul",
                    mainCell: ".bd ul",
                    effect: "fold",
                    autoPlay: true,
                    autoPage: true,
                    trigger: "click"
                });
            </script>
        </div>
    </div>
    <div class="main">
        <div class="w1000">
            <div class="gameone" id='gameone'>
                <li><a href="javascript:;" onclick="hbgame();"><img src="themes/simplebootx/Public/images/gameone3.jpg"
                                                                    alt=""><i></i>
                        <div class="zz"></div>
                    </a></li>
                <li><a href="javascript:;" onclick="cakenogame();"><img
                                src="themes/simplebootx/Public/images/gameone4.jpg" alt=""><i></i>
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone2.jpg" alt="">
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone5.jpg" alt="">
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone7.jpg" alt="">
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone1.jpg" alt="">
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone6.jpg" alt="">
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone8.jpg" alt=""><i></i>
                        <div class="zz"></div>
                    </a></li>
                <li><a href="index.html#"><img src="themes/simplebootx/Public/images/gameone9.jpg" alt="">
                        <div class="zz"></div>
                    </a></li>
            </div>
            <div class="huodong">
                <div class="picbox"><a href="javascript:;"><img src="themes/simplebootx/Public/images/huodong.jpg"
                                                                alt=""></a></div>
                <ul>
                    <li><a href="http://ng077.com/portal/index/show/id/96.html" target="_blank"> 北京2.0倍 加拿大2.0倍玩法 赔率改动
                            <span>2017-09-15</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/95.html" target="_blank"> 加拿大2.7倍玩法调整为2.8倍玩法
                            <span>2017-03-17</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/94.html" target="_blank"> 2016-12-11日起提现将收取手续费
                            <span>2016-12-10</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/93.html" target="_blank"> 南宫国际幸运争霸赛9069完美结束
                            <span>2016-12-04</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/92.html" target="_blank"> 南宫国际幸运争霸赛9068完美结束
                            <span>2016-12-02</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/91.html" target="_blank"> 南宫国际幸运争霸赛9067完美结束
                            <span>2016-11-30</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/90.html" target="_blank"> 南宫国际幸运争霸赛9066完美结束
                            <span>2016-11-27</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/89.html" target="_blank"> 南宫国际幸运争霸赛9065完美结束
                            <span>2016-11-25</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/88.html" target="_blank"> 南宫国际幸运争霸赛9064完美结束
                            <span>2016-11-23</span></a></li>
                    <li><a href="http://ng077.com/portal/index/show/id/87.html" target="_blank"> 南宫国际幸运争霸赛9063完美结束
                            <span>2016-11-20</span></a></li>
                </ul>
            </div>
            <div class="gametwo">
                <li><a href="javascript:;" onclick="hbgame();"><img src="themes/simplebootx/Public/images/gametwo1.jpg"
                                                                    alt=""><span>进入游戏</span></a></li>
                <li><a href="javascript:;" onclick="cakenogame();"><img
                                src="themes/simplebootx/Public/images/gametwo2.jpg" alt=""><span>进入游戏</span></a></li>
                <li><a href="javascript:;"><img src="themes/simplebootx/Public/images/gametwo3.jpg"
                                                alt=""><span>进入游戏</span></a></li>
                <li class="last"><a href="javascript:;"><img src="themes/simplebootx/Public/images/gametwo4.jpg" alt=""><span>进入游戏</span></a>
                </li>
            </div>
            <div class="youshi">
                <li><i class="iconlyoushi1"></i><span>存款到账</span>
                    <p>存款平均10秒极速到账</p>
                </li>
                <li class="line"></li>
                <li><i class="iconlyoushi2"></i><span>余额提现</span>
                    <p>提现平均两小时内到账</p>
                </li>
                <li class="line"></li>
                <li><i class="iconlyoushi3"></i><span>便捷的充值服务</span>
                    <p> 银行卡，网银，支付宝，微信</p>
                </li>
            </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#gameone li a").mouseenter(function () {
                $('#gameone li a').find('.zz').show();
                $(this).find(".zz").hide();
            });
            $("#gameone li a").mouseleave(function () {
                $('#gameone li a').find('.zz').hide();
            })
        })
    </script>
@endpush

