var isStop=0;
var expect_list_10;

$(function(){
	$("#jk-z i").click(function(){
		var obj = $(this);
		var c = obj.attr("class");
		if (c == "on") {
			addBetDefaultMoney();
		} else {
			$("#jk-z i").removeClass("on");
			obj.addClass("on");
			betsDefaultMoney = obj.attr("rel");
		}
	});
});
function addBetDefaultMoney() {
	var obj = $("#betall input");
	for (var i=0; i<obj.length; i++) {
		var v = parseInt(obj[i].value);
		if (v<=betsDefaultMoney*8 && v>betsDefaultMoney/10*9) {
			obj[i].value = v+parseInt(betsDefaultMoney);
		}
	}
}
//============================投注 begin
function submitOK(){
	$("#subform").submit();
}

function freset(){
    $("#tp999").val("");
	for(var i=0;i<=27;i++){
		if(i<=9){
			$("#tyl0"+i).removeClass("selectcss");
			$("#del0"+i).remove();
		}else{
			$("#tyl"+i).removeClass("selectcss");
			$("#del"+i).remove();
		}
	}
	for(var j=101;j<=110;j++){
			$("#tyl"+j).removeClass("selectcss");
			$("#del"+j).remove();
	}
	
}

var betsDefaultMoney = 10;
function showbetdata(t0){
	var showstr="";	
	var showclass="";
	var p_class = $("#tyl"+t0).attr("class"); 
	if(p_class){
		$("#tyl"+t0).removeClass("selectcss");
		$("#del"+t0).remove();
	}else{
		$("#tyl"+t0).addClass("selectcss");
		if(parseInt(t0)<101){
			$("#betall").append('<li id="del'+t0+'"><a href="javascript:showbetdata(\''+t0+'\');">'+t0+'</a><input type="text" name="tp'+t0+'" onblur="onlynum10(this)" onkeyup="onlynum(this);" value="'+betsDefaultMoney+'"></li>');
		}else{
			switch (parseInt(t0)){
				case 101:
					showstr="小";
					break;
				case 102:
					showstr="大";
					break;
				case 103:
					showstr="单";
					break;
				case 104:
					showstr="双";
					break;
				case 105:
					showstr="小单";
					showclass="jx";
					break;
				case 106:
					showstr="大单";
					showclass="jx";
					break;
				case 107:
					showstr="小双";
					showclass="jx";
					break;
				case 108:
					showstr="大双";
					showclass="jx";
					break;
				case 109:
					showstr="极小";
					showclass="jx";
					break;
				case 110:
					showstr="极大";
					showclass="jx";
					break;
			}
			
			$("#betall").append('<li id="del'+t0+'" class="'+showclass+'"><a href="javascript:showbetdata(\''+t0+'\');">'+showstr+'</a><input type="text" name="tp'+t0+'" onblur="onlynum10(this)" onkeyup="onlynum(this);" value="'+betsDefaultMoney+'"></li>');
		}
	}
	
}

//猜数
function submitOKtp999(){
    var tp999="";
    tp999=$("#tp999").val();
    if(tp999==""){
        $.message({type:"error",content:"请输入0-27之间的数字",time:1200});
        return false;
    }
    var url,data;
    url="/user/canada/game28_buy20_999";
    data="tp999="+encodeURIComponent($.trim(tp999));

    $.ajax({
        type:"post",
        cache:false,
        datatype: "json",
        url:url,
        data:data,
        error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
        success:function(data)
        {
            switch(data.status)
            {
                case 0:
                    $.message({type:"error",content:data.info,time:3000});
                    //freset();
                    $("#tp999").val('');
                    break;
                case 1:
                    $.message({type:"ok",content:data.info,time:3000});
                    freset();
                    shownotbet();
                    getBetsListCircle();
                    getUserBetsListToday();
                    break;
            }

        }});
    return false
}

