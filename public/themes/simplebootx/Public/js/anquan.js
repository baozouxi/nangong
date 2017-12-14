var iTime = 59;
var Account;
$(function(){
        get_bank_list();
        $(".navlist li a:eq(3)").addClass("current");}
)

//银行信息列表
function get_bank_list(){
    $.ajax({
        type:"post",
        cache:false,
        url:"/user/profile/get_bank_list",
        success:function(data)
        {
            $("#bank_list").html(data);
        }
    });
}

//删除银行信息
function del_bank_info(id){
    $.dialog({
        title:"确认提示",
        icon:"face-smile",
        content:"确认要删除吗",
        lock:true,opacity:"0.5",
        okVal:"\u786e\u5b9a",
        ok:function()
        {
            $.ajax({
                type:"post",
                cache:false,
                url:"/user/profile/del_bank_record",
                data:'id='+id,
                datatype: "json",
                success:function(data)
                {
                    if(data.status==1){
                        $.message({type:"ok",content:data.info});
                        setTimeout(function(){get_bank_list()},1000);
                    }else{
                        $.message({content:data.info});
                    }
                }
            });
        },
        cancelVal:"取消",cancel:function(){}
    });
    return false;
}

//关闭修改登录密码弹窗
function close_win1()
{
    document.getElementById('light1').style.display='none';
    document.getElementById('fade1').style.display='none';
    $("#winform1 input[type='password']").val("");
}

//关闭修改资金密码弹窗
function close_win2()
{
    document.getElementById('light2').style.display='none';
    document.getElementById('fade2').style.display='none';
    $("#winform2 input[type='password']").val("");
}

//关闭绑定银行账户姓名弹窗
function close_win3()
{
    document.getElementById('light3').style.display='none';
    document.getElementById('fade3').style.display='none';
    $("#winform3 input[type='text']").val("");
}

//关闭绑定银行账户姓名弹窗
function close_win4()
{
    document.getElementById('light4').style.display='none';
    document.getElementById('fade4').style.display='none';
    $("#winform4 input[type='text']").val("");
    $("#winform4 input[type='password']").val("");
    $("#winform4 #rid1_input,#rid2_input,#rid3_input").val("请选择");
    $("#winform4 #rid1_container ul li,#rid2_container ul li,#rid3_container ul li").removeClass("selected");
    $("#winform4 #rid1_input_,#rid2_input_,#rid3_input_").addClass("selected");
}

//关闭绑定手机弹窗
function close_win5()
{
    document.getElementById('light5').style.display='none';
    document.getElementById('fade5').style.display='none';
    $("#winform5 input[type='text']").val("");
}

//关闭绑定QQ弹窗
function close_win6()
{
    document.getElementById('light6').style.display='none';
    document.getElementById('fade6').style.display='none';
    $("#winform6 input[type='text']").val("");
}

//关闭绑定银行账户姓名弹窗
function close_win7()
{
    document.getElementById('light7').style.display='none';
    document.getElementById('fade7').style.display='none';
    $("#light7 input[type='text'],select").val("");
    $("#rid33").html("<option>请选择</option>");
    $("#light7 input[type='password']").val("");
    $("#rid11_input,#rid22_input,#rid33_input").val("请选择");
    $("#light7 #rid11_container ul li,#rid22_container ul li,#rid33_container ul li").removeClass("selected");
    $("#light7 #rid11_input_,#rid22_input_,#rid33_input_").addClass("selected");
}

