@extends('layouts.app')




@push('css')
    <link href="/themes/simplebootx/Public/css/center.css?v1.2" rel="stylesheet" type="text/css"/>
    <script src="/themes/simplebootx/Public/js/base.js"></script>
    <script src="/public/js/base.js" type="text/javascript"></script>

    <style>
        .inputrecharge {
            margin-top: 15px;
            position: relative;
        }

        .inputrecharge i {
            display: block;
            position: absolute;
            right: -15px;
            top: 14px;
            font-size: 16px;
        }

        .inputrecharge input[name=fee] {
            width: 260px;
            height: 45px;
            padding: 0 10px;
            line-height: 45px;
            font-size: 16px;
        }

        .inputrecharge .doscanpay {
            width: 285px;
            outline: none;
            height: 45px;
            line-height: 45px;
            background: rgb(3, 92, 175);
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 3px;
            margin-top: 30px;
        }

        .inputrecharge .doscanpay:disabled,
        .bankpay:disabled {
            background: #999;
        }

        .showpaymsg {
            display: none;
        }

        .showpaymsg dl {
            padding: 15px 0;
        }

        .showpaymsg dl dt {
            height: 35px;
            line-height: 35px;
        }

        .showpaymsg dl dt i,
        .showpaymsg dl dt em {
            display: block;
            float: left;
            font-size: 16px;
        }

        .showpaymsg dl dt i {
            width: 35%;
            text-align: right;
            color: #666;
        }

        .showpaymsg dl dt em {
            width: 64%;
            margin-left: 1%;
        }

        .showpaymsg dl dt em.fee {
            color: red;
        }
    </style>
@endpush


@push('init-scripts')
    <script src="/public/dialog/jquery.artDialog.js?skin=default" language="javascript"></script>

@endpush