//投注
var xztf=true;
function checkdb(the)
{
	//alert(1);
	//return false;
	if(xztf==false){
		return false;
	}
	xztf=false;
	var tp100="";
	var i;
	
	if(the.tp00){if(tp100==""){tp100="0*"+the.tp00.value;}else{tp100=tp100 + ",0*" + the.tp00.value;}}
	if(the.tp01){if(tp100==""){tp100="1*"+the.tp01.value;}else{tp100=tp100 + ",1*" + the.tp01.value;}}
	if(the.tp02){if(tp100==""){tp100="2*"+the.tp02.value;}else{tp100=tp100 + ",2*" + the.tp02.value;}}
	if(the.tp03){if(tp100==""){tp100="3*"+the.tp03.value;}else{tp100=tp100 + ",3*" + the.tp03.value;}}
	if(the.tp04){if(tp100==""){tp100="4*"+the.tp04.value;}else{tp100=tp100 + ",4*" + the.tp04.value;}}
	if(the.tp05){if(tp100==""){tp100="5*"+the.tp05.value;}else{tp100=tp100 + ",5*" + the.tp05.value;}}
	if(the.tp06){if(tp100==""){tp100="6*"+the.tp06.value;}else{tp100=tp100 + ",6*" + the.tp06.value;}}
	if(the.tp07){if(tp100==""){tp100="7*"+the.tp07.value;}else{tp100=tp100 + ",7*" + the.tp07.value;}}
	if(the.tp08){if(tp100==""){tp100="8*"+the.tp08.value;}else{tp100=tp100 + ",8*" + the.tp08.value;}}
	if(the.tp09){if(tp100==""){tp100="9*"+the.tp09.value;}else{tp100=tp100 + ",9*" + the.tp09.value;}}
	
	if(the.tp10){if(tp100==""){tp100="10*"+the.tp10.value;}else{tp100=tp100 + ",10*" + the.tp10.value;}}
	if(the.tp11){if(tp100==""){tp100="11*"+the.tp11.value;}else{tp100=tp100 + ",11*" + the.tp11.value;}}
	if(the.tp12){if(tp100==""){tp100="12*"+the.tp12.value;}else{tp100=tp100 + ",12*" + the.tp12.value;}}
	if(the.tp13){if(tp100==""){tp100="13*"+the.tp13.value;}else{tp100=tp100 + ",13*" + the.tp13.value;}}
	if(the.tp14){if(tp100==""){tp100="14*"+the.tp14.value;}else{tp100=tp100 + ",14*" + the.tp14.value;}}
	if(the.tp15){if(tp100==""){tp100="15*"+the.tp15.value;}else{tp100=tp100 + ",15*" + the.tp15.value;}}
	if(the.tp16){if(tp100==""){tp100="16*"+the.tp16.value;}else{tp100=tp100 + ",16*" + the.tp16.value;}}
	if(the.tp17){if(tp100==""){tp100="17*"+the.tp17.value;}else{tp100=tp100 + ",17*" + the.tp17.value;}}
	if(the.tp18){if(tp100==""){tp100="18*"+the.tp18.value;}else{tp100=tp100 + ",18*" + the.tp18.value;}}
	if(the.tp19){if(tp100==""){tp100="19*"+the.tp19.value;}else{tp100=tp100 + ",19*" + the.tp19.value;}}
	
	if(the.tp20){if(tp100==""){tp100="20*"+the.tp20.value;}else{tp100=tp100 + ",20*" + the.tp20.value;}}
	if(the.tp21){if(tp100==""){tp100="21*"+the.tp21.value;}else{tp100=tp100 + ",21*" + the.tp21.value;}}
	if(the.tp22){if(tp100==""){tp100="22*"+the.tp22.value;}else{tp100=tp100 + ",22*" + the.tp22.value;}}
	if(the.tp23){if(tp100==""){tp100="23*"+the.tp23.value;}else{tp100=tp100 + ",23*" + the.tp23.value;}}
	if(the.tp24){if(tp100==""){tp100="24*"+the.tp24.value;}else{tp100=tp100 + ",24*" + the.tp24.value;}}
	if(the.tp25){if(tp100==""){tp100="25*"+the.tp25.value;}else{tp100=tp100 + ",25*" + the.tp25.value;}}
	if(the.tp26){if(tp100==""){tp100="26*"+the.tp26.value;}else{tp100=tp100 + ",26*" + the.tp26.value;}}
	if(the.tp27){if(tp100==""){tp100="27*"+the.tp27.value;}else{tp100=tp100 + ",27*" + the.tp27.value;}}

	var tp101="";	var tp102="";	var tp103="";	var tp104="";
	if(the.tp101){
		tp101=the.tp101.value;
	}
	if(the.tp102){
		tp102=the.tp102.value;
	}
	if(the.tp103){
		tp103=the.tp103.value;
	}
	if(the.tp104){
		tp104=the.tp104.value;
	}
	
	var tp105="";	var tp106="";	var tp107="";	var tp108="";	var tp109="";	var tp110="";
	if(the.tp105){
		tp105=the.tp105.value;
	}
	if(the.tp106){
		tp106=the.tp106.value;
	}
	if(the.tp107){
		tp107=the.tp107.value;
	}
	if(the.tp108){
		tp108=the.tp108.value;
	}
	if(the.tp109){
		tp109=the.tp109.value;
	}
	if(the.tp110){
		tp110=the.tp110.value;
	}
	
	//alert(xztf);
	//return false;
	if(tp100==""&&tp101==""&&tp102==""&&tp103==""&&tp104==""&&tp105==""&&tp106==""&&tp107==""&&tp108==""&&tp109==""&&tp110==""){
		$.message({type:"error",content:"请下注A",time:1200});
		xztf=true;
		return false;
	}
	
	var tp999="";
	if(the.tp999){
		tp999=the.tp999.value;
	}
		
	var url,data;
	url="/user/canada/game28_buy20";
	data="tp100="+encodeURIComponent($.trim(tp100));
	data+="&tp101="+encodeURIComponent($.trim(tp101));
	data+="&tp102="+encodeURIComponent($.trim(tp102));
	data+="&tp103="+encodeURIComponent($.trim(tp103));
	data+="&tp104="+encodeURIComponent($.trim(tp104));
	data+="&tp105="+encodeURIComponent($.trim(tp105));
	data+="&tp106="+encodeURIComponent($.trim(tp106));
	data+="&tp107="+encodeURIComponent($.trim(tp107));
	data+="&tp108="+encodeURIComponent($.trim(tp108));
	data+="&tp109="+encodeURIComponent($.trim(tp109));
	data+="&tp110="+encodeURIComponent($.trim(tp110));
	
	data+="&tp999="+encodeURIComponent($.trim(tp999));
	
	
	$.ajax({
	type:"post",
	cache:false,
	url:url,
    datatype: "json",
	data:data,
	error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
	success:function(data)
	{
        switch(data.status)
		{
			case 0:
				xztf=true;
				$.message({type:"error",content:data.msg,time:3000});
				//freset();
				break;
			case 1:
				xztf=true;
				$.message({type:"ok",content:data.msg,time:3000});
				freset();
				shownotbet();
                getUserYingLoss(0);
				getUserBetsListToday();
				break;
			default:
				break;
		}

	}});
	return false
}



