// 根据生日的月份和日期，计算星座。 
function getAstro(month, day) {
	var s = "摩羯座水瓶座双鱼座白羊座金牛座双子座巨蟹座狮子座处女座天秤座天蝎座射手座摩羯座";
	var arr = [ 20, 19, 21, 21, 21, 22, 23, 23, 23, 23, 22, 22 ];
	return s.substr(month * 3 - (day < arr[month - 1] ? 3 : 0), 3);
}
// 取星座, 参数分别是 月份和日期
function getxingzuo(month, day) {
	var d = new Date(1999, month - 1, day, 0, 0, 0);
	var arr = [];
	arr.push( [ "摩羯座", new Date(1999, 0, 1, 0, 0, 0) ])
	arr.push( [ "水瓶座", new Date(1999, 0, 20, 0, 0, 0) ])
	arr.push( [ "双鱼座", new Date(1999, 1, 19, 0, 0, 0) ])
	arr.push( [ "白羊座", new Date(1999, 2, 21, 0, 0, 0) ])
	arr.push( [ "金牛座", new Date(1999, 3, 21, 0, 0, 0) ])
	arr.push( [ "双子座", new Date(1999, 4, 21, 0, 0, 0) ])
	arr.push( [ "巨蟹座", new Date(1999, 5, 22, 0, 0, 0) ])
	arr.push( [ "狮子座", new Date(1999, 6, 23, 0, 0, 0) ])
	arr.push( [ "处女座", new Date(1999, 7, 23, 0, 0, 0) ])
	arr.push( [ "天秤座", new Date(1999, 8, 23, 0, 0, 0) ])
	arr.push( [ "天蝎座", new Date(1999, 9, 23, 0, 0, 0) ])
	arr.push( [ "射手座", new Date(1999, 10, 22, 0, 0, 0) ])
	arr.push( [ "摩羯座", new Date(1999, 11, 22, 0, 0, 0) ])
	for ( var i = arr.length - 1; i >= 0; i--) {
		if (d >= arr[i][1])
			return arr[i][0];
	}
}
function getxingzuo(month, day) {
	var s = "摩羯水瓶双鱼白羊金牛双子巨蟹狮子处女天秤天蝎射手摩羯";
	var arr = [ 19, 50, 84, 116, 148, 181, 214, 246, 278, 310, 341, 373, 383 ];
	for ( var i = 0; i < arr.length; i++) {
		if ((((month - 1) << 5) + day) <= arr[i])
			return s.substr(i * 2, 2);
	}
	return "error";
}
/**
 * 转化日期
 * 
 * @param time1
 *            传入的时间戳
 */
