function listHover(){$(this).addClass('hover').siblings().removeClass('hover');}
$(function(){$('#hot-goods li').mouseenter(listHover);})

function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=$('#'+name+i);
		var con=$("#con_"+name+"_"+i);
		menu[0].className=i==cursel?"hover":"";
		con[0].style.display=i==cursel?"block":"none";
	}
}

function checksearch(the)
{
	if(the.key.value=="")
	{
		alert("请输入商品名称");
		the.key.focus();
		return false
	}
	if(the.key.value=="请输入商品名称")
	{
		alert("请输入商品名称");
		the.key.focus();
		return false
	}
}


function addfavorite(the)
{
	var url,data;
	url=webroot+"user/ajax.asp";
	data="act=favorite";
	data+="&t0="+encodeURIComponent(the);
	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
	error:function(){alert("\u670d\u52a1\u5668\u9519\u8bef\uff0c\u64cd\u4f5c\u5931\u8d25");},
	success:function(_)
	{
		var act=_.substring(0,1);
		var info=_.substring(1);
		switch(act)
		{
			case "0":
				$.message({type:"error",content:info,time:3000});
				break;
			case "1":
				$.message({type:"error",content:info,time:3000});
				break;
			case "2":
				$.message({type:"ok",content:info,time:3000});
				break;
			default:
				alert(_)
				break;
		}
	}});
	return false
}

function avatar_success()
{
	$.message({type:"ok",content:"\u5934\u50cf\u4fdd\u5b58\u6210\u529f"});
	setTimeout(function(){location.href='?';},2500)
}

function addNum(t0){var o=$('#'+t0);o.parent().css('position','relative').append($('<span>+1</span>').css({'position':'absolute','left':'0px','top':'-15px','color':'#f00'}).animate({fontSize:80,opacity:0},800,function(){$(this).remove();}))}

$(function(){
	//userpanel
	if($("#userpanel").length>0)
	{
        $.post("/portal/index/ajax_get_user_info",function(data)
        {
            $("#userpanel").html(data);
        });
	}
	//subnav
	$(".menu li").hover(function(){
		$("dl",this).css("display","block");
		$(this).addClass("hover");
	},function(){
		$("dl",this).css("display","none");
		$(this).removeClass("hover");
	});
	//
})