//主程序
function bwmain(){
	//倒计时
    getUserYingLoss();
	loadopentime();
    getBetsListCircle();
	getUserBetsListToday();
}


//获取下注记录
function getUserBetsListToday(){
	$.ajax({
		url: "/user/canada/getUserBetsListToday_20/t/"+Math.random(),
        type: "post",
        data: {
            //"expect": expect
        },
        datatype: "json",
        async: false,
        success: function(dataJson) {

            if (dataJson.sign === "true") {

                var html = "";
                html += '<li class="first">';
                html += '  <div class="ddh">订单号</div>';
                html += '  <div class="xdsj">下单时间</div>';
                html += '  <div class="wf">玩法</div>';
                html += '  <div class="qh">期号</div>';
                html += '  <div class="tzje">投注金额</div>';
                html += '  <div class="jj">奖金</div>';
                html += '  <div class="zt">状态</div>';
                html += '  <div class="qxxz">操作</div>';
                html += '</li>';

                $.each(dataJson.userbetList, function(idx, val) {
                    html += '<li style="border:none;">';
                    html += '<div class="ddh">' + val.billno + '</div>';
                    html += '<div class="xdsj">' + val.betsTimes + '</div>';
                    html += '<div class="wf">';
                    var ubetname;
                    if (parseInt(val.bettype)<=100) {
                        html += '<div class="ck_num1">';
                        html += '	<div class="quan">' + val.betnum + '</div>';
                        //html += '	<div class="price">' + val.betsMoney + '</div>';
                        html += '</div>';
                    }else if (parseInt(val.bettype)>=101&&parseInt(val.bettype)<=104) {
                        if (parseInt(val.bettype)==101) {ubetname='小';}
                        if (parseInt(val.bettype)==102) {ubetname='大';}
                        if (parseInt(val.bettype)==103) {ubetname='单';}
                        if (parseInt(val.bettype)==104) {ubetname='双';}
                        html += '<div class="ck_num1">';
                        html += '	<div class="quan">' + ubetname + '</div>';
                        //html += '	<div class="price">' + val.betsMoney + '</div>';
                        html += '</div>';
                    }else if (parseInt(val.bettype)>=105&&parseInt(val.bettype)<=110) {
                        if (parseInt(val.bettype)==105) {ubetname='小单';}
                        if (parseInt(val.bettype)==106) {ubetname='大单';}
                        if (parseInt(val.bettype)==107) {ubetname='小双';}
                        if (parseInt(val.bettype)==108) {ubetname='大双';}
                        if (parseInt(val.bettype)==109) {ubetname='极小';}
                        if (parseInt(val.bettype)==110) {ubetname='极大';}
                        html += '<div class="ck_num2">';
                        html += '	<div class="quan">' + ubetname + '</div>';
                        //html += '	<div class="price">' + val.betsMoney + '</div>';
                        html += '</div>';
                    }else if (parseInt(val.bettype)>=999) {
                        if (parseInt(val.bettype)==999) {ubetname='猜数';}
                        html += '<div class="ck_num2">';
                        html += '	<div class="quan">' + val.betnum + '</div>';
                        html += '	<div class="price">' + ubetname + '</div>';
                        html += '</div>';
                    }

                    html += '</div>';
                    var hm = "";
                    if(val.planid>0){
                        hm = "<span style='color: red;'>&nbsp;(合买)</span>";
                    }
                    html += '<div class="qh">' + val.expect+hm + '</div>';
                    html += '<div class="tzje">' + val.betsMoney + '</div>';
                    if(val.prizeMoney>0){
                        html += '<div class="jj"><span style="color: red;">' + val.prizeMoney + '</span></div>';
                    }else{
                        html += '<div class="jj">' + val.prizeMoney + '</div>';
                    }
                    html += '<div class="zt">';
                    if ("0" === val.state) {html += '等待开奖';}
                    if ("1" === val.state) {html += '未中奖';}
                    if ("2" === val.state) {html += '<span style="color: red;">已中奖</span>';}
                    html += '</div>';
                    html += '<div class="qxxz">';
                    if ("0" === val.state) {
                        if(val.planid>0){
                            html += '-';
                        }else{
                            html += '<span onclick="javascript:cancelbet('+val.betid+','+val.expect+');return false;">取消</span>';
                        }
                    }
                    if ("1" === val.state) {html += '-';}
                    if ("2" === val.state) {html += '-';}
                    html += '</div>';
                    html += '</li>';

                });
                //alert(html);
                $("#userBetsListToday").html(html);

            } else {
            }
        },
        error: function() {}
	});
}