function formatDate(date1) {
	var result = "";
	var date2 = new Date();

	var year1 = date1.getFullYear();
	var year2 = date2.getFullYear();
	var month1 = date1.getMonth();
	var month2 = date2.getMonth();
	var date3 = date2.getTime() - date1.getTime();// 相差的毫秒数
	// 计算出相差天数
	var days = Math.floor(date3 / (24 * 3600 * 1000));
	// 计算出小时数
	var leave1 = date3 % (24 * 3600 * 1000) // 计算天数后剩余的毫秒数
	var hours = Math.floor(leave1 / (3600 * 1000));
	// 计算相差分钟数
	var leave2 = leave1 % (3600 * 1000); // 计算小时数后剩余的毫秒数
	var minutes = Math.floor(leave2 / (60 * 1000));
	// 计算相差秒数
	var leave3 = leave2 % (60 * 1000); // 计算分钟数后剩余的毫秒数
	var seconds = Math.round(leave3 / 1000);

	if (days > 0) {
		if (days > 365) {
			result = year1 + "年" + month1 + "月";
		} else {
			if (days > 30) {
				result = (parseInt(month2) - parseInt(month1)) + "个月前";
			} else {
				if (days >= 7) {
					result = parseInt(parseInt(days) / 7) + "周前";
				} else {
					result = days + "天前";
				}
			}
		}
	} else {
		if (hours > 0) {// 比较小时数
			result = hours + "小时前";
		} else {
			if (minutes > 0) {// 比较分钟数
				result = minutes + "分钟前";
			} else {
				if (seconds > 0) {// 比较秒数
					result = seconds + "秒前";
				} else {
					result = "刚刚";
				}
			}
		}
	}
	/*
	 * if(year1<year2){//比较年份 result=year1+"年"+month1+"月"; }else{//年份相同
	 * if(month1<month2){//比较月份
	 * result=(parseInt(month2)-parseInt(month1))+"个月前"; }else{//月份相同
	 * if(days>0){//比较日期 if(days>=7){ result=parseInt(parseInt(days)/7)+"周前";
	 * }else{ result=days+"天前"; } }else{//日期相同 if(hours>0){//比较小时数
	 * result=hours+"小时前"; }else{ if(minutes>0){//比较分钟数 result=minutes+"分钟前";
	 * }else{ if(seconds>0){//比较秒数 result=seconds+"秒前"; }else{ result="刚刚"; } } } } } }
	 */
	return result;
}
// 转化日期
function shortDate(now) {
	var year = now.getFullYear();
	var month = now.getMonth() + 1;
	month = month > 9 ? month : "0" + month;
	var date = now.getDate();
	date = date > 9 ? date : "0" + date;
	var hour = now.getHours();
	hour = hour > 9 ? hour : "0" + hour;
	var minute = now.getMinutes();
	minute = minute > 9 ? minute : "0" + minute;
	var second = now.getSeconds();
	second = second > 9 ? second : "0" + second;
	// return year + "-" + month + "-" + date + " " + hour + ":" + minute;
	return year + "." + month;
}
// 自动缩放,拉伸,平铺图片功能
function imgSizePostion(ww, wh, imgs, type) {
	// ww:窗口的宽度 wh:窗口的高度,imgs:图片集合,type 0:等比缩放居中留白 1:等比缩放居中平铺 2拉伸
	for ( var i = 0; i < imgs.length; i++) {
		var w = $(imgs).eq(i).width();
		var h = $(imgs).eq(i).height();

		// alert(w + " " + h);

		var scale = 1;
		var nh = h * scale;
		var nw = w * scale;

		if (type == 1) {
			// 等比缩放居中平铺
			if (w / h > ww / wh) {
				nh = wh;
				nw = nh * w / h;
			} else {
				nw = ww;
				nh = nw * h / w;
			}
		} else if (type == 2) {
			// 强行拉伸
			nh = wh;
			nw = ww;
		} else {
			if (w / h > ww / wh) {
				// 实际图片超宽的,以宽为准算高
				nw = ww;
				nh = nw * h / w;
			} else {
				nh = wh;
				nw = w * nh / h;
			}
		}

		// alert(scaleW+" "+scaleH+"\n"+ ww + " " + wh + "\n" + w + " " + h +
		// "\n" + nw + " " + nh);

		var left = (ww - nw) / 2;
		var top = (wh - nh) / 2;

		$(imgs).eq(i).css( {
			width : nw,
			height : nh,
			marginLeft : left,
			marginTop : top
		});
	}
}
// 删除所有html标签
function delHtmlTag(str) {
	return str.replace(/<[^>]+>/g, "");// 去掉所有的html标记
}
// 提示框
function showMsg(msg) {
	/*$("#msg_div").remove();
	var msg_bg =
	// '<div id="msg_div" class="popup_bg" style="display:none;">'+
	'<div id="msg_div" style="display:none;position: fixed;top: 0;right: 0;left: 0;bottom: 0;z-index: 9990;">'
			+ '<div class="alert_panel">' + '<p>' + msg + '</p>' +
			// '<div class="alert_btn"
			// onclick="$(\'#msg_div\').fadeOut();">确定</div>'+
			'</div>' + '</div>';
	$("body").append(msg_bg);
	$('#msg_div').fadeIn();*/
	
	$("#msg_div").remove();
	$left=($(window).width()-160)/2;
	$top=($(window).height()-40)/3;
	var loading = '	<div id="msg_div" class="popup_bg box_layout center_h center_v" style="background:rgba(0, 0, 0, 0) !important;">'
			+ '			<div class="loading_box box_layout center_h center_v" style="top:'+$top+';width:160px;height:40px;border-radius:10px;">'
			+ '				<div>'
			+ '					<div class="loading_text" style="margin:0;font-size:0.813rem;">'+msg+'</div>'
			+ '				</div>';
			+ '			</div>';
			+ '		</div>';
	$("body").append(loading);
	$('#msg_div').fadeIn();
	
	
	
	setTimeout("$('#msg_div').fadeOut()", 2000);
}
//遮罩层的JS
function zhezhao() {
	$("#mask").remove();
	var newMask = document.createElement("div");
	newMask.id = "mask";
	//newMask.style.position = "absolute";//遮不住底部footer
	newMask.style.position = "fixed";
	newMask.style.zIndex = "9990";
	_scrollWidth = Math.max(document.body.scrollWidth,
			document.documentElement.scrollWidth);
	_scrollHeight = Math.max(document.body.scrollHeight,
			document.documentElement.scrollHeight);
	newMask.style.width = _scrollWidth + "px";
	newMask.style.height = _scrollHeight + "px";
	newMask.style.top = "0px";
	newMask.style.left = "0px";
	newMask.style.bottom = "0px";
	newMask.style.right = "0px";
	newMask.style.background = "#000";
	newMask.style.filter = "alpha(opacity=35)";
	newMask.style.opacity = "0.35";
	document.body.appendChild(newMask);
}
// 加载数据ing
function showLoading(msg) {
	$("#load_submit").remove();
	$left=($(window).width()-200)/2;
	$top=($(window).height()-150)/2;
	var loading = '	<div id="load_submit" class="popup_bg box_layout center_h center_v" style="background:rgba(0, 0, 0, 0.2) !important;">'
			+ '			<div class="loading_box box_layout center_h center_v">'
			+ '				<div>'
			+ '					<div class="loading"><img src="statics/images/loading.png"/></div>'
			+ '					<div class="loading_text">'+msg+'</div>'
			+ '				</div>';
			+ '			</div>';
			+ '		</div>';
	$("body").append(loading);
	$('#load_submit').fadeIn();
}
// 加载数据关闭
function hideLoading() {
	if ($("body #load_submit").length > 0) {
		$('#load_submit').fadeOut();
	}
}
/*
 * 加载图片点击div picArray 图片数组 picIndex 默认显示的图片下标
 */