//修改登录密码
function editpasslogin(the)
{

	the.bnt.disabled=true;

    if(strlen(the.oldpass.value)<6||strlen(the.oldpass.value)>16)
	{
		$.message({content:"原始密码不正确"});
		the.oldpass.focus();
		the.bnt.disabled=false;
		return false
	}

    if(strlen(the.password.value)<6||strlen(the.password.value)>16)
	{
		$.message({content:"新密码长度为6-16位"});
		the.password.focus();
		the.bnt.disabled=false;
		return false
	}

    if(the.password.value != the.repassword.value)
    {
        $.message({content:"两次输入的密码不一致"});
        the.repassword.focus();
        the.bnt.disabled=false;
        return false
    }


	var url,data;
    url="/account/password";
    data="old_password="+encodeURIComponent($.trim(the.oldpass.value));
    data+="&password="+encodeURIComponent($.trim(the.password.value));
    data+="&password_confirmation="+encodeURIComponent($.trim(the.repassword.value));
    data+="&_method=PATCH";

	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    dataType: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
			case 0:
				$.message({content:data.msg});
				the.bnt.disabled=false;
				break;
			case 1:
				$.message({type:"ok",content:data.msg});
				setTimeout(function(){close_win1();},1000);
				break;
		}

	}});
	return false;
}

//修改资金密码
function editpassmoney(the)
{
	if(strlen(the.oldpass.value)<6||strlen(the.oldpass.value)>16)
	{
		$.message({content:"旧密码不正确"});
		the.oldpass.focus();
		return false
	}
	if(strlen(the.password.value)<6||strlen(the.password.value)>16)
	{
		$.message({content:"新密码长度为6-16位"});
		the.password.focus();
		return false
	}

    if(the.password.value != the.repassword.value)
    {
        $.message({content:"两次输入的密码不一致"});
        the.repassword.focus();
        return false
    }
	
	var url,data;
	url="/user/profile/modify_tran_pass";
	data="oldpass="+encodeURIComponent($.trim(the.oldpass.value));
	data+="&password="+encodeURIComponent($.trim(the.password.value));
    data+="&repassword="+encodeURIComponent($.trim(the.repassword.value));

	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    datatype: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
            case 0:
                $.message({content:data.msg});
                break;
            case 1:
                $.message({type:"ok",content:data.msg});
                setTimeout(function(){close_win2();},1000);
                break;
       }

	}});
	return false;
}

//修改银行账户姓名
function editnickname(the)
{
	the.bnt.disabled=true;

	if(strlen(the.nickname.value)<1||strlen(the.nickname.value)>6)
	{
        $.message({content:"请输入正确的姓名"});
		the.nickname.focus();
		the.bnt.disabled=false;
		return false;
	}
	
	var url,data;
    url="/user/profile/bind_bank_account_name";
	data="bank_account_name="+encodeURIComponent($.trim(the.nickname.value));

	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    datatype: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
            case 0:
                $.message({content:data.msg});
                $(".c_"+data.info).focus();
                the.bnt.disabled=false;
                break;
            case 1:
                $.message({type:"ok",content:data.msg});
                setTimeout(function(){close_win3();},1000);
                break;
            case 2:
                $(".c_"+data.info).focus();
                the.bnt.disabled=false;
                $.message({content:data.msg});
                break;
        }

	}});
	return false;
}