//取消所有 -> 标出不允许下注的输入框
function hidenotbet(){

	$("#tyl101").attr("onclick","showbetdata('101');");$("#tyl101").removeClass("notcss");
	$("#tyl102").attr("onclick","showbetdata('102');");$("#tyl102").removeClass("notcss");
	$("#tyl103").attr("onclick","showbetdata('103');");$("#tyl103").removeClass("notcss");
	$("#tyl104").attr("onclick","showbetdata('104');");$("#tyl104").removeClass("notcss");
	$("#tyl105").attr("onclick","showbetdata('105');");$("#tyl105").removeClass("notcss");
	$("#tyl106").attr("onclick","showbetdata('106');");$("#tyl106").removeClass("notcss");
	$("#tyl107").attr("onclick","showbetdata('107');");$("#tyl107").removeClass("notcss");
	$("#tyl108").attr("onclick","showbetdata('108');");$("#tyl108").removeClass("notcss");
    $("#tyl109").attr("onclick","showbetdata('109');");$("#tyl109").removeClass("notcss");
    $("#tyl110").attr("onclick","showbetdata('110');");$("#tyl110").removeClass("notcss");

}

//标出不允许下注的输入框
function shownotbet(){
	$.ajax({
		url: "/user/canada/getCannotBetType_20/t/"+Math.random(),
		type: "post",
		data: {
			//"expect": expect
		},
		datatype: "json",
		async: false,
		success: function(dataJson) {
			if (dataJson.sign === "true") {
				/*写到这里*/
				if (dataJson.tp101 === "true"){$("#tyl101").attr("onclick","javascript:;");$("#tyl101").addClass("notcss");}
				if (dataJson.tp102 === "true"){$("#tyl102").attr("onclick","javascript:;");$("#tyl102").addClass("notcss");}
				if (dataJson.tp103 === "true"){$("#tyl103").attr("onclick","javascript:;");$("#tyl103").addClass("notcss");}
				if (dataJson.tp104 === "true"){$("#tyl104").attr("onclick","javascript:;");$("#tyl104").addClass("notcss");}
				if (dataJson.tp105 === "true"){$("#tyl105").attr("onclick","javascript:;");$("#tyl105").addClass("notcss");}
				if (dataJson.tp106 === "true"){$("#tyl106").attr("onclick","javascript:;");$("#tyl106").addClass("notcss");}
				if (dataJson.tp107 === "true"){$("#tyl107").attr("onclick","javascript:;");$("#tyl107").addClass("notcss");}
				if (dataJson.tp108 === "true"){$("#tyl108").attr("onclick","javascript:;");$("#tyl108").addClass("notcss");}
                if (dataJson.tp109 === "true"){$("#tyl109").attr("onclick","javascript:;");$("#tyl109").addClass("notcss");}
                if (dataJson.tp110 === "true"){$("#tyl110").attr("onclick","javascript:;");$("#tyl110").addClass("notcss");}
									
			} else {
			}
		},
		error: function() {}
	});
}

