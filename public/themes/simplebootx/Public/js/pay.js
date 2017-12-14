function hasDot(num) {
    return ((num + '').indexOf('.') != -1) ? true : false;
}

function checkdb(the)
{
    if($.trim(the.t0.value)=="")
    {
        $.message({content:"\u8bf7\u8f93\u5165\u5145\u503c\u91d1\u989d"});
        the.t0.focus();
        return false
    }
    if(!numOnly(the.t0.value))
    {
        $.message({content:"\u8bf7\u6b63\u786e\u8f93\u5165\u5145\u503c\u91d1\u989d"});
        the.t0.focus();
        return false
    }
    if(the.t0.value<=0)
    {
        $.message({content:"\u6700\u4f4e\u5145\u503c\u91d1\u989d\u4e3a\u0031\u5143"});
        the.t0.focus();
        return false
    }
    if (Number(the.t0.value) < 50)
    {
        $.message({content:"充值最少金额为50元"});
        the.t0.focus();
        return false;
    }
    if(hasDot(the.t0.value)){
        $.message({content:"充值只能为整数!"});
        the.t0.focus();
        return false;
    }


    var d1="";
    d1=the.t1.value;
    if(d1=="")
    {
        $.message({content:"\u8bf7\u9009\u62e9\u652f\u4ed8\u63a5\u53e3"});
        return false
    }

    var paykey,payway;
    var arr=d1.split(":");
    paykey=arr[0];
    payway=arr[1];
    var html='<ul id="onlinetip">';
    html+='<dd>\u8bf7\u60a8\u5728\u65b0\u6253\u5f00\u7684\u7f51\u4e0a\u94f6\u884c\u9875\u9762\u4e0a\u5b8c\u6210\u5145\u503c</dd>';
    html+='<li>\u5145\u503c\u91d1\u989d\uff1a<span>'+the.t0.value+'</span>元</li>';
    html+='<li>\u652f\u4ed8\u65b9\u5f0f\uff1a<span>'+payway+'</span></li>';
    html+='</ul>';
    $.dialog({title:"\u652f\u4ed8\u63d0\u793a",content:html,lock:true,opacity:"0.5",okVal:"\u5df2\u5b8c\u6210\u5145\u503c",ok:function(){location.href='/user/profile/money?t=2&d=1'},cancelVal:'\u91cd\u65b0\u64cd\u4f5c',cancel:function(){location.href='/user/profile/pay'}});
    var url='/user/profile/create_order?t0='+encodeURIComponent($.trim(the.t0.value))+'&t1='+encodeURIComponent(paykey)+'&t2='+encodeURIComponent(payway)+'';
    window.open(url);
    return false
}

function to_banktobank(t){
    var url;
    var data; 
        var t0=$("#bankdata"+t).find('input[name=t0_bank_zs]').val();
        var t1=$("#bankdata"+t).find('input[name=t1_bank_zs]').val();
     if($.trim(t0)=="")
    {
        $.message({content:"\u8bf7\u8f93\u5165\u5145\u503c\u91d1\u989d"});
        return false
    }
    if(!numOnly(t0))
    {
        $.message({content:"\u8bf7\u6b63\u786e\u8f93\u5165\u5145\u503c\u91d1\u989d"});
        return false
    }
    if(t0<=0)
    {
        $.message({content:"\u6700\u4f4e\u5145\u503c\u91d1\u989d\u4e3a\u0031\u5143"});
        return false
    }
    if (Number(t0) < 50)
    {
        $.message({content:"充值最少金额为50元"});
        return false;
    }
    if(hasDot(t0)){
        $.message({content:"充值只能为整数!"});
        return false;
    }

    var d1="";
    d1=t1;
    if(d1=="")
    {
        $.message({content:"\u8bf7\u9009\u62e9\u652f\u4ed8\u63a5\u53e3"});
        return false
    }
    var arr=d1.split(":");
    paykey=arr[0];
    payway=arr[1];
    $('#submitbank'+t).attr('disabled',true).css('background','#999');
    url="/user/profile/create_order?t0="+encodeURIComponent(t0)+"&t1="+encodeURIComponent(paykey)+"&t2="+encodeURIComponent(payway);
    $.ajax({
        type:"post",
        cache:false,
        url:url,
        datatype: "json",
        error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
        success:function(data)
        {
            $.message({type:"ok",content:data.info,time:2500});
        }});
    return false;

}

function weixinpay(){
    var url;
    var data;
    var t0=$("#t0_weixin").val();
    var t1=$("#t1_weixin").val();

    if($.trim(t0)=="")
    {
        $.message({content:"\u8bf7\u8f93\u5165\u5145\u503c\u91d1\u989d"});
        return false
    }
    if(!numOnly(t0))
    {
        $.message({content:"\u8bf7\u6b63\u786e\u8f93\u5165\u5145\u503c\u91d1\u989d"});
        return false
    }
    if(t0<=0)
    {
        $.message({content:"\u6700\u4f4e\u5145\u503c\u91d1\u989d\u4e3a\u0031\u5143"});
        return false
    }
    if (Number(t0) < 50)
    {
        $.message({content:"充值最少金额为50元"});
        return false;
    }
    if(hasDot(t0)){
        $.message({content:"充值只能为整数!"});
        return false;
    }

    var d1="";

    d1=t1;
    if(d1=="")
    {
        $.message({content:"\u8bf7\u9009\u62e9\u652f\u4ed8\u63a5\u53e3"});
        return false
    }

    var arr=d1.split(":");
    paykey=arr[0];
    payway=arr[1];
    //alert(payway);

    url="/user/profile/create_order?t0="+encodeURIComponent(t0)+"&t1="+encodeURIComponent(paykey)+"&t2="+encodeURIComponent(payway);
    $.ajax({
        type:"post",
        cache:false,
        url:url,
        data:data,
        error:function(){alert("\u670d\u52a1\u5668\u9519\u8bef\uff0c\u64cd\u4f5c\u5931\u8d25");},
        success:function(data)
        {
            if(data){
                $("#evmimg").attr("src",data);
            }
        }
    });
    return false;
}

jQuery(".notice").slide({ titCell:".tab-hd li", mainCell:".tab-bd",trigger:"click",delayTime:0 });

$(".cz19 .tab-bd .tab-pal .wxzxcz .wxzxcz_nr input.weixin").toggle(

    function(){
        $(".cz19 .tab-bd .tab-pal .wxzxcz .erwmh").css("display","block");
    },
    function(){
        $(".cz19 .tab-bd .tab-pal .wxzxcz .erwmh").css("display","none");
    }
)