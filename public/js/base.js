//不允许输入中文
var engOnly=function(str){
	for(i=0;i<str.length;i++){
		var c = str.substr(i,1);
		var ts = encodeURIComponent(c);
		if(ts.substring(0,2) == "%u"){
			return false;
		} else {
			return true;
		}
	}
}

//电子邮件验证
var emailOnly=function(str){
	var regEmail=/[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/;
	if (regEmail.test(str)){
		return true;
	} else {
		return false;
	}
}

//手机号码验证
var mobileOnly=function(str){
	var regMobile=/^0{0,1}(13[0-9]|14[0-9]|15[0-9]|18[0-9])[0-9]{8}$/;
	if (regMobile.test(str)){
		return true;
	} else {
		return false;
	}
}

//纯数字验证
var numOnly=function(str){
	var regNum=/^[0-9]{1,20}$/;
	if (regNum.test(str)){
		return true;
	} else {
		return false;
	}
}

//电话号码验证
var telOnly=function(str){
	var regTel=/^(\d{3,4}-)?\d{7,9}$/g;
	if (regTel.test(str))
		return true;
	else
		return false;
}

//日期的验证
var dateOnly=function(str){
	var date_array=str.split('-');
	if (date_array.length!=3) return false;
	var y=date_array[0];
	var m=date_array[1];
	var d=date_array[2];
	if (!numOnly(y)||!numOnly(m)||!numOnly(d)) return false;
	if (y.length!=4||m.length!=2||d.length!=2) return false;
	y=Number(y);
	m=Number(m);
	d=Number(d);
	if (y<1900||y>2050||m<1||m>12||d<1||d>31) return false;
	if ((m==4||m==6||m==9||m==11)&&d>30) return false;
	if ((y%100!=0&&y%4==0)||y%400==0){
		if (m==2&&d>29) return false;
	} else {
		if (m==2&&d>28) return false;
	}
	return true;
}

//密码强度检测
function passwordGrade(pwd) {
	var score = 0;
	var regexArr = ['[0-9]', '[a-z]', '[A-Z]', '[\\W_]'];
	var repeatCount = 0;
	var prevChar = '';
	//check length
	var len = pwd.length;
	score += len > 18 ? 18 : len;
	//check type
	for (var i = 0, num = regexArr.length; i < num; i++) { if (eval('/' + regexArr[i] + '/').test(pwd)) score += 4; }
	//bonus point
	for (var i = 0, num = regexArr.length; i < num; i++) {
		if (pwd.match(eval('/' + regexArr[i] + '/g')) && pwd.match(eval('/' + regexArr[i] + '/g')).length >= 2) score += 2;
		if (pwd.match(eval('/' + regexArr[i] + '/g')) && pwd.match(eval('/' + regexArr[i] + '/g')).length >= 5) score += 2;
	}
	//deduction
	for (var i = 0, num = pwd.length; i < num; i++) {
		if (pwd.charAt(i) == prevChar) repeatCount++;
		else prevChar = pwd.charAt(i);
	}
	score -= repeatCount * 1;
	return score;
 }

//字符限制
var charset="gb2312";
function strlen_verify(obj, checklen, maxlen) {
	var v = obj.value, charlen = 0, maxlen = !maxlen ? 255 : maxlen, curlen = maxlen, len = strlen(v);
	for(var i = 0; i < v.length; i++) {
		if(v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
			curlen -= charset == 'utf-8' ? 2 : 1;
		}
	}
	if(curlen >= len) {
		$('#'+checklen).html(curlen - len);
	} else {
		obj.value = mb_cutstr(v, maxlen, true);
	}
}

function mb_cutstr(str, maxlen, dot) {
	var len = 0;
	var ret = '';
	var dot = !dot ? '...' : '';
	maxlen = maxlen - dot.length;
	for(var i = 0; i < str.length; i++) {
		len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
		if(len > maxlen) {
			ret += dot;
			break;
		}
		ret += str.substr(i, 1);
	}
	return ret;
}

function strlen(str) {
	return ($.browser.msie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

//全选取消
function checkall(form)
{
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name!="chkall")
       e.checked=form.chkall.checked;
    }
}

//url跳转
//t0:跳转的页码,t1:系统模式(动，静，伪),t2:动态模式下url模板,t3:总页数,t4:是否是后台调用(0为后台调用)
function urlgo(t0,t1,t2,t3,t4)
{
	var url;
	if(t0>t3){t0=t3}
	url=t2+t0;
	if(t4==1)
	{
		if(t1!=1)
		{
			if(t0<=1)
			{
				if(t1==2){
					//var a=t2;
					//var b=a.split("_");
					t5=t2;
				}
				else
				{
					t5="./"
				}
			}
			else
			{
				if(t1==2){
					var a=t2;
					var b=a.split("_");
					//t5=b[1]+"_[page]/"
					t5=t2+t0+"/";
				}
				else
				{
					t5="index_[page].html"
				}
				t5=t5.replace("[page]",t0);
			}
			url=t5;
		}
	}
	document.location.href=url;
}

function get_cartnum()
{
	if($("#cartnum").length>0)
	{
		$.ajax({type:"post",cache:false,url:webroot+"cart.asp?act=cartnum",success:function(_){$("#cartnum").html(_);}});
	}
}

$(function(){
	//获取购物车商品数量
	//get_cartnum();
	//清空购物车

})

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


	var $body;
	var $select;
	var messageIdNumber=0;
	var messageId;
	$.message=function(settings){
		if(settings.content==null){
			settings.content="";
		}
		if($body==null){
			$body=$("body");
		}
		if(!window.XMLHttpRequest&&$select==null){
			$select=$("select");
		}
		if($select!=null) {
			$select.css("visibility","hidden");
		}
		if(settings.type==null){
			settings.type="warn";
		}
		if(settings.time==null){
			settings.time=1500;
		}
		if(settings.id==null)
		{
			messageId="message"+messageIdNumber;
		}
		else
		{
			messageId=settings.id
		}
		messageIdNumber++;
		var messageHtml;
		
		messageHtml='<div class="baseMessage" id="'+messageId+'"><span class="icon_'+settings.type+'"></span><span class="icon_txt">'+settings.content+'</span><span class="icon_r"></span></div>';
		$body.append(messageHtml);
		var $message=$("#"+messageId);
		$message.css({"margin-left":"-"+parseInt($message.width()/2)+"px"}).slideToggle();
		setTimeout(function(){
			$message.animate({width:0,height:0},"toggle",function(){
				$message.remove();
				if ($select!=null){
					$select.css("visibility","visible");
				}
			});
		},settings.time);
		return messageId;
	}

});