//倒计时
function loadopentime(){
	var ret = null;
	$.ajax({
		type: "post",
		url: "/user/canada/load_open_time/t/"+Math.random(),
		data: {
			//"act": "get"
		},
		datatype: "json",
		async: false,
		success: function(dataJson) {
            isStop=dataJson.isstop;
            countdownTime(dataJson.currFullExpect, dataJson.currExpect, dataJson.remainTime);
            ret = dataJson.lastFullExpect;
            shownotbet();
		}
	});
	if (ret) {
//		alert(ret);
		$("#lastFullExpect").html("第 " + ret + " 期开奖结果");
		$("#lottshow1").hide();
		$("#lottshow2").show();
		loadOpenCode(ret);
	}
}

//近10期开奖结果
function getBetsListCircle(){
    $.ajax({
        url: "/user/canada/load_open_bet_number/t/"+Math.random(),
        type: "post",
        data: {
            //"expect": expect
        },
        datatype: "json",
        async: false,
        success: function(dataJson) {
            if (dataJson.sign === "true") {

                var html = "";

                $.each(dataJson.userbetList, function(idx, val) {
                    html += '<li>';
                    html += '' + val.num + '';
                    html += '</li>';


                });
                //alert(html);
                $(".circle").html(html);

            } else {
            }
        },
        error: function() {}
    });
}


