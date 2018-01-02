@extends('layouts.app')
@push('css')
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/page.css" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/game28.css" type="text/css"/>
    <link rel="stylesheet" href="/themes/simplebootx/Public/css/game28bet.css" type="text/css"/>
@endpush


@push('init-scripts')

    <script src="/public/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/page.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/pc28v25js/loaddata.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/pc28v25js/json2.js"></script>
    <script>
        var webroot = "/";
    </script>
@endpush

@section('main')
    <form id="subform" onSubmit="return checkdb(this,{{ $game_id }})">
        <div class="main ovf bgyxzx">
            <div class="w1000">
                <div class="xy28_bc">
                    <div class="titbox">
                        <div class="title">加拿大幸运28-2.5倍</div>
                        <div class="select25">
                            <select id="rid" class="mr10" name="rid" onchange="location.href='/game/canada'+$(this).val();">
                                <option value="v28">2.8倍场</option>
                                <option selected="selected" value="v25">2.5倍场</option>
                                <option value="" >2.0倍场</option>
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
                                    href="{{ route('pc28v25') }}" class="lskj">历史开奖</a></div>
                    </div>
                    <div class="d55445 txtScroll-top">
                        <div class="hd btn"><a class="next shang" href="javascript:nextgetopencode();"></a> <a
                                    class="prev xia" href="javascript:prevgetopencode();"></a></div>
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
                    <div class="sz0_27" style="margin-top:64px;">
                        <ul class="first">
                            <li><a id="tyl00" href="javascript:showbetdata('00');">00</a> <span>x11</span></li>
                            <li><a id="tyl01" href="javascript:showbetdata('01');">01</a> <span>x11</span></li>
                            <li><a id="tyl02" href="javascript:showbetdata('02');">02</a> <span>x11</span></li>
                            <li><a id="tyl03" href="javascript:showbetdata('03');">03</a> <span>x11</span></li>
                            <li><a id="tyl04" href="javascript:showbetdata('04');">04</a> <span>x11</span></li>
                            <li><a id="tyl05" href="javascript:showbetdata('05');">05</a> <span>x11</span></li>
                            <li><a id="tyl06" href="javascript:showbetdata('06');">06</a> <span>x11</span></li>
                            <li><a id="tyl07" href="javascript:showbetdata('07');">07</a> <span>x11</span></li>
                            <li><a id="tyl08" href="javascript:showbetdata('08');">08</a> <span>x11</span></li>
                            <li><a id="tyl09" href="javascript:showbetdata('09');">09</a> <span>x11</span></li>
                            <li><a id="tyl10" href="javascript:showbetdata('10');">10</a> <span>x11</span></li>
                            <li><a id="tyl11" href="javascript:showbetdata('11');">11</a> <span>x11</span></li>
                            <li><a id="tyl12" href="javascript:showbetdata('12');">12</a> <span>x11</span></li>
                            <li style="margin-right:0px;"><a id="tyl13" href="javascript:showbetdata('13');">13</a>
                                <span>x11</span>
                            </li>
                        </ul>
                        <ul class="second">
                            <li><a id="tyl14" href="javascript:showbetdata('14');">14</a> <span>x11</span></li>
                            <li><a id="tyl15" href="javascript:showbetdata('15');">15</a> <span>x11</span></li>
                            <li><a id="tyl16" href="javascript:showbetdata('16');">16</a> <span>x11</span></li>
                            <li><a id="tyl17" href="javascript:showbetdata('17');">17</a> <span>x11</span></li>
                            <li><a id="tyl18" href="javascript:showbetdata('18');">18</a> <span>x11</span></li>
                            <li><a id="tyl19" href="javascript:showbetdata('19');">19</a> <span>x11</span></li>
                            <li><a id="tyl20" href="javascript:showbetdata('20');">20</a> <span>x11</span></li>
                            <li><a id="tyl21" href="javascript:showbetdata('21');">21</a> <span>x11</span></li>
                            <li><a id="tyl22" href="javascript:showbetdata('22');">22</a> <span>x11</span></li>
                            <li><a id="tyl23" href="javascript:showbetdata('23');">23</a> <span>x11</span></li>
                            <li><a id="tyl24" href="javascript:showbetdata('24');">24</a> <span>x11</span></li>
                            <li><a id="tyl25" href="javascript:showbetdata('25');">25</a> <span>x11</span></li>
                            <li><a id="tyl26" href="javascript:showbetdata('26');">26</a> <span>x11</span></li>
                            <li style="margin-right:0px;"><a id="tyl27" href="javascript:showbetdata('27');">27</a>
                                <span>x11</span>
                            </li>
                        </ul>
                    </div>
                    <table class="dx_table" style="height:46px;">
                        <tr>
                            <td colspan="2" style="width:220px;height:46px;" id="tyl102" onclick="showbetdata('102');">
                                大<span>x2.5</span></td>
                            <td colspan="2" style="width:220px;height:46px;" id="tyl101" onclick="showbetdata('101');">
                                小<span>x2.5</span></td>
                            <td style="width:220px;height:46px;" id="tyl103" onclick="showbetdata('103');">
                                单<span>x2.5</span></td>
                            <td style="width:220px;height:46px;" id="tyl104" onclick="showbetdata('104');">
                                双<span>x2.5</span></td>
                        </tr>
                    </table>
                    <table id="dx_table" style="height:46px;">
                        <tr>
                            <td id="tyl106" style="width:95px;" onclick="showbetdata('106');">大单<span>x5</span></td>
                            <td id="tyl108" style="width:95px;" onclick="showbetdata('108');">大双<span>x5</span></td>
                            <td id="tyl105" style="width:95px;" onclick="showbetdata('105');">小单<span>x5</span></td>
                            <td id="tyl107" style="width:95px;" onclick="showbetdata('107');">小双<span>x5</span></td>
                            <td id="tyl110" style="width:95px;" onclick="showbetdata('110');">极大<span>x11</span></td>
                            <td id="tyl109" style="width:95px;" onclick="showbetdata('109');">极小<span>x11</span></td>
                            <td id="tyl142" style="width:95px;" onclick="showbetdata('142');">对子<span>x3</span></td>
                            <td id="tyl141" style="width:95px;" onclick="showbetdata('141');">顺子<span>x12</span></td>
                            <td id="tyl140" style="width:95px;" onclick="showbetdata('140');">豹子<span>x50</span></td>
                        </tr>
                    </table>
                    <div class="guess" style="border-radius:5px;">
                        <div class="qsr">请输入您觉得本次开奖结果的数字</div>
                        <input type="text" class="textin" onkeyup="onlynum(this);" onblur="onlynum27(this)" id="tp999"
                               name="tp999">
                        <input type="submit" class="btn" value="猜测" onclick="submitOKtp999({{ $game_id }});return false;"></div>
                    <div class="xiao_tips">
                        投注超过1001元，可以免费猜一个数字，猜中奖励88元；投注超过2000元，猜中奖励188元；投注超过5000元，猜中奖励588元；投注超过10000元，猜中奖励888元。
                    </div>
                    <div class="querentouzhu">
                        <ul id="betall"></ul>
                        <div id="tj_new"><span class="JKnum04">账户余额：{{ number_format(Auth::user()->capital->money,2)  }}</span>
                            <input type="submit" class="tj xz" value=""
                                   style="background:url(/themes/simplebootx/Public/images/tj_new.png) no-repeat  center center;"
                                   onclick="submitOK();return false;"> <span class="jk-z" id="jk-z"><i class="on"
                                                                                                       rel="10">十</i><i
                                        rel="100">百</i><i rel="1000">千</i><i class="last" rel="10000">万</i></span></div>
                    </div>
                    <div class="bottom_small_tips">
                        <p>最低下注金额为10元或10元以上的整数，否则不能投注。</p>
                        <p>倒计时30秒后不可下注不可取消下注。</p>
                    </div>
                </div>
                <div class="tzfa">
                    <div class="title_box">
                        <div class="title">投注方案</div>
                        <a href="http://ng077.com/user/game/pc28v25.html?v=1" class="qbjl">全部记录</a></div>
                    <ul id="userBetsListToday"></ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </form>
    <!--游戏规则弹窗-->
    <div id="lightyxgz" class="white_contentyxgz">
        <div class="lyxgztit"><i class="yxgztiti"></i> <span>游戏规则</span> <a href="javascript:void(0)"
                                                                            onclick="document.getElementById('lightyxgz').style.display='none';document.getElementById('fadeyxgz').style.display='none'"
                                                                            class="yxgzgbbtn"></a></div>
        <div class="lyxgzcon">
            <p>
                <br/>【2.5倍场规则】
                <br/> 　　大小单双：2.5倍（含本金）
                <br/> 　　组合：小单、大双、5.0倍（含本金）
                <br/> 　　组合：小双、大单、5.0倍（含本金）
                <br/> 　　极大极小：11倍（含本金）
                <br/> 　　数字：11倍（含本金）
                <br/> 　　对子：3.0倍（含本金）
                <br/> 　　顺子：12倍（含本金）
                <br/> 　　豹子：50倍（含本金）
                <br/> 　　1.大小单双下注超过：1000
                <br/> 　　开13/14/中奖了1.2倍（含总注）
                <br/> 　　2.下注小单/大双/大双/小单：
                <br/> 　　开13/14/对子/顺子/豹子/中奖了回本（含总注）
                <br/> 　　下注封顶额度：总注最高100000
                <br/> 　　大小单双:60000封顶
                <br/> 　　组合：10000封顶
                <br/> 　　极大极小：5000封顶
                <br/> 　　数字：5000封顶
                <br/> 　　对子：10000封顶
                <br/> 　　顺子：5000封顶
                <br/> 　　豹子：2000封顶
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
        var appdownload = null;
        var game_id = {{ $game_id }}

        bwmain({{ $game_id }})
    </script>


@endpush