//设置问答
function editwdgetpass(the)
{
	the.bnt.disabled=true;
	if(strlen(the.rid1.value)==0)
	{
        $.message({content:'请选择密保问题1'});
		the.rid1.focus();
		the.bnt.disabled=false;
		return false;
	}

    if(strlen(the.wd1.value)==0)
    {
        $.message({content:'请填写密保答案1'});
        the.wd1.focus();
        the.bnt.disabled=false;
        return false;
    }

	if(strlen(the.rid2.value)==0)
	{
        $.message({content:'请选择密保问题2'});
		the.rid2.focus();
		the.bnt.disabled=false;
		return false;
	}

    if(strlen(the.wd2.value)==0)
    {
        $.message({content:'请填写密保答案2'});
        the.wd2.focus();
        the.bnt.disabled=false;
        return false;
    }

	if(strlen(the.rid3.value)==0)
	{
        $.message({content:'请选择密保问题3'});
		the.rid3.focus();
		the.bnt.disabled=false;
		return false;
	}

	if(strlen(the.wd3.value)==0)
	{
        $.message({content:'请填写密保答案3'});
		the.wd3.focus();
		the.bnt.disabled=false;
		return false;
	}
	
	if(strlen(the.passmoney.value)<6||strlen(the.passmoney.value)>16)
	{
        $.message({content:'请填写准确的资金密码'});
		the.passmoney.focus();
		the.bnt.disabled=false;
		return false;
	}
	
	var url,data;
	url="/user/profile/set_pwd_safe";
	data="quest1="+encodeURIComponent($.trim(the.rid1.value));
	data+="&quest2="+encodeURIComponent($.trim(the.rid2.value));
	data+="&quest3="+encodeURIComponent($.trim(the.rid3.value));
	data+="&answer1="+encodeURIComponent($.trim(the.wd1.value));
	data+="&answer2="+encodeURIComponent($.trim(the.wd2.value));
	data+="&answer3="+encodeURIComponent($.trim(the.wd3.value));
	data+="&passmoney="+encodeURIComponent($.trim(the.passmoney.value));
	
	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    datatype: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
            case 0:
                $.message({content:data.msg});
                $(".c_"+data.info).focus();
                the.bnt.disabled=false;
                break;
            case 1:
                $.message({type:"ok",content:data.msg});
                setTimeout(function(){close_win4();},1000);
                break;
        }
	}});
	return false;
}

//修用户手机号码
function editmobile(the)
{
	the.bnt.disabled=true;
	if(strlen(the.oldmobile.value)!=11){
        $.message({content:"请填写正确的手机号"});
		the.oldmobile.focus();
		the.bnt.disabled=false;
		return false;
	}
	if(strlen(the.newmobile.value)!=11){
        $.message({content:"请填写正确的手机号"});
		the.newmobile.focus();
		the.bnt.disabled=false;
		return false;
	}
	if(strlen(the.tbcode.value) != 5){
        $.message({content:"请填写正确的验证码"});
		the.tbcode.focus();
		the.bnt.disabled=false;
		return false;
	}
	
	var url,data;
	url="/user/profile/modify_mobile";
	data="oldmobile="+encodeURIComponent($.trim(the.oldmobile.value));
	data+="&newmobile="+encodeURIComponent($.trim(the.newmobile.value));
	data+="&tbcode="+encodeURIComponent($.trim(the.tbcode.value));

	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    datatype: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
            case 0:
                $.message({content:data.msg});
                $(".c_"+data.info).focus();
                the.bnt.disabled=false;
                break;
            case 1:
                $.message({type:"ok",content:data.msg});
                setTimeout(function(){close_win5();},1000);
                break;
		}

	}});
	return false;
}

//修改用户QQ
function edituserqq(the)
{
	the.bnt.disabled=true;

	if(strlen(the.qq.value)<5||strlen(the.qq.value)>15)
	{
        $.message({content:'请输入正确的QQ号'});
		the.qq.focus();
		the.bnt.disabled=false;
		return false;
	}
	
	var url,data;
	url="/user/profile/modify_qq";
	data="qq="+encodeURIComponent($.trim(the.qq.value));

	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    datatype: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
            case 0:
                $.message({content:data.msg});
                $(".c_"+data.info).focus();
                the.bnt.disabled=false;
                break;
            case 1:
                $.message({type:"ok",content:'修改成功'});
                setTimeout(function(){close_win6()},1000);
                break;
        }

	}});
	return false;
}