//取消下注
function cancelbet(betid,expect){
    if(parseInt(betid) <=0){
        $.message({type:"error",content:"发生错误了",time:1200});
        return false;
    }
    if(parseInt(expect) <=0){
        $.message({type:"error",content:"发生错误了",time:1200});
        return false;
    }
    var url,data;
    url="/user/canada/cancel_bet";
    data="betid="+encodeURIComponent($.trim(betid));
    data+="&expect="+encodeURIComponent($.trim(expect));


    $.ajax({
        type:"post",
        cache:false,
        url:url,
        data:data,
        datatype: "json",
        success:function(dataJson)
        {
            switch(dataJson.status)
            {
                case 0:
                    $.message({type:"error",content:dataJson.info,time:3000});
                    break;
                case 1:
                    xztf=true;
                    $.message({type:"ok",content:dataJson.info,time:3000});
                    getUserYingLoss(expect-1);
                    getUserBetsListToday();
                    break;
            }

        }});
    return false
}

//获取用户盈亏
function getUserYingLoss(expect) {
    $.ajax({
        url: "/user/game/get_account_money/t/"+Math.random(),
        datatype: "json",
        async: false,
        success: function(dataJson) {
            if (dataJson.sign === "true") {
                $(".JKnum04").html('账户余额：'+dataJson.userMoney);
            }
        },
        error: function() {}
    });
}
//获取上一期开奖号码
var curr_key = 0;
//切换上一期开奖号码
function nextgetopencode(){
    curr_key = curr_key-1
    if(curr_key<0){
        curr_key = 0;
        $.message({type:"error",content:"当前是最近一期了",time:1200});
        return;
    }
    getOpenCodeList(curr_key);

}
function prevgetopencode(){
    curr_key = curr_key+1
    if(curr_key>9){
        curr_key = 9;
        $.message({type:"error",content:"到了最近第十期了",time:1200});
        return;
    }
    getOpenCodeList(curr_key);
}


//最近10结果
function get_expect_list_10(){
    $.ajax({
        url: "/user/canada/load_open_list_10/t/"+Math.random(),
        datatype: "json",
        ache:false,
        async: false,
        success: function(dataJson) {
            expect_list_10 = dataJson;
            curr_key = 0;
            getOpenCodeList(curr_key);
        }
    });
}

function getOpenCodeList(key) {
    var json_list = JSON.parse(expect_list_10);
    var dataJson = json_list[key];
    $(".FMnum01").html(dataJson.num1);
    $(".FMnum02").html(dataJson.num2);
    $(".FMnum03").html(dataJson.num3);
    $(".FMnum04").html(dataJson.num4);
    $(".FMnum05").html(dataJson.ptype1);
    $(".FMnum06").html(dataJson.ptype2);
    $(".FMnum07").html(dataJson.ptype3);
    $(".FMnum08").html("第 " + dataJson.expect + " 期开奖");

}


//获取开奖号码
var opencodeTimeOut;
function loadOpenCode(expect) {
	clearTimeout(opencodeTimeOut);
	$.ajax({
		url: "/user/canada/load_open_code/expect/"+expect+"/t/"+Math.random(),
		type: "post",
		data: {
			//"expect": expect
		},
		datatype: "json",
		async: false,
		success: function(dataJson) {
			if (dataJson.sign === "true") {
				if (dataJson.expect == expect) {
					$(".FCnum01").html(dataJson.num1);
					$(".FCnum02").html(dataJson.num2);
					$(".FCnum03").html(dataJson.num3);
					$(".FCnum04").html(dataJson.num4);
					
					$(".FCnum05").html(dataJson.ptype1);
					$(".FCnum06").html(dataJson.ptype2);
					$(".FCnum07").html(dataJson.ptype3);
					$("#lottshow1").show();
					$("#lottshow2").hide();
                    get_expect_list_10();
                    getUserBetsListToday();

				} else {
						
				}
			} else {
				opencodeTimeOut = setTimeout(function() {
							loadOpenCode(expect);
						}, 5 * 1000);
			}
		},
		error: function() {}
	});
}

