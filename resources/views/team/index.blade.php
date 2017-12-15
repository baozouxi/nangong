@extends('layouts.app')



@push('css')
    <link href="/public/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/css/css.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/css/center.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/agent/user.css" rel="stylesheet" type="text/css"/>
    <link href="/themes/simplebootx/Public/agent/proxy.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/agent/style.css?v=1"/>
    <link type="text/css" rel="stylesheet" href="/themes/simplebootx/Public/agent/laydate.css">
@endpush
@push('init-scripts')
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/event.js?1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/msgbox.js?1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/public/js/base.js" type="text/javascript"></script>
    <script src="/themes/simplebootx/Public/js/base.js"></script>
@endpush

@section('main')
    <div class="banner_hyzx">
        <div class="w1000">
            <div class="uesr">
                <div class="imgbox"><a href="index.html"><img src="/themes/simplebootx/Public/images/user.png"
                                                              alt=""></a>
                </div>
                <div class="name_box">
                    <div class="name"><span>baozouxi</span>
                        <div class="uid">uid：9016</div>
                    </div>
                    <div class="time">上次登录时间：2017-12-15 16:02:09</div>
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
                <div class="sidewrap merge-footer">
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
                            <!-- start -->
                            <div class="ui-tab statistical">
                                <div class="ui-tab-title tab-title-bg clearfix" id="J-chart-tab">
                                    <ul id="getDayBound">
                                        <li pro-day="0" class="current">今天</li>
                                        <li pro-day="-1" class="">昨天</li>
                                        <li pro-day="-6" class="">最近7天</li>
                                    </ul>
                                    <div class="calendar">
                                        <input onselectstart="return false;" type="text" value="" id="J-input-start"
                                               class="ip-text"> -
                                        <input onselectstart="return false;" type="text" value="" id="J-input-end"
                                               class="ip-text"> &nbsp; <a id="J-button-submit" class="btn"
                                                                          href="index.html#">查 询</a></div>
                                </div>
                                <div class="ui-tab-content ui-tab-content-current">
                                    <div class="statistical-data">
                                        <ul>
                                            <li>投注金额<span id="J-data-nums-buy">0.00</span></li>
                                            <li>充值金额<span id="J-data-nums-load">0.00</span></li>
                                            <li>提现金额<span id="J-data-nums-withdraw">0.00</span></li>
                                            <li>新增用户数<span id="J-data-nums-newMem">0</span></li>
                                            <li>返点金额<span id="J-data-nums-rebates">0.00</span></li>
                                        </ul>
                                    </div>
                                    <div class="statistical-radio" id="J-cont-filter" prodata="0">
                                        <label for="J-r1">
                                            <input type="radio" name="ra_group1" value="0" class="radio sta-radio"
                                                   id="J-r1"
                                                   checked="checked"> 提现量</label>
                                        <label for="J-r2">
                                            <input type="radio" name="ra_group1" value="1" class="radio sta-radio"
                                                   id="J-r2"> 充值量</label>
                                        <label for="J-r3">
                                            <input type="radio" name="ra_group1" value="2" class="radio sta-radio"
                                                   id="J-r3"> 投注量</label>
                                        <label for="J-r4">
                                            <input type="radio" name="ra_group1" value="3" class="radio sta-radio"
                                                   id="J-r4"> 返点</label>
                                        <label for="J-r5">
                                            <input type="radio" name="ra_group1" value="4" class="radio sta-radio"
                                                   id="J-r5"> 新增用户数</label>
                                        <!-- <span>节假日</span> --></div>
                                    <div class="statistical-graph" id="J-chart-cont"></div>
                                    <table class="table table-info" id="J-table"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>

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
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/jquery.flot.js?v=1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/jquery.flot.crosshair.js?v=1.1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/jquery.tmpl.min.js?v1"></script>
    <script type="text/javascript" src="/themes/simplebootx/Public/agent/laydate.js?v=2"></script>
    <script>
        $(".navlist li a:eq(4)").addClass("current");
        var E = $.myAjax,
            tmp, msgbox = layer,
            DayRange = new Array(0, -1, -6),
            startTime = $('#J-input-start'),
            endTime = $('#J-input-end'),
            cacheDatas, allcaches = {};

        laydate({
            elem: '#J-input-start',
            format: 'YYYY-MM-DD',
            min: laydate.now(-6),
            max: laydate.now(0),
            istime: false
        });
        laydate({
            elem: '#J-input-end',
            format: 'YYYY-MM-DD',
            min: laydate.now(-6),
            max: laydate.now(0),
            istime: false
        });
        startTime.val(laydate.now(0));
        endTime.val(laydate.now(0));

        var plot, tip, chartCont = $('#J-chart-cont'),
            //图表参数
            chartOptions = {
                lines: {
                    show: true,
                    lineWidth: 2
                },
                colors: ["#009ED0"],
                points: {
                    show: true
                },
                xaxis: {
                    tickDecimals: 0,
                    color: '#EEE',
                    tickSize: 1,
                    fontSize: 12
                },
                yaxis: {
                    color: '#EEE'
                },
                crosshair: {
                    mode: "x",
                    color: '#CCCCCC'
                },
                grid: {
                    borderWidth: 1,
                    color: '#D9D9D9',
                    hoverable: true,
                    autoHighlight: true
                },
                legend: {
                    color: '#000'
                }
            },
            //年月日
            time_now,
            _arrDate = $.trim($('#J-data-now').val()).split(/[^\d]/),
            dateUtil = {},
            time_y = Number(_arrDate[0]),
            time_m = Number(_arrDate[1]),
            time_d = Number(_arrDate[2]),
            time_h = Number(_arrDate[3]),
            time_s = Number(_arrDate[4]);

        time_now = new Date();
        time_now.setFullYear(time_y);
        time_now.setMonth(time_m - 1);
        time_now.setDate(time_d);
        time_now.setHours(time_h);
        time_now.setMinutes(time_s);

        dateUtil = {
            now: time_now,
            //获取当前日期前后n秒的日期
            getOneDateTime: function (now, n) {
                var now_ms = now.getTime(),
                    n = n || 0,
                    d_n = now_ms + n * 1000,
                    d2 = new Date();
                d2.setTime(d_n)
                return d2;
            },
            getYestodayBound: function () {
                var me = this,
                    now = me.now,
                    result = [],
                    d = new Date();
                d.setFullYear(now.getFullYear());
                d.setMonth(now.getMonth());
                d.setDate(now.getDate() - 1);
                result.push(me.formatDateToString(d, true));
                result.push(me.formatDateToString(d, false));
                return result;
            },
            getTodayBound: function () {
                var me = this,
                    now = me.now,
                    result = [],
                    d = new Date();
                d.setFullYear(now.getFullYear());
                d.setMonth(now.getMonth());
                d.setDate(now.getDate());
                result.push(me.formatDateToString(d, true));
                result.push(now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate());
                return result;
            },
            //前一周时间
            //7天前的 00:01 + 今天已过的时间
            //今天当成1天计算
            getBeforeWeekBound: function () {
                var me = this,
                    now = me.now,
                    result = [],
                    d = new Date();
                d.setFullYear(now.getFullYear());
                d.setMonth(now.getMonth());
                d.setDate(now.getDate() - 6);
                result.push(me.formatDateToString(d, true));
                result.push(now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate());
                return result;
            },
            formatDateToString: function (d, isFirst) {
                var str = isFirst ? '00:01' : '23:59';
                return d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
            }
        };

        function drawtable() {
            var type = parseInt($('#J-cont-filter input:checked').val()),
                types = ['draw', 'charge', 'bet', 'point', 'user'],
                lastX, model = dateUtil.model;
            chartCont.html('');
            typeUnit = type == 4 ? ' 人' : ' 元';
            typeText = $('#J-r' + (type + 1)).parent().text();
            plot = $.plot(chartCont, [{data: cacheDatas[types[type]], label: '&nbsp;' + typeText}], chartOptions);
            if (tip) {
                tip.remove();
            }
            tip = $('<div class="chart-tip"><span></span><div></div><div></div></div>').appendTo(document.body);
            tipDivs = tip.find('div');
            tip.css({
                top: chartCont.offset().top + 8,
                left: chartCont.offset().left
            });
            chartCont.bind('plothover', function (e, pos, it) {
                var lineData = plot.getData()[0]['data'],
                    i = 0,
                    len = lineData.length,
                    num = Math.round(pos.x),
                    addx = !!document.all ? 0 : 1,
                    dateArr, date;
                if (lastX != num) {
                    tip.show();
                    for (; i < len; i++) {
                        if (lineData[i][0] == num) {
                            tip.css('left', pos.pageX + addx + 8);
                            if (model == 'h') {
                                tipDivs[0].innerHTML = '时间：' + (num < 10 ? '0' + num + ':00' : num + ':00');
                            } else {
                                dateArr = $('#J-input-start').val().split(/[^\d]/);
                                date = new Date(Number(dateArr[0]), Number(dateArr[1]) - 1, Number(dateArr[2]));
                                date.setDate(date.getDate() + num);
                                tipDivs[0].innerHTML = '日期：' + date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                            }
                            tipDivs[1].innerHTML = typeText + ': ' + lineData[i][1] + typeUnit;
                        }
                    }
                }
                if (pos.x < 0 || pos.x > plot.getData()[0]['xaxis']['max'] || pos.y < 0 || pos.y > plot.getData()[0]['yaxis']['max']) {
                    tip.hide();
                }
            });
        }

        E.get('loadtotal', {url: '{{ route('team.loadTotalData') }}'}).bind(function (data) {
            allcaches[('t' + data.sTime + '_' + data.eTime).replace(/[-]/g, '')] = data;
            for (var i = 0; i < data.datas.length; ++i) {
                data.datas[i][1] = parseFloat(data.datas[i][1]).toFixed(2);
            }
            var total = data['total'],
                fields = ['withdraw', 'load', 'buy', 'rebates', 'newMem'],
                table = $('#J-table'),
                type, typeText, typeUnit, lineData, tipDivs, lastX;
            $.each(fields, function (index, el) {
                $('#J-data-nums-' + el).html(total[el]);
            });
            cacheDatas = data.datas;
            dateUtil.model = data.model;
            drawtable();
        });

        function LoadPlot() {
            var sTime = $('#J-input-start').val(),
                eTime = $('#J-input-end').val(),
                n;
            n = ('t' + sTime + '_' + eTime).replace(/[-]/g, '');
            if (allcaches[n]) {
                E.get('loadtotal').fire(allcaches[n]);
            } else {
                chartCont.html('<div style="text-align:center;height:300px;line-height:300px;">数据加载中...</div>');
                E.get('loadtotal').load({data: {'timestart': sTime, 'timeend': eTime}});
            }
        }

        $('#J-button-submit').click(function (e) {
            e.preventDefault();
            LoadPlot();
        });

        $('.sta-radio').click(function (event) {
            if ($(this).val() != $('#J-cont-filter').attr('prodata')) {
                $('#J-cont-filter').attr('prodata', $(this).val());
                drawtable();
            }
        });
        $('#getDayBound li').click(function (event) {
            if ($(this).hasClass('current')) {
                return false;
            } else {
                var tmp;
                $('#getDayBound .current').removeClass('current');
                $(this).addClass('current');
                var v = $(this).attr('pro-day');
                $('#J-input-start').val(laydate.now(v));
                if (v == '-1') {
                    $('#J-input-end').val(laydate.now(v));
                } else {
                    $('#J-input-end').val(laydate.now(0));
                }
                LoadPlot();
            }
        });

        LoadPlot();

        function formatMoney(num) {
            num = num.toString();
            if (num == '') {
                num = '0';
            }
            var num = num.replace(/,/g, ''),
                num = parseFloat(num),
                re = /(-?\d+)(\d{3})/;
            if (Number.prototype.toFixed) {
                num = (num).toFixed(2);
            } else {
                num = Math.round(num * 100) / 100;
            }
            num = '' + num;
            while (re.test(num)) {
                num = num.replace(re, "$1,$2");
            }
            return num;
        };
    </script>

@endpush