//添加账户银行卡
function editbankcard(the)
{

    if($("#sp_hzname").text()==''){
        $.message({content:'请设置银行账户姓名'});
        return false;
    }
	var banktype = $('input:radio:checked').val();

	if(strlen(banktype)==0)
	{
        $.message({content:'请选择账户类型'});
		return false;
	}
	
	if(banktype==1)
	{
		if(strlen(the.alipay.value)==0)
		{
            $.message({content:'请输入支付宝帐号'});
			the.alipay.focus();
			return false;
		}
		if(strlen(the.realipay.value)==0)
		{
            $.message({content:'请输入确认帐号'});
			the.realipay.focus();
			the.bnt.disabled=false;
			return false;
		}
		if(the.realipay.value!=the.alipay.value)
		{
            $.message({content:'两次输入的帐号不一致'});
			the.realipay.focus();
			the.bnt.disabled=false;
			return false;
		}
		
		if(strlen(the.passmoney1.value)==0)
		{
            $.message({content:'请输入资金密码'});
			the.passmoney1.focus();
			the.bnt.disabled=false;
			return false;
		}
	}
	
	if(banktype==2)
	{
		if(strlen(the.bankname.value)==0)
		{
            $.message({content:'请选择银行'});
			the.bankname.focus();
			return false;
		}
		if(strlen(the.userbankcard.value)==0)
		{
            $.message({content:'请输入银行卡号'});
			the.userbankcard.focus();
			the.bnt.disabled=false;
			return false;
		}
		if(strlen(the.rebankcard.value)==0)
		{
            $.message({content:'请输入确认卡号'});
			the.rebankcard.focus();
			the.bnt.disabled=false;
			return false;
		}
		if(the.rebankcard.value!=the.userbankcard.value)
		{
            $.message({content:'两次输入的卡号不一致'});
			the.rebankcard.focus();
			the.bnt.disabled=false;
			return false;
		}
		
		if(strlen(the.passmoney2.value)==0)
		{
            $.message({content:'请输入资金密码'});
			the.passmoney2.focus();
			the.bnt.disabled=false;
			return false;
		}
	}
	
	var url,data;
	url="/user/profile/add_bank_account";
	data="banktype="+encodeURIComponent($.trim(banktype));
	data+="&alipay="+encodeURIComponent($.trim(the.alipay.value));
	data+="&realipay="+encodeURIComponent($.trim(the.realipay.value));
	data+="&passmoney1="+encodeURIComponent($.trim(the.passmoney1.value));
	data+="&bankname="+encodeURIComponent($.trim(the.bankname.value));
	data+="&userbankcard="+encodeURIComponent($.trim(the.userbankcard.value));
	data+="&rebankcard="+encodeURIComponent($.trim(the.rebankcard.value));
	data+="&passmoney2="+encodeURIComponent($.trim(the.passmoney2.value));
	data+="&bankadd1="+encodeURIComponent($.trim(the.bankadd1.value));
	data+="&bankadd2="+encodeURIComponent($.trim(the.bankadd2.value));


	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
    datatype: "json",
    error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
    success:function(data)
    {
        switch(data.status)
        {
            case 0:
                $.message({content:data.msg});
                $(".c_"+data.info).focus();
                break;
            case 1:
                $.message({type:"ok",content:'添加成功'});
                setTimeout(function(){
                    close_win7();
                    get_bank_list();
                },1000);
                break;
		}

	}});
	return false;
}