// 倒计时定时器
var CDTime = null;
function countdownTime(qihao, num, timeHD) {
	var timeHD1,timeHD2,timeHD3;
	if (CDTime) {
		clearInterval(CDTime);
	}
	var t=timeHD;
	var h,h1,h2;
	var m,m1,m2;
	var s,s1,s2;
	var localCurrentTime = new Date();
	
	var endTime = localCurrentTime.getTime();
	endTime = parseInt(endTime) + parseInt(t*1000);
	
	
	//alert(t);
	if (t > 0) {
	/*
		switch(t.length)
		{
			case 0:
				timeHD1="0";
				timeHD2="0";
				timeHD3="0";
				break;
			case 1:
				timeHD1="0";
				timeHD2="0";
				timeHD3=t;
				break;
			case 2:
				timeHD1="0";
				timeHD2=t.substring(0,1);
				timeHD3=t.substring(1,2);
				break;
			case 3:
				timeHD1=t.substring(0,1);
				timeHD2=t.substring(1,2);
				timeHD3=t.substring(2,3);
				break;
			default:
				timeHD1="9";
				timeHD2="9";
				timeHD3="9";
				break;
		}
	*/	
		h = Math.floor(t / 60 / 60 % 24);
		if (h < 10) {
			h1 = "0";
			h2 = ""+ h;
		} else {
			h1 =  ""+ Math.floor(h/10);
			h2 =  ""+ h%10;
		}
		m = Math.floor(t / 60 % 60);
		if (m < 10) {
			m1 = "0";
			m2 = ""+ m;
		} else {
			m1 =  ""+ Math.floor(m/10);
			m2 =  ""+ m%10;
		}
		s = Math.floor(t % 60);
		if (s < 10) {
			s1 = "0";
			s2 = ""+ s;
		} else {
			s1 =  ""+ Math.floor(s/10);
			s2 =  ""+ s%10;
		}
		
		$(".timeHD1").html(h1+h2);
		$(".timeHD2").html(m1+m2);
		$(".timeHD3").html(s1+s2);
		
		$(".qihaoHD").html("第 " + qihao + " 期");
		$(".timeHD4").html("截止下注倒计时");
		//alert(t.length);
		if (t < 12) {
			$(".timeHD4").html("开奖倒计时");
			$(".xz").attr("onclick","return false;"); 
			$(".xz").addClass("xznot");
		}
		
		
		CDTime = setInterval(function() {
			t = (parseInt(endTime) - parseInt((new Date()).getTime()))/1000;
			t=parseInt(t);
			t=t.toString();
			//alert(t);
			
			//document.write(t);
			
			if (t >= 0) {
			/*
				switch(t.length)
				{
					case 0:
						timeHD1="0";
						timeHD2="0";
						timeHD3="0";
						break;
					case 1:
						timeHD1="0";
						timeHD2="0";
						timeHD3=t;
						break;
					case 2:
						timeHD1="0";
						timeHD2=t.substring(0,1);
						timeHD3=t.substring(1,2);
						break;
					case 3:
						timeHD1=t.substring(0,1);
						timeHD2=t.substring(1,2);
						timeHD3=t.substring(2,3);
						break;
					default:
						timeHD1="9";
						timeHD2="9";
						timeHD3="9";
						break;
				}
			*/
				
				h = Math.floor(t / 60 / 60 % 24);
				if (h < 10) {
					h1 = "0";
					h2 = ""+ h;
				} else {
					h1 =  ""+ Math.floor(h/10);
					h2 =  ""+ h%10;
				}
				m = Math.floor(t / 60 % 60);
				if (m < 10) {
					m1 = "0";
					m2 = ""+ m;
				} else {
					m1 =  ""+ Math.floor(m/10);
					m2 =  ""+ m%10;
				}
				s = Math.floor(t % 60);
				if (s < 10) {
					s1 = "0";
					s2 = ""+ s;
				} else {
					s1 =  ""+ Math.floor(s/10);
					s2 =  ""+ s%10;
				}
				$(".timeHD1").html(h1+h2);
				$(".timeHD2").html(m1+m2);
				$(".timeHD3").html(s1+s2);
				
				if (t < 12) {
					$(".timeHD4").html("开奖倒计时");
					$(".xz").attr("onclick","return false;"); 
					$(".xz").addClass("xznot");
					
				}
			} else {
				$(".timeHD4").html("截止下注倒计时");
				$(".xz").attr("onclick","submitOK();return false;"); 
				$(".xz").removeClass("xznot");
				clearInterval(CDTime);
				loadopentime();
				hidenotbet();
			}
		}, 500);

	} else {
        $(".timeHD1").html("00");
        $(".timeHD2").html("00");
        $(".timeHD3").html("00");
        $(".qihaoHD").html("第 " + qihao + " 期");
        if(isStop==1){
            $(".timeHD4").html("停止开奖");
        }

	}
}
//============================投注 end