@section('main')
    <div class="banner_cz">
        <div class="w1000"><a href="{{ route('account.recharge') }}" class="czzx"><span class="tit">充值中心</span><span
                        class="en">Voucher Center</span></a></div>
    </div>
    <div class="main ovf ">
        <div class="w1000">
            <div class="cz19 mt30">
                <div class="notice">
                    <div class="tab-hd">
                        <ul>
                            {{--<li class="on">支付宝支付</li>--}}
                            {{--<li class="">微信支付</li>--}}
                            {{--<li class="">财富通支付</li>--}}
                            {{--<li>网银支付</li>--}}
                            <li class="">转账支付</li>
                        </ul>
                    </div>
                    <div class="tab-bd">
                        {{--<div class="tab-pal">
                            <div class="zfbzf">
                                <!-- 支付宝扫码线上支付start -->
                                <!-- 支付宝扫码线上支付end -->
                                <div class="title" style="margin:0"><i class="zfbicon"></i>支付宝充值账户(<span
                                            style="font-size:20px; color:red;">单笔最高3万</span>)
                                </div>
                                <div class="yxuid">
                                    <div class="email" style="width:auto; margin-left:84px;">暂无支付<span class="name">&nbsp;&nbsp;&nbsp;暂无支付</span>
                                    </div>
                                    <div class="tips"> 请在转账附言中填写您的UID，您的UID是：9016</div>
                                </div>
                                <div class="zfbimg"><img src="/themes/simplebootx/Public/images/zfbimg.png" alt="">
                                </div>
                                <div class="zfbline"></div>
                                <div class="wx_tips">
                                    <div class="ts_tit">温馨提示：</div>
                                    <p> 1. 请使用支付宝充值所需金额至以上账户，转账成功后将自动到账；
                                        <br> 2. 生成支付二维码之后请使用微信扫一扫功能进行扫码支付，支付成功后将自动到账；
                                        <br> 3. 使用转账方式充值，请在转账附言中填写您的UID，否则无法自动入账；
                                        <br> 4. 充值额度最低为50元；
                                        <br> 5. 如果您无法使用支付宝充值，请选择其他充值方式。</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pal">
                            <div class="wxzc">
                                <!-- 微信扫码线上支付start -->
                                <div class="wxzzcz scanblock">
                                    <div class="title"><i class="wxicon1"></i>微信扫码在线支付</div>
                                    <div class="wxzzcz_nr">
                                        <div class="imgbox"><img src="/public/images/create_scan.png" class="qrcodesrc"
                                                                 style="width:160px;" alt=""></div>
                                        <div class="sys" style="margin-top:25px;">
                                            <div class="showpaymsg">
                                                <div class="sys_bg">请使用微信扫一扫功能
                                                    <br/> 完成支付
                                                </div>
                                                <div class="clear"></div>
                                                <dl>
                                                    <dt><i>订 单 号：</i><em class="orderno">--</em></dt>
                                                    <dt><i>充值金额：</i><em class="fee">--</em></dt>
                                                    <dt>
                                                        <p>* 如果在线充值超时未到账，请联系客服</p>
                                                    </dt>
                                                </dl>
                                            </div>
                                            <div class="inputrecharge">
                                                <form id="wxscan">
                                                    <input type="hidden" name="pt" value="1"/>
                                                    <input type="text" maxlength="9" class="checknum" name="fee"
                                                           placeholder="请输入充值金额"/> <i>元</i>
                                                    <button type="button" class="doscanpay">获取支付码</button>
                                                </form>
                                            </div>
                                            <!--p style="font-size:14px">请在转账附言中填写您的UID，您的UID是：9016</p-->
                                        </div>
                                    </div>
                                </div>
                                <!-- 微信扫码线上支付end -->
                                <div class="wxzzcz">
                                    <div class="title"><i class="wxicon1"></i>微信转账</div>
                                    <div class="yxuid">
                                        <div class="email" style="width:auto; margin-left:84px;">微信名字：情缘<span
                                                    class="name">&nbsp;&nbsp;&nbsp;微信账号：xw535266</span>
                                        </div>
                                        <div class="tips"> 因微信更换频繁，每次转账前请核对上分账号，请在转账附言中填写您的UID，您的UID是：9016</div>
                                    </div>
                                </div>
                            </div>
                            <div class="wx_tips">
                                <div class="ts_tit">温馨提示：</div>
                                <p> 1. 微信转账充值后，需要正确备注您的UID，收款后将自动到账；
                                    <br> 2. 生成支付二维码之后请使用微信扫一扫功能进行扫码支付，支付成功后将自动到账；
                                    <br> 3. 二维码过期后请重新生成二维码，否则将充值失败；
                                    <br> 4. 充值额度最低为50元；
                                    <br> 5. 如果您不想使用微信充值，请选择其他充值方式。</p>
                            </div>
                        </div>
                        <div class="tab-pal">
                            <div class="zfbzf">
                                <!-- QQ钱包扫码线上支付start -->
                                <div class="wxzzcz scanblock">
                                    <div class="title"><i class="qqbag"></i>QQ钱包扫码在线支付</div>
                                    <div class="wxzzcz_nr">
                                        <div class="imgbox"><img src="/public/images/create_scan.png" class="qrcodesrc"
                                                                 style="width:160px;" alt=""></div>
                                        <div class="sys" style="margin-top:25px;">
                                            <div class="showpaymsg">
                                                <div class="sys_bg">请使用QQ扫一扫功能
                                                    <br/> 完成支付
                                                </div>
                                                <div class="clear"></div>
                                                <dl>
                                                    <dt><i>订 单 号：</i><em class="orderno">--</em></dt>
                                                    <dt><i>充值金额：</i><em class="fee">--</em></dt>
                                                    <dt>
                                                        <p>* 如果在线充值超时未到账，请联系客服</p>
                                                    </dt>
                                                </dl>
                                            </div>
                                            <div class="inputrecharge">
                                                <form id="wxscan">
                                                    <input type="hidden" name="pt" value="2"/>
                                                    <input type="text" maxlength="9" class="checknum" name="fee"
                                                           placeholder="请输入充值金额"/> <i>元</i>
                                                    <button type="button" class="doscanpay">获取支付码</button>
                                                </form>
                                            </div>
                                            <!--p style="font-size:14px">因微信更换频繁，每次转账前请核对上分账号，请在转账附言中填写您的UID，您的UID是：9016</p-->
                                        </div>
                                    </div>
                                </div>
                                <!-- QQ钱包扫码线上支付end -->
                                <div class="title" style="margin:0">财付通转账</div>
                                <div class="yxuid">
                                    <div class="email" style="width:auto; margin-left:84px;">账号：2532211169<span
                                                class="name"> &nbsp;&nbsp;&nbsp;&nbsp; 姓名：ng</span></div>
                                    <div class="tips"> 请在转账附言中填写您的UID，您的UID是：9016</div>
                                </div>
                                <div class="wx_tips">
                                    <div class="ts_tit">温馨提示：</div>
                                    <p> 1. 请使用财富通充值所需金额至以上账户，转账成功后将自动到账；
                                        <br> 2. 生成支付二维码之后请使用微信扫一扫功能进行扫码支付，支付成功后将自动到账；
                                        <br> 3. 请在转账附言中填写您的UID，否则无法自动入账；
                                        <br> 4. 充值额度最低为50元；
                                        <br> 5. 如果您无法使用财富通充值，请选择其他充值方式。</p>
                                </div>
                            </div>
                        </div>
                        <form id="bankpaydata" action="http://pay.taochawang.cc/index/bankpay"
                              _action="/user/profile/bankpay.html" method="post">
                            <input type="hidden" name="orderno" value=""/>
                            <div class="tab-pal">
                                <div class="wyzf">
                                    <div class="title" style="margin:0"><i class="wyzficon1"></i>网银在线充值</div>
                                    <div class="wxzxcz_nr"><span>请输入充值金额</span>
                                        <input type="text" class="je checknum" name="fee" maxlength="10" value="50">
                                        <input type="button" class="sc bankpay" value="跳转至网银充值"></div>
                                    <div class="wx_tips">
                                        <div class="ts_tit">温馨提示：</div>
                                        <p>1. 输入充值金额之后点击跳转到网银支付页面，按照流程支付成功后将自动到账；
                                            <br/> 2. 充值额度最低为50元；
                                            <br/> 3. 如果您无法使用网银充值，请选择其他充值方式。</p>
                                    </div>
                                </div>
                            </div>
                        </form>--}}
                        <div class="tab-pal">
                            <div class="yhkzz">


                                @foreach($accounts as $account)

                                <div class="title">{{ $account->way }}</div>
                                <div class="nr">
                                    <div class="zh">{{ $account->number }}</div>
                                    <div class="name">{{ $account->name }}</div>

                                    <div class="clear"></div>
                                    <div class="jetips">{{ $account->tips }}</div>
                                </div>
                                @endforeach

                                <div class="wx_tips">
                                    <div class="ts_tit">温馨提示：</div>
                                    <p>1. 请使用支付宝，ATM机，银行柜台等转账所需充值金额至以上账户，转账成功后将自动到账；
                                        <br> 2. 请在转账附言中填写您的uid，否则无法自动入账；
                                        <br> 3. 充值额度最低为50元；
                                        <br> 4. 如果您无法使用银行卡，请选择其他充值方式。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="/themes/simplebootx/Public/js/pay.js?v1"></script>
    <script>
        $(function () {
            //验证数字类型
            $('.checknum').keyup(function () {
                var value = $(this).val();
                $(this).val(value.replace(/[^\d]/g, ''));
            }).blur(function () {
                var value = $(this).val();
                if (Number(value) < 50)
                    $(this).val(50);
            });

            $('.doscanpay').click(function () {
                var $this = $(this);
                var form = $this.parents('form');
                var block = $this.parents('.wxzzcz_nr');
                var fee = form.find('input[name=fee]').val();
                if (fee == '') {
                    $.message({type: "error", content: "请输入充值金额", time: 3000});
                    return false;
                }
                $this.attr('disabled', true).text('正在获取支付码...');
                $.post('/user/profile/loadqrcode.html', form.serialize(), function (text) {
                    if (text.status == 1) {
                        block.find('.qrcodesrc').attr("src", "http://pan.baidu.com/share/qrcode?w=160&h=160&url=" + text.url);
                        block.find('.inputrecharge').hide();
                        block.find('.orderno').text(text.orderno);
                        block.find('.fee').text(text.fee + '元');
                        block.find('.showpaymsg').show();
                        waitwxnotify(block);
                        $this.text('等待支付');
                    } else {
                        $this.attr('disabled', false).text('获取支付码');
                        $.message({type: "error", content: text.info, time: 3000});
                    }
                })
            })

            $('.bankpay').click(function () {
                var form = $('#bankpaydata');
                if (form.find('input[name=fee]').val() == '') {
                    $.message({type: "error", content: "请输入充值金额", time: 3000});
                    return false;
                }
                $('.bankpay').attr('disabled', true).val('正在创建订单...');
                $.post(form.attr('_action'), form.serialize(), function (text) {
                    if (text.status == 1) {
                        form.find('input[name=orderno]').val(text.orderno);
                        form.submit();
                    } else {
                        $.message({type: "error", content: text.info, time: 3000});
                        $('.bankpay').attr('disabled', false).val('跳转至网银充值');
                    }
                })
            })
        })

        //查询回调
        function waitwxnotify(obj) {
            var interval = setInterval(function () {
                $.get("/user/profile/waitwxnotify.html", {orderno: obj.find('.orderno').text()}, function (text) {
                    if (text.status == 1) {
                        clearInterval(interval);
                        obj.find('.doscanpay').text('支付成功');
                        $.message({content: "充值成功"});
                        setTimeout(function () {
                            location.href = "/user/center/index.html";
                        }, 1000);
                    }
                })
            }, 3000);
        }
    </script>
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