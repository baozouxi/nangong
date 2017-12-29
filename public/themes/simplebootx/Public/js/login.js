function checklogin()
{
	 var username = $('#username').val();
	 var password = $('#password').val();
	 var verify = $("#checkcode").val();
	 var token = $('#checktoken').val();
	 var times = $("#username").parents('form').attr('times');
	if(username=="")
	{
		$.message({content:"\u8d26\u6237\u4e0d\u80fd\u4e3a\u7a7a"});
		$('#username').focus();
		return false
	}
	if(password=="")
	{
		$.message({content:"\u5bc6\u7801\u4e0d\u80fd\u4e3a\u7a7a"});
		$('#password').focus();
		return false
	}
/*	if($.trim(verify)=="" && $.trim(token)==""){
		if($('.inputcode').is(':hidden'))
		  $.message({content:"请拖动滑块验证！"});
		  else
		   $.message({content:"请输入验证码！"});
		return false
	}*/
	var url,data;
	url="/login";
	data="username="+encodeURIComponent($.trim(username));
    data+="&password="+encodeURIComponent($.trim(password));
    data+="&verify="+encodeURIComponent($.trim(verify));
	data+="&token="+encodeURIComponent($.trim(token));
	$.ajax({
	type:"post",
	cache:false,
	url:url,
    dataType: "json",
	data:data,
	error:function(xhr){
		alert('账号或密码错误，请检查后重试');
	},
	success:function(dataJson)
	{
		switch(dataJson.status)
		{
			case "0":
				$.message({type:"error",content:dataJson.info});
				++times;
				$("#username").parents('form').attr('times',times);
				$('#signinButton').attr({"disabled":true});
				 if(times>2){
				  if($('.inputcode').is(':hidden'))
				   $('.inputcode').slideDown(100,function(){$('.takecode').slideUp(100)});
				   $('#codeimg').click();
				   $("#password,#checkcode").val(null);
				  }
				break;
			case "1":
				var gourl = "/";
				$.message({type:"ok",content:dataJson.info});
				setTimeout(function(){location.href=gourl},1000);
				break;
			default:
                $.message({type:"error",content:dataJson.info});
				break;
		}
	}});
	return false
}
$(function(){
	$("#onlinepay .ip").focus(function(){$(this).removeClass();$(this).addClass('ipon');});
	$("#onlinepay .ip").blur(function(){$(this).removeClass();$(this).addClass('ip')});
})