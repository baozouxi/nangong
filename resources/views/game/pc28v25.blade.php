@extends('layouts.app')


@push('css')
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/page.css" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/game28.css" type="text/css"/>
@endpush
@push('init-scripts')
    <script src="/public/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/pc28v25js/loaddata.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/pc28v25js/json2.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/page.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/gamepc28.js"></script>
    <script>
        var webroot = "/",
            t = 2,
            v = "25",
            page = 1;
    </script>

@endpush


@section('main')

    <div class="main ovf bgyxzx">
        <div class="yxzxbanner"></div>
        <div class="w1000">
            <div class="xy28_bc tzbox">
                <div class="titbox">
                    <div class="title">幸运28</div>
                    <div class="select25">
                        <select id="rid" class="mr10" name="rid"
                                onchange="location.href='/game/pc28'+$(this).val();">
                            <option value="v25" selected="selected">2.5倍场</option>
                            <option value="">2.0倍场</option>
                        </select>
                    </div>
                    <div class="dnq qihaoHD"></div>
                </div>
                <div class="clear"></div>
                <div class="kjdjs_box"
                     style="background: #fff url(/themes/simplebootx/Public/images/kjdjs_box_new.png) no-repeat  292px 20px;">
                    <div class="kjdjs">
                        <div class="num timeHD1"></div>
                        <div class="num timeHD2"></div>
                        <div class="num timeHD3"></div>
                        <div class="name timeHD4"></div>
                    </div>
                    <div class="xxdd" id="lottshow1" style="margin-left:57px;width:382px;">
                        <div class="num FCnum01" style="margin-left:50px;"></div>
                        <div class="num FCnum02"></div>
                        <div class="num FCnum03"></div>
                        <div class="num end FCnum04"></div>
                        <div class="name" id="nameb1">
                            <div class="tips FCnum06"></div>
                            <div class="tips FCnum07"></div>
                            <div class="tips FCnum05"></div>
                            <div class="tips FCnum09" style="margin-right:0px;"></div>
                        </div>
                    </div>
                    <div class="xxdd" id="lottshow2" style="display: none;" style="margin-left:57px;width:382px;">
                        <div class="num" style="margin-left:-15px;"></div>
                        <div class="num"></div>
                        <div class="num"></div>
                        <div class="num end"></div>
                        <div class="clear"></div>
                        <p align="center">
                            <br/>正在等待开奖，请稍后 ···</p>
                    </div>
                    <div class="yx_btn" style="margin-left:84px;"><a href="javascript:void(0)"
                                                                     onclick="document.getElementById('lightyxgz').style.display='block';document.getElementById('fadeyxgz').style.display='block'"
                                                                     class="yxgz">游戏规则</a> <a
                                href="{{ route('pc28v25Play') }}" class="ingame">进入游戏</a></div>
                </div>
                <div class="d55445 txtScroll-top">
                    <div class="hd btn"><a class="next shang" href="javascript:nextgetopencode();"></a> <a
                                class="prev xia"
                                href="javascript:prevgetopencode();"></a>
                    </div>
                    <div class="bd">
                        <ul class="infoList">
                            <li><span class="name FMnum08"></span> <span class="num FMnum01"></span> <span
                                        class="num FMnum02"></span> <span class="num FMnum03"></span> <span
                                        class="num end FMnum04"></span>
                                <div class="dx FMnum06"></div>
                                <div class="dx FMnum07"></div>
                                <div class="dx FMnum05"></div>
                                <div class="dx FMnum09"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="j10qikjend" style="float:left"><span>近10期开奖结果	</span>
                    <ul class="circle"></ul>
                </div>
            </div>
            <div class="yxzxtab">
                <div class="notice">
                    <div class="tab-hd" id="tab-hd">
                        <ul>
                            <li onclick="get_tab_list(1,v,page,{{ $game_id }})">投注方案</li>
                            <li onclick="get_tab_list(2,v,page,{{ $game_id }})">往期开奖</li>
                            <li onclick="get_tab_list(4,v,page,{{ $game_id }})">开奖走势</li>
                        </ul>
                    </div>
                    <div class="tab-bd">
                        <div class="tab-pal" style="min-height: 600px;" id="tab-pal">
                            <li class='loading'><span>正在加载数据, 请稍等......</span></li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--游戏规则弹窗-->
    <div id="lightyxgz" class="white_contentyxgz">
        <div class="lyxgztit"><i class="yxgztiti"></i> <span>游戏规则</span> <a href="javascript:void(0)"
                                                                            onclick="document.getElementById('lightyxgz').style.display='none';document.getElementById('fadeyxgz').style.display='none'"
                                                                            class="yxgzgbbtn"></a></div>
        <div class="lyxgzcon">
            <p>
                <br/>【2.5倍场规则】
                <br/> 1、买组合（大,小,单,双）：2.5倍（含本金）
                <br/>2、买组合（小单）：5.0倍（含本金）
                <br/>3、买极值：（极小，极大）：11.0倍（含本金）
                <br/>4、买数字：（0-27）：11.0倍（含本金）
                <br/>5、买小单，开奖结果为13：回本
                <br/>6、买大双，开奖结果为14：回本
                <br/>7、买小或单，开奖结果为13，总下注大于1000：1.2倍（含本金）
                <br/>8、买小或单，开奖结果为13，总下注小于等于1000：2.5倍（含本金）
                <br/>9、买大或双，开奖结果为14，总下注大于1000：1.2倍（含本金）
                <br/>10、买大或双，开奖结果为14，总下注小于等于1000：2.5倍（含本金）
                <br/>11、豹子：50.0倍（含本金）
                <br/>12、顺子：12.0倍（含本金）
                <br/>13、对子：3.0倍（含本金）
                <br/>14、开奖开出对子，顺子，豹子。中单注，组合回本：回本
                <br/>15、买组合（大单）：5.0倍（含本金）
                <br/>16、买组合（小双）：5.0倍（含本金）
                <br/>17、买组合（大双）：5.0倍（含本金）
                <br/>
                <font style="color:#ff0000;">（必读公告有详细说明）</font>
                <br/></p>
            <p>幸运28开奖结果来源于国家福利彩票北京快乐8(官网)开奖号码，从早上9:05至23:55，每5分钟一期不停开奖。
                <br/>
                <br/> 北京快乐8每期开奖共开出20个数字，幸运28将这20个开奖号码按照由小到大的顺序依次排列；取其1-6位开奖 号码相加，和值的末位数作为幸运 28开奖第一个数值；
                取其7-12位开奖号码相加，和值的末位数作为幸运28 开奖第二个数值，取其13-18位开奖号码相加，和值的末位数作为幸运 28开奖第三个数值；三个数值相加即为 幸运28最终的开奖结果。
            </p> <img src="/themes/simplebootx/Public/images/yxgzimg.jpg" width="600" height="215" alt="">
            <p>幸运28开奖结果（以上面为例）就是 6+7+5=18</p>
            <p>幸运28总共由28个号码组成，分别为0-27</p> <span>玩法简介</span>
            <p>大小玩法：数字14-27为大 数字0-13为小 出13押小回本金 出14押大回本本金</p>
            <p>单双玩法: 数字1，3，5，~27为单 数字0，2，4~26为双 出13压单回本出14押双回本</p>
            <p>极值玩法: [极小0-5] 10倍 [极大22-27] 10倍 举例：买极小100元 开奖结果为0-5其中一个数字就中1000元（包括本金）极大反之。</p>
            <p>组合玩法:</p>
            <p>&#12288;&#12288;• 数字14，16，~26为大双 数字0，2，4，~12为小双</p>
            <p>&#12288;&#12288;• 数字15，17，~27为大单 数字1，3，5，~13为小单</p>
            <p>&#12288;&#12288;• 开13，14组合回本，举例 买100元小单开13就回本金 买100元大双开14就回本金</p>
            <p>&#12288;&#12288;• 其余买大单 小单 大双 小双 奖金为本金的4倍 。</p>
            <p>定位玩法(单点数字玩法): 从数字0-27中选取一个数字 中奖为本金的10倍</p>
            <p>北京 BeiJing</p>
            <p>&#12288;&#12288;• 官方网址： http://www.bwlc.gov.cn/bulletin/prevslto.html?id=3</p>
            <p>&#12288;&#12288;• 开奖频率：300秒一期</p>
            <p>&#12288;&#12288;• 开奖次数：每天开奖179期</p>
            <p>&#12288;&#12288;• 开奖时间：开盘09:00am 关盘23:55pm [北京时间]</p>
            <p>&#12288;&#12288;• 游戏简介：北京快乐8是由中国福利彩票发行中心组织发行，根据《彩票发行与销售管理暂行规定》等规定统一由北京市福利彩票发行的快开型彩票，300秒一期，每天开奖179期。</p>
        </div>
    </div>
    <div id="fadeyxgz" class="black_overlaybyxgz"></div>
    <!--游戏规则弹窗 end-->


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
        var game_id = {{ $game_id }}
        bwmain({{ $game_id }})
    </script>


@endpush