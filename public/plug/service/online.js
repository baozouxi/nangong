﻿document.write('<style>');
document.write('@charset "utf-8";');
document.write('*{font-style:normal};');
document.write(".ynewqq{ width:140px; height:auto; position: fixed; z-index:200;right:0px; top:220px; border-radius:4px 4px 0px 0px;_position:absolute;_top:expression(eval(document.body.scrollTop + (document.body.clientHeight)-10-(this.offsetHeight))); background:#fff;}");
document.write('.ynewqq .ytit01{ height:30px; width:100%; background:url(/plug/service/images/ykf01.png) no-repeat #dc585d; border-radius:4px 4px 0px 0px;  overflow:hidden;}');
document.write('.ynewqq h3.bt{ font-size:14px;font-family:"微软雅黑"; font-weight:normal; color:#fff; line-height:30px; text-indent:6px;}');
document.write('.ynewqq .nr{ border:1px solid #cb8389; border-top:none; overflow:hidden; border-radius:0px 0px 4px 4px;}');
document.write('.ynewqq .ytit02{ height:30px; width:100%; overflow:hidden; background:url(/plug/service/images/ykf02.jpg) repeat-x;}');
document.write('.ynewqq ul.zxlb{ padding:5px 3px 10px;}');
document.write('.ynewqq ul.zxlb li{ overflow:hidden; width:100%; clear:both; padding-top:6px;}');
document.write('.ynewqq ul.zxlb .mc{ color:#636363; font-family:"宋体"; font-size:12px; height:22px; line-height:22px; float:left;}');
document.write('.ynewqq ul.zxlb img{ vertical-align:middle; float:left;}');
document.write('.ynewqq .dh{ padding:10px; overflow:hidden; clear:both;}');
document.write('.ynewqq .dh img{ float:left;}');
document.write('.ynewqq .dh span{ font-size:18px; color:#ca0000;font-family:"微软雅黑"; float:left; margin-left:6px;}');
document.write('.ynewqq .yybg01{ background:url(/plug/service/images/ykfbg01.jpg) repeat-x #fff;}');
document.write('.ynewqq .yybg02{ background:url(/plug/service/images/ykfbg02.jpg) repeat-x #fff;}');
document.write('#qqxs{ position:absolute; right:0px; top:0px; cursor:pointer;}');
document.write('#qqlist{ right:0px; display:none;}');
document.write('#qqfloat{z-index:9999;} ');
document.write('#ykfOpenBox{width:174px;}');
document.write('#ykfOpenBox .ykf_top{ height:70px;width:174px; background:url(/plug/service/images/y13kf_01.png) no-repeat;}');
document.write('#ykfOpenBox .ykf_body{ width:174px; background:#3a90ee; padding-bottom:5px; overflow:hidden; border-radius:0 0 4px 4px;}');
document.write('#ykfOpenBox .ykf_body .nrlist{ width:162px;text-align:left; border:1px solid #0f82c0; background:#dbf3ff; overflow:hidden; margin:0 auto; border-radius:4px 4px 4px 4px;}');
document.write('#ykfCloseBtn{ width:10px; height:10px; position:absolute; background:url(/plug/service/images/y13kf_03.png) no-repeat 0 -96px; cursor:pointer; overflow:hidden; text-indent:-999em; right:13px; top:8px; opacity:0.5;}');
document.write('#ykfCloseBtn:hover{ opacity:1;}');
document.write('#ykfOpenBox .ykf_body .nrlist dl dt{ height:32px; color:#002031;font-size:14px; line-height:32px; padding-left:20px; background:url(/plug/service/images/y13kf_03.png) no-repeat 5px 9px #b3e5ff;}');
document.write('#ykfOpenBox .ykf_body .nrlist dl dd{ padding:10px 0 2px; overflow:hidden; text-align:center;}');
document.write('#ykfOpenBox .ykf_body .nrlist dl dd ul li{ padding:0 5px 8px 0;font-size:14px;overflow:hidden;}');
document.write('#ykfOpenBox .ykf_body .nrlist dl dd ul li img{ vertical-align:middle;}#ykfOpenBox .ykf_body .nrlist dl dd ul li b,#ykfOpenBox .ykf_body .nrlist dl dd ul li i{display:block;float:left;}#ykfOpenBox .ykf_body .nrlist dl dd ul li i img{height:20px;width:20px;}#ykfOpenBox .ykf_body .nrlist dl dd ul li em{display:block;float:right;}');
document.write('#ykfOpenBox .ykf_body .nrlist dl dd.tel{color:#00314c; background:url(common/y13kf_03.png) no-repeat 16px -130px; padding-bottom:8px;}');
document.write('#ykfColseBox{ width:40px; height:156px; background:url(/plug/service/images/y13kf_02.png) no-repeat; float:right; overflow:hidden; cursor:pointer; display:none;}');
document.write('</style>');




taokfe=function (id,_top,_right){
    var me=id.charAt?document.getElementById(id):id, d1=document.body, d2=document.documentElement;
    //d1.style.height=d2.style.height='100%';
    me.style.top=_top?_top+'px':0;me.style.left=_right+"px";//[(_left>0?'left':'left')]=_left?Math.abs(_left)+'px':0;
    me.style.position='absolute';
    setInterval(function (){me.style.top=parseInt(me.style.top)+(Math.max(d1.scrollTop,d2.scrollTop)+_top-parseInt(me.style.top))*0.1+'px';},10+parseInt(Math.random()*20));
    return arguments.callee;
};

$(function(){

    if($("#qqfloat").length>0){
        taokfe('qqfloat',150,0);

        var sl=$(this).find("#ykfColseBox");
        var zk=$(this).find("#ykfOpenBox");
        $("#ykfCloseBtn").click(function(){
            zk.hide(200);sl.delay(200).show(200);
        })
        sl.click(function(){
            sl.hide(200);zk.delay(200).show(200);
        })
    }
});

var Telephone="";

document.write("<div id='qqfloat' class='yqqkf'>");
document.write("<div id='ykfOpenBox'>");
document.write("<div class='ykf_top'><div id='ykfCloseBtn' title='关闭'>关闭</div></div>");
document.write("<div class='ykf_body'>");
document.write("<div class='nrlist'>");
if(kflist && (3 in kflist)){
document.write("<dl><dt>"+kflist[3][0].title+"</dt><dd><ul>");
for(var i in kflist[3]){
  document.write("<li><a target='_blank' href='"+kflist[3][i].url+"'><i><img src=\"/themes/simplebootx/Public/images/qqkf.png\"></i><b>"+kflist[3][i].name+"</b><em>"+kflist[3][i].value+"</em></a></li>");
  }
  document.write("</ul></dd></dl>");
 }
if(kflist &&(4 in kflist)){
document.write("<dl><dt>"+kflist[4][0].title+"</dt><dd><ul>");
for(var i in kflist[4]){
  document.write("<li><a target='_blank' href='"+(kflist[4][i].url?kflist[4][i].url:'javascript:;')+"'><i><img src=\"/themes/simplebootx/Public/images/jlq.png\"></i><b>"+kflist[4][i].name+"</b><em>"+kflist[4][i].value+"</em></a></li>");
 }
 document.write("</ul></dd></dl>");
}
if(appdownload && (11 in appdownload)){
for(var i in appdownload[11]){
 document.write("<dl><dt>"+appdownload[11][i].title+"</dt>");
 document.write('<dd style="background:none;padding:0;"><img style="width:150px" src="'+appdownload[11][i].img+'" /></dd>');
 document.write("</dl>");
 }
}
document.write('</div></div></div><div id="ykfColseBox"></div></div>');
