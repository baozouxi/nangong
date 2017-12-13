function get_tab_list(t,v,page,game_id){
    var url,data;
    switch (t){
        case 1:
            url="/game/"+game_id+"/bets?page=" + page;
            break;
        case 2:
            url="/game/"+game_id+"/tab-list?page=" + page;
            break;
        case 3:
            url="/game/"+game_id+"/fanshui?page=" + page;
            break;
        case 4:
            url="/game/"+game_id+"/zoushi?page=" + page;
            break;
    }


    $("#tab-hd ul li").removeClass("on");
    var i = t -1;
    $("#tab-hd ul li").eq(i).addClass("on");
    $.ajax({
        type:"get",
        cache:false,
        url:url,
        dataType:"json",
        error:function(data){$.message({type:"error",content:'网络超时，请刷新页面后重试',time:3000});},
        beforeSend:function(){$("#tab-pal").html("<li class='loading'><span>正在加载数据, 请稍等......</span></li>");},
        success:function(data)
        {
            var count = Math.ceil(data.count / data.pageSize);
            $("#tab-pal").html(data.list);
            $(".pagination").pager({
                pagenumber:data.page,
                pagecout:count,
                buttonClickCallback:function(page){
                    get_tab_list(t,v,page,game_id);
                }
            });

        }});

}

//反水申请
function applyBack(gdate,v)
{
    var url,data;
    url="/user/game/apply_back";
    data="v="+encodeURIComponent($.trim(v));
    data+="&gdate="+encodeURIComponent($.trim(gdate));
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
                    break;
                case 1:
                    $.message({type:"ok",content:data.info,time:3000});
                    setTimeout(function(){get_tab_list(3,v,page);},1000);
                    break;
            }

        }});
    return false
}

$(function(){
    $(".tzfa ul li").toggle(
        function(){
            $(this).next(".ck_nr").toggle();
        },function(){
            $(this).next(".ck_nr").toggle();
        }
    )
    get_tab_list(t,v,page,game_id);
});