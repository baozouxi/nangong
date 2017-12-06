lastScrollY2 = 0;
function plug_hongbao(){
    var diffY;
    if (document.documentElement && document.documentElement.scrollTop)
        diffY = document.documentElement.scrollTop;
    else if (document.body)
        diffY = document.body.scrollTop
    else
    {}
    percent=.1*(diffY-lastScrollY2);
    if(percent>0)percent=Math.ceil(percent);
    else percent=Math.floor(percent);
    document.getElementById("hongbao").style.top = parseInt(document.getElementById("hongbao").style.top)+percent+"px";
    lastScrollY2=lastScrollY2+percent;

}

function plug_cakeno(){
    var diffY;
    if (document.documentElement && document.documentElement.scrollTop)
        diffY = document.documentElement.scrollTop;
    else if (document.body)
        diffY = document.body.scrollTop
    else
    {}
    percent=.1*(diffY-lastScrollY2);
    if(percent>0)percent=Math.ceil(percent);
    else percent=Math.floor(percent);
    document.getElementById("cakeno").style.top = parseInt(document.getElementById("cakeno").style.top)+percent+"px";
    lastScrollY2=lastScrollY2+percent;

}


//红包接龙游戏选择
var timeID;
function hbgame(){
//document.getElementById("idmoney").innerHTML="";
    document.getElementById("hongbao").style.display = "";
    document.getElementById("hongbao_bg").style.display = "";
    timeID = window.setInterval("plug_hongbao()",1);
}

function quxiao(){
    clearInterval(timeID);
    //document.getElementById("idmoney").innerHTML="";
    document.getElementById("hongbao").style.display = "none";
    document.getElementById("cakeno").style.display = "none";
    document.getElementById("hongbao_bg").style.display = "none";
    location.href="?";
}

function game1(){
    clearInterval(timeID);
    //document.getElementById("idmoney").innerHTML="";
    document.getElementById("hongbao").style.display = "none";
    document.getElementById("hongbao_bg").style.display = "none";
    location.href="/user/game/pc28v20";
}

function game2(){
    clearInterval(timeID);
    //document.getElementById("idmoney").innerHTML="";
    document.getElementById("hongbao").style.display = "none";
    document.getElementById("hongbao_bg").style.display = "none";
    location.href="/user/game/pc28v25";
}

function cakenogame(){
//document.getElementById("idmoney").innerHTML="";
    document.getElementById("cakeno").style.display = "";
    document.getElementById("hongbao_bg").style.display = "";
    timeID = window.setInterval("plug_cakeno()",1);
}
function game3(){
    clearInterval(timeID);
    //document.getElementById("idmoney").innerHTML="";
    document.getElementById("cakeno").style.display = "none";
    document.getElementById("hongbao_bg").style.display = "none";
    location.href="/user/canada/pc28v20";
}

function game4(){
    clearInterval(timeID);
    //document.getElementById("idmoney").innerHTML="";
    document.getElementById("cakeno").style.display = "none";
    document.getElementById("hongbao_bg").style.display = "none";
    location.href="/user/canada/pc28v25";
}

function game5(){
    clearInterval(timeID);
    //document.getElementById("idmoney").innerHTML="";
    document.getElementById("cakeno").style.display = "none";
    document.getElementById("hongbao_bg").style.display = "none";
    location.href="/user/canada/pc28v27";
}
