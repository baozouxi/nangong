@extends('layouts.app')

@push('css')
    <link href="{{ asset('css/base2.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/center.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dialog/skins/default.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@push('init-scripts')
    <script src="{{ asset('dialog/jquery.artdialog.js') }}" language="javascript"></script>

@endpush

@section('main')

    <div class="main_nav">
        <div class="w1000">
            @include('account.nav')
        </div>
    </div>
    <div class="main">
        <div class="w1000">
            <div class="aqzx_box">
                <div class="aqzx_left"><i class="wdtxzh"></i> <span>我的提现账户</span> <a href="javascript:void(0)"
                                                                                     onclick="document.getElementById('light7').style.display='block';document.getElementById('fade7').style.display='block'"
                                                                                     class="tjzh">添加账户</a></div>
                <div class="aqzx_zhlist" id="bank_list">
                    <div class="aqzx_zhlist" id="bank_list">
                        <li><span class="zhlx"><i class="bankicoall"
                                                  style="background: url(/themes/simplebootx/Public/images/00001.png) no-repeat 0 0;"></i>工商银行</span><span
                                    class="zhid">123131231321232312312312332</span><span class="zhname">asdas</span><a
                                    href="javascript:;" onclick="del_bank_info(2771)" class="zhsc"></a></li>
                        <li><span class="zhlx"><i class="bankicoall"
                                                  style="background: url(/themes/simplebootx/Public/images/99999.png) no-repeat 0 0;"></i>支付宝</span><span
                                    class="zhid">123456123456</span><span class="zhname">asdas</span><a
                                    href="javascript:;" onclick="del_bank_info(2770)" class="zhsc"></a></li>
                    </div>
                    {{--<li class='loading'><span>正在加载数据, 请稍等......</span></li>--}}
                </div>
            </div>
            <div class="aqzx_box mb70">
                <div class="aqzx_left"><i class="zhmmxg"></i> <span>密码修改</span></div>
                <div class="aqzx_zhxglist">
                    <li class="first">
                        <div class="zhxgitem">
                            <div class="zhxgitemxgbox"><i class="zhxgixg"></i> <a class="zhxgia"
                                                                                  href="javascript:void(0)"
                                                                                  onclick="document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'">修改</a>
                            </div>
                            <i class="zhxgdlmm"></i> <span>登录密码</span>
                            <p>建议您使用字母和数字组合，混合大小写在组合中加入下划线等符号</p>
                        </div>
                    </li>
                    <li>
                        <div class="zhxgitem">
                            <div class="zhxgitemxgbox"><i class="zhxgixg"></i> <a class="zhxgia"
                                                                                  href="javascript:void(0)"
                                                                                  onclick="document.getElementById('light2').style.display='block';document.getElementById('fade2').style.display='block'">修改</a>
                            </div>
                            <i class="zhxgzjmm"></i> <span>资金密码</span>
                            <p>在进行银行卡绑定，提现等资金操作时需要的安全确认，以提高您的资金安全性</p>
                        </div>
                    </li>
                    <li class="first">
                        <div class="zhxgitem">
                            <div class="zhxgitemxgbox"><i class="zhxgixg"></i> <a class="zhxgia"
                                                                                  href="javascript:void(0)"
                                                                                  onclick="document.getElementById('light3').style.display='block';document.getElementById('fade3').style.display='block'">修改</a>
                            </div>
                            <i class="zhxgyhzhxm"></i> <span>银行账户姓名</span>
                            <p>绑定玩家的开户信息后，将无法自行修改可保证资金的绝对安全</p>
                        </div>
                    </li>
                    <li>
                        <div class="zhxgitem">
                            <div class="zhxgitemxgbox"><i class="zhxgixg"></i> <a class="zhxgia"
                                                                                  href="javascript:void(0)"
                                                                                  onclick="document.getElementById('light4').style.display='block';document.getElementById('fade4').style.display='block'">修改</a>
                            </div>
                            <i class="zhxgmmbh"></i> <span>密码保护</span>
                            <p>密码丢失后，绑定安全问题后可以通过安全问题找回账号密码</p>
                        </div>
                    </li>
                    <li class="first last">
                        <div class="zhxgitem">
                            <div class="zhxgitemxgbox"><i class="zhxgixg"></i> <a class="zhxgia"
                                                                                  href="javascript:void(0)"
                                                                                  onclick="document.getElementById('light5').style.display='block';document.getElementById('fade5').style.display='block'">修改</a>
                            </div>
                            <i class="zhxgbdsj"></i> <span>绑定手机</span>
                            <p>绑定手机后，我们能够更好的保证您的账户安全更改密码等操作时需要短信验证</p>
                        </div>
                    </li>
                    <li class=" last">
                        <div class="zhxgitem">
                            <div class="zhxgitemxgbox"><i class="zhxgixg"></i> <a class="zhxgia"
                                                                                  href="javascript:void(0)"
                                                                                  onclick="document.getElementById('light6').style.display='block';document.getElementById('fade6').style.display='block'">修改</a>
                            </div>
                            <i class="zhxgbdqq"></i> <span>绑定QQ</span>
                            <p>绑定QQ后，我们能够更好的保证您的账户安全</p>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <!--修改登录密码-->
    <form id="winform1" name="winform1" onSubmit="return editpasslogin(this)">
        <div id="light1" class="white_content zhsq">
            <div class="title"><i class="xgdlicon"></i><span>修改登录密码</span> <a href="javascript:void(0)" class="close"
                                                                              onclick="close_win1()"> </a></div>
            <div class="summary">
                <ul class="passwordlist">
                    <li>
                        <div class="name">原始密码</div>
                        <input type="password" class="textin c_old_password" name="oldpass"></li>
                    <li>
                        <div class="name">新的密码</div>
                        <input type="password" class="textin c_password" name="password"></li>
                    <li>
                        <div class="name">确认密码</div>
                        <input type="password" class="textin c_repassword" name="repassword"></li>
                </ul>
                <div class="tips">密码由6至16个字符组成，且不能与资金密码相同</div>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认修改"></div>
        <div id="fade1" class="black_overlay"></div>
    </form>
    <!--修改资金密码-->
    <form id="winform2" name="winform2" onSubmit="return editpassmoney(this)">
        <div id="light2" class="white_content zhsq">
            <div class="title"><i class="xgmmicon"></i><span>修改资金密码</span> <a href="javascript:void(0)" class="close"
                                                                              onclick="close_win2()"> </a></div>
            <div class="summary">
                <ul class="passwordlist">
                    <li>
                        <div class="name">原始密码</div>
                        <input type="password" class="textin c_old_password" name="oldpass"></li>
                    <li>
                        <div class="name">新的密码</div>
                        <input type="password" class="textin c_password" name="password"></li>
                    <li>
                        <div class="name">确认密码</div>
                        <input type="password" class="textin c_repassword" name="repassword"></li>
                </ul>
                <div class="tips">密码由6至16个字符组成，且不能与登录密码相同</div>
                <div class="tips">默认密码为：12345678，必需修改后才能正常使用</div>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认修改"></div>
        <div id="fade2" class="black_overlay"></div>
    </form>
    <!--绑定银行账户姓名-->
    <form id="winform3" name="winform3" onSubmit="return editnickname(this)">
        <div id="light3" class="white_content zhsq">
            <div class="title"><i class="bdyhicon"></i><span>绑定银行账户姓名</span> <a href="javascript:void(0)" class="close"
                                                                                onclick="close_win3()"> </a></div>
            <div class="summary">
                <div class="bdxm">
                    <div class="name">姓名</div>
                    <input type="text" class="textin c_nickname" name="nickname"></div>
                <div class="tips" style="height:34px;line-height:34px;margin-bottom:51px;">请绑定您银行卡的开户姓名，绑定后将不得自行修改</div>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认绑定"></div>
        <div id="fade3" class="black_overlay"></div>
    </form>
    <!--密码保护-->
    <form id="winform4" name="winform4" onSubmit="return editwdgetpass(this)">
        <div id="light4" class="white_content zhsq">
            <div class="title"><i class="mmbhicon"></i><span>密码保护</span> <a href="javascript:void(0)" class="close"
                                                                            onclick="close_win4()"> </a></div>
            <div class="summary">
                <ul class="passwordlist">
                    <li>
                        <div class="name">问题1</div>
                        <div class="wenti1">
                            <div class="select">
                                <select id="rid1" style="display: none" class="c_rid1" name="rid1">
                                    <option value="" selected="selected">- 请选择 -</option>
                                    <option value="您的出生地是?">您的出生地是?</option>
                                    <option value="您小学班主任的名字是?">您小学班主任的名字是?</option>
                                    <option value="您中学班主任的名字是?">您中学班主任的名字是?</option>
                                    <option value="您高中班主任的名字是?">您高中班主任的名字是?</option>
                                    <option value="您大学班主任的名字是?">您大学班主任的名字是?</option>
                                    <option value="您的小学校名是?">您的小学校名是?</option>
                                    <option value="您母亲的姓名是?">您母亲的姓名是?</option>
                                    <option value="您母亲的生日是?">您母亲的生日是?</option>
                                    <option value="您父亲的姓名是?">您父亲的姓名是?</option>
                                    <option value="您父亲的生日是?">您父亲的生日是?</option>
                                    <option value="您配偶的姓名是?">您配偶的姓名是?</option>
                                    <option value="您配偶的生日是?">您配偶的生日是?</option>
                                    <option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>
                                    <option value="您最喜欢的运动是?">您最喜欢的运动是?</option>
                                    <option value="您的学号（或工号）是?">您的学号（或工号）是?</option>
                                    <option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>
                                    <option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>
                                </select>
                            </div>
                            <script src="{{ asset('js/jqselect.js') }}" type="text/javascript"></SCRIPT>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery("#rid1").selectbox();
                                });
                            </script>
                        </div>
                    </li>
                    <li>
                        <div class="name">答案</div>
                        <input type="text" class="textin c_wd1" name="wd1"></li>
                    <li>
                        <div class="name">问题2</div>
                        <div class="wenti1">
                            <div class="select">
                                <select id="rid2" style="display: none" class="c_rid2" name="rid2">
                                    <option value="" selected="selected">- 请选择 -</option>
                                    <option value="您的出生地是?">您的出生地是?</option>
                                    <option value="您小学班主任的名字是?">您小学班主任的名字是?</option>
                                    <option value="您中学班主任的名字是?">您中学班主任的名字是?</option>
                                    <option value="您高中班主任的名字是?">您高中班主任的名字是?</option>
                                    <option value="您大学班主任的名字是?">您大学班主任的名字是?</option>
                                    <option value="您的小学校名是?">您的小学校名是?</option>
                                    <option value="您母亲的姓名是?">您母亲的姓名是?</option>
                                    <option value="您母亲的生日是?">您母亲的生日是?</option>
                                    <option value="您父亲的姓名是?">您父亲的姓名是?</option>
                                    <option value="您父亲的生日是?">您父亲的生日是?</option>
                                    <option value="您配偶的姓名是?">您配偶的姓名是?</option>
                                    <option value="您配偶的生日是?">您配偶的生日是?</option>
                                    <option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>
                                    <option value="您最喜欢的运动是?">您最喜欢的运动是?</option>
                                    <option value="您的学号（或工号）是?">您的学号（或工号）是?</option>
                                    <option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>
                                    <option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>
                                </select>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery("#rid2").selectbox();
                                });
                            </script>
                        </div>
                    </li>
                    <li>
                        <div class="name">答案</div>
                        <input type="text" class="textin c_wd2" name="wd2"></li>
                    <li>
                        <div class="name">问题3</div>
                        <div class="wenti1">
                            <div class="select">
                                <select id="rid3" style="display: none" class="c_rid3" name="rid3">
                                    <option value="" selected="selected">- 请选择 -</option>
                                    <option value="您的出生地是?">您的出生地是?</option>
                                    <option value="您小学班主任的名字是?">您小学班主任的名字是?</option>
                                    <option value="您中学班主任的名字是?">您中学班主任的名字是?</option>
                                    <option value="您高中班主任的名字是?">您高中班主任的名字是?</option>
                                    <option value="您大学班主任的名字是?">您大学班主任的名字是?</option>
                                    <option value="您的小学校名是?">您的小学校名是?</option>
                                    <option value="您母亲的姓名是?">您母亲的姓名是?</option>
                                    <option value="您母亲的生日是?">您母亲的生日是?</option>
                                    <option value="您父亲的姓名是?">您父亲的姓名是?</option>
                                    <option value="您父亲的生日是?">您父亲的生日是?</option>
                                    <option value="您配偶的姓名是?">您配偶的姓名是?</option>
                                    <option value="您配偶的生日是?">您配偶的生日是?</option>
                                    <option value="对您影响最大的人名字是?">对您影响最大的人名字是?</option>
                                    <option value="您最喜欢的运动是?">您最喜欢的运动是?</option>
                                    <option value="您的学号（或工号）是?">您的学号（或工号）是?</option>
                                    <option value="您最喜欢的明星名字是?">您最喜欢的明星名字是?</option>
                                    <option value="您最熟悉的童年好友名字是?">您最熟悉的童年好友名字是?</option>
                                </select>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery("#rid3").selectbox();
                                });
                            </script>
                        </div>
                    </li>
                    <li>
                        <div class="name">答案</div>
                        <input type="text" class="textin c_wd3" name="wd3"></li>
                    <li>
                        <div class="name">资金密码</div>
                        <input type="password" class="textin c_passmoney" name="passmoney"></li>
                </ul>
                <div class="tips"></div>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认绑定"></div>
        <div id="fade4" class="black_overlay"></div>
    </form>
    <!--绑定手机-->
    <form id="winform5" name="winform5" onSubmit="return editmobile(this)">
        <div id="light5" class="white_content zhsq">
            <div class="title"><i class="bdsjicon"></i><span>绑定手机</span> <a href="javascript:void(0)" class="close"
                                                                            onclick="close_win5()"> </a></div>
            <div class="summary">
                <ul class="bdsjlist1">
                    <li>
                        <div class="name">原手机号</div>
                        <input type="text" class="textin c_oldmobile"
                               onafterpaste="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               onkeyup="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               id="oldmobile" name="oldmobile"></li>
                    <li>
                        <div class="name">新手机号</div>
                        <input type="text" class="textin c_newmobile"
                               onafterpaste="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               onkeyup="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               id="newmobile" name="newmobile"></li>
                    <li>
                        <div class="name">验证码</div>
                        <input type="text" class="textin1 c_tbcode"
                               onafterpaste="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               onkeyup="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                               name="tbcode">
                        <input type="submit" value="获取验证码" class="fsyzm" id="zphone"
                               onClick="get_mobile_code();return false;"></li>
                </ul>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认"></div>
        <div id="fade5" class="black_overlay"></div>
    </form>
    <!--绑定QQ-->
    <form id="winform6" name="winform6" onSubmit="return edituserqq(this)">
        <div id="light6" class="white_content zhsq">
            <div class="title"><i class="bdqqicon"></i><span>绑定QQ</span> <a href="javascript:void(0)" class="close"
                                                                            onclick="close_win6()"> </a></div>
            <div class="summary">
                <div class="bdxm">
                    <div class="name">您的QQ</div>
                    <input type="text" class="textin c_qq" name="qq"></div>
                <div class="tips" style="height:34px;line-height:34px;margin-bottom:51px;">QQ绑定后将不能自行修改</div>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认修改"></div>
        <div id="fade6" class="black_overlay"></div>
    </form>
    <!--添加账户银行卡-->
    <form d="winform7" name="winform7" onSubmit="return editbankcard(this)">
        <div id="light7" class="white_content zhsq">
            <div class="title"><i class="tjzhicon"></i><span>添加账户</span> <a href="javascript:void(0)" class="close"
                                                                            onclick="close_win7()"> </a></div>
            <div class="summary">
                <div class="slideTxtBox">
                    <div class="hd">
                        <div class="zhlxtit">账户类型</div>
                        <ul>
                            <li>
                                <label>
                                    <input type="radio" name="banktype" checked="checked" value="2">
                                    <span>银行卡</span></label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="banktype" value="1"> <span>支付宝</span></label>
                            </li>
                        </ul>
                        <div class="clear"></div>
                        <div class="hzname">户主姓名</div>
                        <span id="sp_hzname" class="hzname1">谭志立</span></div>
                    <div class="bd">
                        <ul class="passwordlist" style="margin-top:0px;padding-bottom:30px;">
                            <li class="clearfix">
                                <div class="name">选择银行</div>
                                <div class="xzyh clearfix">
                                    <div class="select">
                                        <select id="rid11" style="display: none" name="bankname">
                                            <option value="" selected="selected">- 请选择 -</option>
                                            <option value="00001:工商银行">工商银行</option>
                                            <option value="00002:建设银行">建设银行</option>
                                            <option value="00003:招商银行">招商银行</option>
                                            <option value="00004:交通银行">交通银行</option>
                                            <option value="00005:中信银行">中信银行</option>
                                            <option value="00006:民生银行">民生银行</option>
                                            <option value="00007:兴业银行">兴业银行</option>
                                            <option value="00008:农业银行">农业银行</option>
                                            <option value="00009:华夏银行">华夏银行</option>
                                            <option value="00010:北京银行">北京银行</option>
                                            <option value="00011:中国邮政">中国邮政</option>
                                            <option value="00012:南京银行">南京银行</option>
                                            <option value="00013:中国银行">中国银行</option>
                                            <option value="00014:上海银行">上海银行</option>
                                            <option value="00015:宁波银行">宁波银行</option>
                                            <option value="00016:浙商银行">浙商银行</option>
                                            <option value="00017:平安银行">平安银行</option>
                                            <option value="00018:渤海银行">渤海银行</option>
                                            <option value="00019:上海浦东发展银行">上海浦东发展银行</option>
                                            <option value="00020:北京农村商业银行">北京农村商业银行</option>
                                            <option value="00021:广东发展银行">广东发展银行</option>
                                        </select>
                                    </div>
                                    <script type="text/javascript">
                                        jQuery(document).ready(function () {
                                            jQuery("#rid11").selectbox();
                                        });
                                    </script>
                                </div>
                            </li>
                            <li>
                                <div class="name">开户地址</div>
                                <div class="khdznew">
                                    <select id="rid22" class="mr10" name="bankadd1" onchange="changePre();">
                                        <option value="" selected="selected">- 请选择 -</option>
                                        <option>北京市</option>
                                        <option>上海市</option>
                                        <option>天津市</option>
                                        <option>重庆市</option>
                                        <option>河北省</option>
                                        <option>山西省</option>
                                        <option>内蒙古自治区</option>
                                        <option>辽宁省</option>
                                        <option>吉林省</option>
                                        <option>黑龙江省</option>
                                        <option>江苏省</option>
                                        <option>浙江省</option>
                                        <option>安徽省</option>
                                        <option>福建省</option>
                                        <option>江西省</option>
                                        <option>山东省</option>
                                        <option>河南省</option>
                                        <option>湖北省</option>
                                        <option>湖南省</option>
                                        <option>广东省</option>
                                        <option>广西壮族自治区</option>
                                        <option>海南省</option>
                                        <option>四川省</option>
                                        <option>贵州省</option>
                                        <option>云南省</option>
                                        <option>西藏自治区</option>
                                        <option>陕西省</option>
                                        <option>甘肃省</option>
                                        <option>宁夏回族自治区</option>
                                        <option>青海省</option>
                                        <option>新疆维吾尔族</option>
                                        <option>香港特别行政区</option>
                                        <option>澳门特别行政区</option>
                                        <option>台湾省</option>
                                        <option>其它</option>
                                    </select>
                                    <select id="rid33" class="city" name="bankadd2">
                                        <option value="" selected="selected">- 请选择 -</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="name">银行卡号</div>
                                <input type="text"
                                       onafterpaste="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                                       onkeyup="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                                       class="textin c_userbankcard" name="userbankcard" placeholder="请输入本人的银行卡号"></li>
                            <li>
                                <div class="name">确认卡号</div>
                                <input type="text"
                                       onafterpaste="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                                       onkeyup="if(this.value.length==1){this.value=this.value.replace(/\D/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                                       class="textin c_rebankcard" name="rebankcard" placeholder="请重复输入银行卡号"></li>
                            <li>
                                <div class="name">资金密码</div>
                                <input type="password" class="textin c_passmoney2" name="passmoney2"
                                       placeholder="请输入交易密码"></li>
                        </ul>
                        <ul class="passwordlist" style="margin-top:0px;padding-bottom:30px;">
                            <li style="margin-top:0px;">
                                <div class="name">支付宝账号</div>
                                <input type="text" class="textin c_alipay" name="alipay" placeholder="请输入本人支付宝账号"></li>
                            <li>
                                <div class="name">确认账号</div>
                                <input type="text" class="textin c_realipay" name="realipay" placeholder="请重复输入支付宝账号">
                            </li>
                            <li>
                                <div class="name">资金密码</div>
                                <input type="password" class="textin c_passmoney1" name="passmoney1"
                                       placeholder="请输入交易密码"></li>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(".slideTxtBox").slide({trigger: "click"});
                </script>
            </div>
            <input type="submit" class="queren" name="bnt" value="确认绑定"></div>
        <div id="fade7" class="black_overlay"></div>
    </form>
    <script src="{{ asset('js/online.js') }}"></script>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/anquan.js') }}"></script>

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

@endpush