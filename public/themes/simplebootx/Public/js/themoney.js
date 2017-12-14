$(function(){$(".ico04").addClass("hover current");})
function selthetype(t0){
    $("#thetype").val(t0);
}

function onlynum(t0){
    t0.value=t0.value.replace(/[^\d]/g,'');
}

function hasDot(num) {
    return ((num + '').indexOf('.') != -1) ? true : false;
}

function checkdb(the)
{
    the.bnt.disabled=true;
    var d1="";
    if (the.t1.length == 0)
    {
        $.message({content:"\u8bf7\u6b63\u786e\u8f93\u5165\u63d0\u73b0\u91d1\u989d"});
        the.bnt.disabled=false;
        return false;
    }
    if(!isNaN(the.t1.value)){
    }else{
        $.message({content:"\u8bf7\u6b63\u786e\u8f93\u5165\u63d0\u73b0\u91d1\u989d"});
        the.bnt.disabled=false;
        return false;
    }
    if (Number(the.t1.value) < 50)
    {
        $.message({content:"\u63d0\u73b0\u91d1\u989d\u6700\u5c0f\u662f 50 \u5143"});
        the.bnt.disabled=false;
        return false;
    }
    if(hasDot(the.t1.value)){
        $.message({content:"提现只能为整数!"});
        the.bnt.disabled=false;
        return false;
    }
    d1=the.t1.value;
    if(d1=="")
    {
        $.message({content:"error"});
        the.bnt.disabled=false;
        return false;
    }

    if (the.thetype.value==0){
        $.message({content:"请先绑定支付宝或银行帐号"});
        the.bnt.disabled=false;
        return false;
    }
    if(strlen(the.passmoney.value)== 0){
        $.message({content:"请输入资金密码"});
        the.bnt.disabled=false;
        return false;
    }


    $.dialog({
        title:"\u63d0\u73b0\u63d0\u793a",
        icon:"face-smile",
        content:"\u786e\u5b9a\u8981\u63d0\u73b0\u5417",
        lock:true,opacity:"0.5",
        okVal:"\u786e\u5b9a",
        ok:function()
        {
            var url,data;
            url="/user/profile/expressive_apply";
            data="t0="+encodeURIComponent(d1);
            data+="&t1="+encodeURIComponent($.trim(the.thetype.value));
            data+="&t2="+encodeURIComponent($.trim(the.passmoney.value));
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
                            $.message({content:data.msg,time:2000});
                            the.bnt.disabled=false;
                            break;
                        case 1:
                            $.message({type:"ok",content:data.msg});
                            setTimeout(function(){window.location.href = "/user/center/index";},1000);
                            break;
                    }

                }
            });
        },
        cancelVal:"取消",cancel:function(){the.bnt.disabled=false;}
    });
    return false
}