//============================开奖走势 begin
//获取开奖趋势
function getUserZouShi() {
	$.ajax({
		url: "http://db.wm666.com/getdata/loadopenzoushi.asp?act=get&t="+Math.random(),
		type: "post",
		data: {
			//"u": 1
		},
		datatype: "json",
		async: false,
		success: function(msg) {

			var dataJson = JSON.parse(msg); 
			
			if (dataJson.sign === "true") {

			
				$(".ZSnum01").html(dataJson.dayYingLoss);
				$(".ZSnum02").html(dataJson.expect);
			/*
				$(".ZSnum03").html(dataJson.remainTime);
				$(".ZSnum04").html(dataJson.remainTime+10);
			*/
			cBetTime(dataJson.remainTime);
					
			} else {
			}
		},
		error: function() {}
	});
}

// 开奖趋势倒计时定时器
var ZSTime = null;
function cBetTime(timeHD) {
	var timeHD1,timeHD2,timeHD3;
	if (ZSTime) {
		clearInterval(ZSTime);
	}
	var t=timeHD;
	var localCurrentTime = new Date();
	
	var endTime = localCurrentTime.getTime();
	endTime = parseInt(endTime) + parseInt(t*1000);

	if (t > 0) {
		$(".ZSnum03").html(t);
		$(".ZSnum04").html(parseInt(t)+10);
		//alert(t.length);
		
		
		ZSTime = setInterval(function() {
			t = (parseInt(endTime) - parseInt((new Date()).getTime()))/1000;
			t=parseInt(t);
			//alert(t);
			//document.write(t);
			
			if (t >= 0) {
				
				$(".ZSnum03").html(t);
				$(".ZSnum04").html(parseInt(t)+10);
				
			} else {
				clearInterval(ZSTime);
				getUserZouShi();
			}
		}, 500);

	} else {
		
	}
}
//============================开奖走势 end

function onlynum(t0){
    t0.value=t0.value.replace(/[^\d]/g,'');
}
function onlynum27(t0){
    if(parseInt(t0.value)>27){
        t0.value=27;
    }
}
function onlynum10(t0){
    if(t0.value==""){
        t0.value=10;
    }
    if(parseInt(t0.value)<10){
        t0.value=10;
    }
}

function hrefjs(the){
    var url=location.href;
    if(the.value == "0"){
        url=url.replace("pc28v25","pc28v20");
    }else{
        url=url.replace("pc28v20","pc28v25");
    }
    location.href=url;
}