var sf = [];
sf[0] = new Array("北京市", "东城|西城|崇文|宣武|朝阳|丰台|石景山|海淀|门头沟|房山|通州|顺义|昌平|大兴|平谷|怀柔|密云|延庆");
sf[1] = new Array("上海市", "黄浦|卢湾|徐汇|长宁|静安|普陀|闸北|虹口|杨浦|闵行|宝山|嘉定|浦东|金山|松江|青浦|南汇|奉贤|崇明");
sf[2] = new Array("天津市", "和平|东丽|河东|西青|河西|津南|南开|北辰|河北|武清|红挢|塘沽|汉沽|大港|宁河|静海|宝坻|蓟县");
sf[3] = new Array("重庆市", "万州|涪陵|渝中|大渡口|江北|沙坪坝|九龙坡|南岸|北碚|万盛|双挢|渝北|巴南|黔江|长寿|綦江|潼南|铜梁|大足|荣昌|壁山|梁平|城口|丰都|垫江|武隆|忠县|开县|云阳|奉节|巫山|巫溪|石柱|秀山|酉阳|彭水|江津|合川|永川|南川");
sf[4] = new Array("河北省", "石家庄|邯郸|邢台|保定|张家口|承德|廊坊|唐山|秦皇岛|沧州|衡水");
sf[5] = new Array("山西省", "太原|大同|阳泉|长治|晋城|朔州|吕梁|忻州|晋中|临汾|运城");
sf[6] = new Array("内蒙古自治区", "呼和浩特|包头|乌海|赤峰|呼伦贝尔盟|阿拉善盟|哲里木盟|兴安盟|乌兰察布盟|锡林郭勒盟|巴彦淖尔盟|伊克昭盟");
sf[7] = new Array("辽宁省", "沈阳|大连|鞍山|抚顺|本溪|丹东|锦州|营口|阜新|辽阳|盘锦|铁岭|朝阳|葫芦岛");
sf[8] = new Array("吉林省", "长春|吉林|四平|辽源|通化|白山|松原|白城|延边");
sf[9] = new Array("黑龙江省", "哈尔滨|齐齐哈尔|牡丹江|佳木斯|大庆|绥化|鹤岗|鸡西|黑河|双鸭山|伊春|七台河|大兴安岭");
sf[10] = new Array("江苏省", "南京|镇江|苏州|南通|扬州|盐城|徐州|连云港|常州|无锡|宿迁|泰州|淮安");
sf[11] = new Array("浙江省", "杭州|宁波|温州|嘉兴|湖州|绍兴|金华|衢州|舟山|台州|丽水");
sf[12] = new Array("安徽省", "合肥|芜湖|蚌埠|马鞍山|淮北|铜陵|安庆|黄山|滁州|宿州|池州|淮南|巢湖|阜阳|六安|宣城|亳州");
sf[13] = new Array("福建省", "福州|厦门|莆田|三明|泉州|漳州|南平|龙岩|宁德");
sf[14] = new Array("江西省", "南昌市|景德镇|九江|鹰潭|萍乡|新馀|赣州|吉安|宜春|抚州|上饶");
sf[15] = new Array("山东省", "济南|青岛|淄博|枣庄|东营|烟台|潍坊|济宁|泰安|威海|日照|莱芜|临沂|德州|聊城|滨州|菏泽");
sf[16] = new Array("河南省", "郑州|开封|洛阳|平顶山|安阳|鹤壁|新乡|焦作|濮阳|许昌|漯河|三门峡|南阳|商丘|信阳|周口|驻马店|济源");
sf[17] = new Array("湖北省", "武汉|宜昌|荆州|襄樊|黄石|荆门|黄冈|十堰|恩施|潜江|天门|仙桃|随州|咸宁|孝感|鄂州");
sf[18] = new Array("湖南省", "长沙|常德|株洲|湘潭|衡阳|岳阳|邵阳|益阳|娄底|怀化|郴州|永州|湘西|张家界");
sf[19] = new Array("广东省", "广州|深圳|珠海|汕头|东莞|中山|佛山|韶关|江门|湛江|茂名|肇庆|惠州|梅州|汕尾|河源|阳江|清远|潮州|揭阳|云浮");
sf[20] = new Array("广西壮族自治区", "南宁|柳州|桂林|梧州|北海|防城港|钦州|贵港|玉林|南宁地区|柳州地区|贺州|百色|河池");
sf[21] = new Array("海南省", "海口|三亚");
sf[22] = new Array("四川省", "成都|绵阳|德阳|自贡|攀枝花|广元|内江|乐山|南充|宜宾|广安|达川|雅安|眉山|甘孜|凉山|泸州");
sf[23] = new Array("贵州省", "贵阳|六盘水|遵义|安顺|铜仁|黔西南|毕节|黔东南|黔南");
sf[24] = new Array("云南省", "昆明|大理|曲靖|玉溪|昭通|楚雄|红河|文山|思茅|西双版纳|保山|德宏|丽江|怒江|迪庆|临沧");
sf[25] = new Array("西藏自治区", "拉萨|日喀则|山南|林芝|昌都|阿里|那曲");
sf[26] = new Array("陕西省", "西安|宝鸡|咸阳|铜川|渭南|延安|榆林|汉中|安康|商洛");
sf[27] = new Array("甘肃省", "兰州|嘉峪关|金昌|白银|天水|酒泉|张掖|武威|定西|陇南|平凉|庆阳|临夏|甘南");
sf[28] = new Array("宁夏回族自治区", "银川|石嘴山|吴忠|固原");
sf[29] = new Array("青海省", "西宁|海东|海南|海北|黄南|玉树|果洛|海西");
sf[30] = new Array("新疆维吾尔族", "乌鲁木齐|石河子|克拉玛依|伊犁|巴音郭勒|昌吉|克孜勒苏柯尔克孜|博尔塔拉|吐鲁番|哈密|喀什|和田|阿克苏");
sf[31] = new Array("香港特别行政区", "香港特别行政区");
sf[32] = new Array("澳门特别行政区", "澳门特别行政区");
sf[33] = new Array("台湾省", "台北|高雄|台中|台南|屏东|南投|云林|新竹|彰化|苗栗|嘉义|花莲|桃园|宜兰|基隆|台东|金门|马祖|澎湖");
sf[34] = new Array("其它", "北美洲|南美洲|亚洲|非洲|欧洲|大洋洲");
var changePre = function() {
	var citySel = $("#rid33");
	citySel.empty();
	//citySel.append('<option value="">请选择</option>');
	var pro = $("#rid22").val();
	var i, j, tmpcity = [];
	var city = "";
	for (i = 0; i < sf.length; i++) {
		if (pro == sf[i][0].toString()) {
			tmpcity = sf[i][1].split("|");
			for (j = 0; j < tmpcity.length; j++) {
				if (j === 0) {
					city = tmpcity[j];
				}
				citySel.append("<option >" + tmpcity[j] + "</option>");
			}
		}
	}
};

