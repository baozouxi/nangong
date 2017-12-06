/* 
 * drag 1.0
 * create by tony@jentian.com
 * date 2015-08-18
 * 拖动滑块
 */
(function($){
    $.fn.drag = function(options){
       var x, drag = this, isMove = false,locked = false;
        /*添加背景，文字，滑块*/
        var html = '<div class="drag_bg"></div>'+
                    '<div class="drag_text" onselectstart="return false;" unselectable="on">拖动滑块验证</div>'+
                    '<div class="handler handler_bg"></div>';
        this.append(html);
        
        var handler = drag.find('.handler');
        var drag_bg = drag.find('.drag_bg');
        var text = drag.find('.drag_text');
        var maxWidth = drag.width() - handler.width();  /*能滑动的最大间距*/
        var defaults = {token:false,url:null,callback:function(){}};
        var options = $.extend(defaults, options);
       /*开始移动*/
	   var preHandler = function(e){e.preventDefault();}
	   function movestart(e){if(!locked){isMove = true;x = e.pageX - parseInt(handler.css('left'), 10);}}
        handler.on('mousedown',function(e){if(!isWap())movestart(e);})
	    handler.on('touchstart',function(touth){if(isWap()){var e = touth.originalEvent.targetTouches[0];document.addEventListener('touchmove',preHandler,false);movestart(e);}})
		
        /*移动中*/
		function moving(e){var _x = e.pageX - x;if(isMove&&!locked){if(_x > 0 && _x <= maxWidth){handler.css({'left': _x});drag_bg.css({'width': _x});}else if(_x > maxWidth){if(options.token && options.url){calltoken();}else{dragOk();}}}}
        $(document).on('mousemove',function(e){if(!isWap())moving(e);})
	    $(document).on('touchmove',function(touth){if(isWap){var e = touth.originalEvent.changedTouches[0];moving(e);}})
	    
	    /*结束移动*/
		function moveout(e){isMove = false;if(!locked){var _x = e.pageX - x;if(_x < maxWidth){handler.animate({'left': 0},200);drag_bg.animate({'width': 0},200);}}}
		$(document).on('mouseup',function(e){if(!isWap())moveout(e);})
	    $(document).on('touchend',function(touch){if(isWap()){document.removeEventListener('touchmove',preHandler,false);var e = touch.originalEvent.changedTouches[0];moveout(e);}})
		 
		/*判断是否为手机端*/
		function isWap(){var userAgentInfo = navigator.userAgent;var Agents = ["Android", "iPhone","SymbianOS", "Windows Phone","iPad", "iPod"];var flag = false;for (var v = 0; v < Agents.length; v++){if (userAgentInfo.indexOf(Agents[v]) > 0){flag = true; break;}}return flag;}
        /*清空事件*/
        function dragOk(){
            handler.removeClass('handler_bg').addClass('handler_ok_bg');
            text.text('验证通过');
            drag.css({'color': '#fff'});
			 locked = true;
			 options.callback();
           }
		//加载密钥
		function calltoken(){
		  locked = true;
		  handler.removeClass('handler_bg').addClass('handler_load_bg');
		  text.text('正在加载密钥...');
		  setTimeout(function(){
			 $.post(options.url,function(data){
				 if(data.status=='success'){
				   drag.append(data.data);
				   handler.removeClass('handler_load_bg').addClass('handler_ok_bg');
                   text.text('验证通过');
                   text.css({'color': '#fff'});
				   options.callback();
				  }else{
				     locked = false;
					 handler.removeClass('handler_load_bg').addClass('handler_bg');
					 text.text('加载密钥失败，请重试');
					 handler.css({'left': 0});
                     drag.find('.drag_bg').css({'width': 0});  
				   }
				 });
			},1000);	
		 }
    };
})(jQuery);


