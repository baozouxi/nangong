function checkreg(the)
{
    var form = $('#regdata');
   if(form.find('input[name=username]').val().length<5||form.find('input[name=username]').val().length>10)
    {
        $.message({type:"error",content:'用户名由5-10位字母或数字组成,字母开头'});
        form.find('input[name=username]').focus();
        return false
    }

    if(form.find('input[name=mobile]').val().length!=11)
    {
        $.message({type:"error",content:'请输入正确的手机号码'});
        form.find('input[name=mobile]').focus();
        return false
    }
    // if(form.find('input[name=mobilecode]').val().length!=5)
    // {
    //     $.message({type:"error",content:'请正确输入手机收到的验证码'});
    //     the.mobilecode.focus();
    //     return false
    // }

    if(form.find('input[name=password]').val().length<6||form.find('input[name=password]').val().length>16)
    {
        $.message({type:"error",content:'密码由6至16个字母或者数字组成'});
        form.find('input[name=password]').focus();
        return false
    }

    if(form.find('input[name=username]').val()==form.find('input[name=password]').val())
    {
        $.message({type:"error",content:'用户名和密码不能相同'});
        form.find('input[name=password]').focus();
        return false
    }

    if($.trim(form.find('input[name=password]').val())!=$.trim(form.find('input[name=repass]').val()))
    {
        $.message({type:"error",content:'两次输入的密码不一致'});
        form.find('input[name=repass]').focus();
        return false
    }
    /*
     if($.trim(the.email.value)==""||!emailOnly($.trim(the.email.value)))
     {
     the.email.focus();
     return false
     }
     if($.trim(the.imgcode.value)=="")
     {
     the.imgcode.focus();
     return false
     }
     */


    var url,data;
    url="/register";
    data="username="+encodeURIComponent($.trim(form.find('input[name=username]').val()));
    data+="&password="+encodeURIComponent($.trim(form.find('input[name=password]').val()));
    data+="&password_confirmation="+encodeURIComponent($.trim(form.find('input[name=repass]').val()));
    data+="&phone="+encodeURIComponent($.trim(form.find('input[name=mobile]').val()));
    // data+="&mobilecode="+encodeURIComponent($.trim(form.find('input[name=mobilecode]').val()));
    //data+="&email="+encodeURIComponent($.trim(the.email.value));
    //data+="&imgcode="+encodeURIComponent($.trim(the.imgcode.value));
    data+="&puid="+encodeURIComponent($.trim(form.find('input[name=puid]').val()));
	data+="&ast="+encodeURIComponent($.trim(form.find('#ltagent').val()))
	data+="&agent="+encodeURIComponent($.trim(form.find('input[name=agent]').val()))
    $.ajax({
        type:"post",
        cache:false,
        url:url,
        data:data,
        dataType:'json',
        error:function(xhr){
            if (xhr.status == 422) {
               var response = JSON.parse(xhr.responseText);
               $.each(response.errors, function (index, val) {
                    alert(val);
               });
            }
        },
        success:function(dataJson)
        {
            switch(dataJson.status)
            {
                case "0":
                    $.message({type:"error",content:dataJson.info});
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
		  return false;
        }});
    return false
}

//function get_mobile_code(){
//    var phone = jQuery.trim($('#mobile').val());
//    if(phone==''){
//        $.message({type:"error",content:"请输入正确的手机号！"});
//        return false;
//    }
//    $.post("/portal/index/sms", {mobile:phone}, function(dataJson) {
//        if(dataJson.status==0){
//            $.message({type:"ok",content:'验证码获取成功',time:2000});
//            setTimeout(function(){$("input[name='mobilecode']").val(dataJson.code);},1000);
//        }else{
//            $.message({type:"error",content:dataJson.info,time:2000});
//        }
//    },"json");
//}


function get_mobile_code(token){
    var phone = jQuery.trim($('#mobile').val());
    if(phone==''){
        $.message({type:"error",content:"请输入正确的手机号！"});
        return false;
    }
    $.post("/portal/index/sms", {mobile:phone,token:token}, function(dataJson) {
        if(dataJson.status==0){
            $.message({type:"ok",content:"验证码发送成功"});
            RemainTime();
        }else{
            $.message({type:"error",content:dataJson.info});
        }
    },"json");
}

var iTime = 59;
var Account;
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
            sTime=' 获取手机验证码 ';
            iTime = 59;
            document.getElementById('zphone').disabled = false;
        }else{
            Account = setTimeout("RemainTime()",1000);
            iTime=iTime-1;
        }
    }else{
        sTime=' 没有倒计时 ';
    }
    //document.getElementById('zphone').value = sTime;
    $("#zphone").text(sTime);
}