function get_mobile_code(){
    var phone = jQuery.trim($('#newmobile').val());
    if(phone==''){
        $.message({type:"error",content:"请输入正确的手机号！"});
        return false;
    }
    $.post("/portal/index/sms", {mobile:phone}, function(dataJson) {
        if(dataJson.status==0){
            $.message({type:"ok",content:'验证码获取成功',time:2000});
            setTimeout(function(){$("input[name='tbcode']").val(dataJson.code);},1000);
        }else{
            $.message({type:"error",content:dataJson.info,time:2000});
        }
    },"json");
}

//function get_mobile_code(){
//    var phone = jQuery.trim($('#newmobile').val());
//    if(phone==''){
//        $.message({type:"error",content:"请输入正确的手机号！"});
//        return false;
//    }
//    $.post("/portal/index/sms", {mobile:phone}, function(dataJson) {
//        if(dataJson.status==0){
//            $.message({type:"ok",content:dataJson.info});
//            RemainTime();
//        }else{
//            $.message({type:"error",content:dataJson.info});
//        }
//    },"json");
//}

function RemainTime(){
    document.getElementById('zphone').disabled = true;
    var iSecond,sSecond="",sTime="";
    if (iTime >= 0){
        iSecond = parseInt(iTime%60);
        iMinute = parseInt(iTime/60)
        if (iSecond >= 0){
            if(iMinute>0){
                sSecond = iMinute + "分" + iSecond + "秒";
            }else{
                sSecond = iSecond + "秒";
            }
        }
        sTime=' 倒计时:' + sSecond + ' ';
        if(iTime==0){
            clearTimeout(Account);
            sTime=' 发送验证码 ';
            iTime = 59;
            document.getElementById('zphone').disabled = false;
        }else{
            Account = setTimeout("RemainTime()",1000);
            iTime=iTime-1;
        }
    }else{
        sTime=' 没有倒计时 ';
    }
    document.getElementById('zphone').value = sTime;
    //$("#zphone").text(sTime);
}
