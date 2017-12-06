document.write('<style>');
document.write('.plug_hongbao{width:480px;overflow:hidden;margin-top:60px;position:absolute;z-index:9900;}');
document.write('.plug_hongbao_head{background:url(/plug/pc28game/images/h.gif);height:123px;}');
document.write('.plug_hongbao_foot{background:url(/plug/pc28game/images/f.gif);height:23px;}');
document.write('.plug_hongbao_body{background:url(/plug/pc28game/images/pc28bg.png);padding:2px 10px;height: 352px;}');
document.write('.plug_hongbao_title{font-weight:bold;padding:5px 0;font-family:verdana;}');
document.write('.plug_hongbao_body p{margin:14px 10px;padding:0;font-family:verdana;}');
document.write('.plug_hongbao_body span{font-family:"Microsoft YaHei";color:#DF3121;text-align: center;font-size: 50px;}');
document.write('.plug_hongbao_line{border-bottom:1px solid #E6E6E6;margin:12px 0 8px 0;}');
document.write('.plug_hongbao a.jinru {position:absolute;font-family: "Microsoft YaHei";width: 131px;height: 45px;line-height: 45px;background: #035caf;color: #ffffff;text-align: center; font-size: 16px;margin-left: 83px;cursor: pointer; top:263px;border-radius: 5px;}');

document.write('.plug_hongbao a.quxiao {position:absolute;font-family: "Microsoft YaHei";width: 131px;height: 45px;line-height: 45px;background: #035caf;color: #ffffff;text-align: center; font-size: 16px;margin-left: 264px;cursor: pointer; top:263px;border-radius: 5px;}');

document.write('.plug_hongbao a.jinru7 {position:absolute;font-family: "Microsoft YaHei";width: 131px;height: 45px;line-height: 45px;background: #035caf;color: #ffffff;text-align: center; font-size: 16px;cursor: pointer; top:263px;border-radius: 5px;}');
document.write('.plug_hongbao a.quxiao7 {position:absolute;font-family: "Microsoft YaHei";width: 131px;height: 45px;line-height: 45px;background: #035caf;color: #ffffff;text-align: center; font-size: 16px;margin-left: 155px;cursor: pointer; top:263px;border-radius: 5px;}');
document.write('.plug_hongbao a.quxiao7a {position:absolute;font-family: "Microsoft YaHei";width: 131px;height: 45px;line-height: 45px;background: #035caf;color: #ffffff;text-align: center; font-size: 16px;margin-left: 310px;cursor: pointer; top:263px;border-radius: 5px;}');

document.write('.plug_hongbao a.close {position:absolute;font-family: "Microsoft YaHei";width: 22px;height: 22px;line-height: 22px;background: #035caf;color: #ffffff;text-align: center; font-size: 14px;margin-left: 425px;cursor: pointer; top:16px;border-radius: 15px;}');


document.write('.plug_cakeno_body{background:url(/plug/pc28game/images/cakenobg1.png);padding:2px 10px;height: 352px;}');
document.write('.plug_cakeno_body p{margin:14px 10px;padding:0;font-family:verdana;}');
document.write('.plug_cakeno_body span{font-family:"Microsoft YaHei";color:#DF3121;text-align: center;font-size: 50px;}');

document.write('</style>');

/*幸运28 begin*/
document.write('<div class="plug_hongbao" id="hongbao" style="top:200px;left:50%;margin-left:-250px;display:none;">');
//document.write('	<div class="plug_hongbao_head"></div>');
document.write('	<div class="plug_hongbao_body">');

/*增加客服代码 begin*/
document.write('		<div align="center" style="padding-top: 50px;"><span id="idmoney" class=""></span></div> ');
document.write('		<p><a href="javascript:game1();" class="jinru">2.0倍场</a><a href="javascript:game2();" class="quxiao">2.5倍场</a><a href="javascript:quxiao();" class="close">X</a></p> ');
/*增加客服代码 end*/

document.write('	</div>');
//document.write('	<div class="plug_hongbao_foot"></div>');
document.write('</div>');
/*幸运28 end*/

/*加拿大 begin*/
document.write('<div class="plug_hongbao" id="cakeno" style="top:200px;left:50%;margin-left:-250px;display:none;">');
//document.write('	<div class="plug_hongbao_head"></div>');
document.write('	<div class="plug_cakeno_body">');

/*增加客服代码 begin*/
document.write('		<div align="center" style="padding-top: 50px;"><span id="idmoney" class=""></span></div> ');
document.write('		<p><a href="javascript:game3();" class="jinru7">2.0倍场</a><a href="javascript:game4();" class="quxiao7">2.5倍场</a><a href="javascript:game5();" class="quxiao7a">2.8倍场</a><a href="javascript:quxiao();" class="close">X</a></p> ');
/*增加客服代码 end*/

document.write('	</div>');
//document.write('	<div class="plug_hongbao_foot"></div>');
document.write('</div>');
/*加拿大 end*/


document.write('<div id="hongbao_bg" style="display:none;width: 100%; height: 100%; position: fixed; z-index: 1989; top: 0px; left: 0px; overflow: hidden;"><div style="height: 100%; opacity: 0.5; filter:alpha(opacity=50);background: rgb(0, 0, 0);" onclick="quxiao();"></div></div>');

document.write('<script src="/plug/pc28game/setting.js"></script>');