function showPic(picArray, picIndex,picID) {
	FastClick.attach(document.body); // 绑定,消除点透和点击延迟
	if ($("body #popup_bg").length > 0) {
		$("#popup_bg").remove();
	}
	var htmls = "<div class='pic_nav box_layout center_v'>"
			+ "		<div class='box_col' onclick='"+(picID=='0'?'javascript:void(0);':'location.href="index.php?post&cmd=detail_post&id='+picID+'";')+"'>" + "		<span>详细</span>"+ "	</div>" 
			+ "		<div class='line'></div>"
			+ "		<div id='num' class='box_col'>" + "		<span>" + picIndex + "/" + picArray.length + "</span>" + "	</div>"
			+ "		<div class='line'></div>"
			+ "		<div class='box_col' id='pic_close'>" + "		<span>关闭</span>"+ "	</div>" 
			+ "	</div>";
			
	var pic_nav=$(htmls);		
	var pic_bg = $("<div id='popup_bg' class='popup_bg black_bg'></div>");
	$("body").append(pic_bg);
	$(pic_bg).append(pic_nav);
	var ul = "<div class='pic_focus_wrapper'><ul>";
	for ( var i = 1; i <= picArray.length; i++) {
		ul += "<li id='img0" + i + "'><div><img src='" + picArray[i - 1]
				+ "'/></div></li>";
	}
	ul += "</ul></div>";
	$(pic_bg).append(ul);






	var $pic_box = $(".pic_focus_wrapper ul");
	var $pic_list = $(".pic_focus_wrapper ul li");
	var h = $(window).height();
	$pic_list.css( {
		"line-height" : h + "px"
	});
	var len = $pic_list.length;
	var i = picIndex;
	var w = $(window).width();
	if (w > 768)
		w = 768;
	var width = w * len;
	$(".pic_focus_wrapper").width(w);
	$pic_box.width(width);
	$pic_list.width(w);
	var st = $("body").scrollTop();
	$(".page").css("display", "none");

	var startX = 0, endX = 0, startY = 0, endY = 0, scrollPrevent = false, zoomed = false, scale = 1, re = 1, tY = 1024;
	var imgScroll = null;

	function scrollP(i) {
		imgScroll = new IScroll("#img0" + (i + 1), {
			zoom : true,
			scrollX : true,
			scrollY : true,
			mouseWheel : true,
			wheelAction : 'zoom'
		});
	}
	imgScroll = new IScroll("#img01", {
		zoom : true,
		scrollX : true,
		scrollY : true,
		mouseWheel : true,
		wheelAction : 'zoom'
	});
	// 默认滚动
	prevPage();
	$pic_list.on("touchstart", function() {
		$("#popup_bg ul").addClass("tran_effect");
		t = event;
		t.preventDefault();
		t = t.touches[0], startX = t.pageX, startY = t.pageY;
	});

	$pic_list.on("touchmove", function() {
		$("#popup_bg ul").addClass("tran_effect");
		t = event;
		t.preventDefault();
		var p = t.touches.length;
		// 防止正在缩放的时候图片变换
		if (p > 1) {
			scrollPrevent = true;
			zoomed = true;
		} else if (zoomed) {
			setTimeout(function() {
				scrollPrevent = false;
				zoomed = false;
			}, 200)
		}
	});

	$pic_list.on("touchend", function() {
		t = event;
		t.preventDefault();
		endX = t.changedTouches[0].pageX;
		endY = t.changedTouches[0].pageY;

		if ($("img", this).height() > h && scale == 1) {
			tY = 30;
		} else {
			tY = 1024;
		}
		scale = imgScroll.scale;
		// // swip事件默认大于50px才会触发
		if (Math.abs(endX - startX) >= 10 && Math.abs(endY - startY) < tY
				&& scale == 1 && !scrollPrevent) {
			if (endX > startX) {
				prevPage();
			} else {
				nextPage();
			}
		}
	});

	function showPics(index) {
		$pic_box.css( {
			"left" : (-w * index) + "px"
		});
		setTimeout(function() {
			imgScroll.destroy();
			scrollP(index);
		}, 300);
	}
	function prevPage() {
		if (i == 0) {
			showPics(i);
			return;
		}
		i--;
		showPics(i);
		$("#num span").html((i + 1) + "/" + picArray.length);
	}
	function nextPage() {
		if (i == len - 1) {
			showPics(i);
			return;
		}
		i++;
		showPics(i);
		$("#num span").html((i + 1) + "/" + picArray.length);
	}
	$("#pic_close").click(function() {
		imgScroll.destroy();
		$(pic_bg).remove();
		$(".page").css("display", "block");
		$("body").scrollTop(st);
	});
}