//canvas 一些公共操作的函数


// 图片通过画布转换成canvas缩放后的数据(data)
// nw,nh:生成图片的尺寸(画布的尺寸)
function getImgToCanvasData(img, nw, nh) {
    // 新的临时画布
    nw = Math.floor(nw);
    nh = Math.floor(nh);
    var temp_canvas = document.createElement("canvas");
    var temp_ctx = temp_canvas.getContext("2d");
    $(temp_canvas).attr({
        width: nw,
        height: nh
    });
    temp_ctx.fillStyle = "#fff"; // 填充的颜色
    temp_ctx.fillRect(0, 0, temp_canvas.width, temp_canvas.height); // 填充颜色 x
    // 绘制主图片
    drawImageIOSFix(temp_ctx, img, 0, 0, img.width, img.height, 0, 0, nw, nh);
    // 将图像输出为base64压缩的字符串 默认为image/png
    var data = temp_canvas.toDataURL();
    // 删除字符串前的提示信息 "data:image/png;base64,"
    //data = data.substring(22);
    return data;
}



//兼容iphone的convas操作函数        
function detectVerticalSquash(img) {
    try {
        var iw = img.naturalWidth, ih = img.naturalHeight;
        var canvas = document.createElement('canvas');
        canvas.width = 1;
        canvas.height = ih;
        var ctx = canvas.getContext('2d');

        ctx.drawImage(img, 0, 0);

        var data = ctx.getImageData(0, 0, 1, ih).data;
        // search image edge pixel position in case it is squashed vertically.
        var sy = 0;
        var ey = ih;
        var py = ih;
        while (py > sy) {
            var alpha = data[(py - 1) * 4 + 3];
            if (alpha === 0) {
                ey = py;
            } else {
                sy = py;
            }
            py = (ey + sy) >> 1;
        }
        var ratio = (py / ih);
        return (ratio === 0) ? 1 : ratio;
    }
    catch (e) {
        alert("4--" + e);
        //alert(img.naturalWidth + " " + img.naturalHeight);
    }
}
//用此函数绘制画布,可以兼容iphone(据说有些iphone的图片canvas默认绘制的时候会旋转90°的)
function drawImageIOSFix(ctx, img, sx, sy, sw, sh, dx, dy, dw, dh) {
    //alert(sx+" "+ sy, sw, sh, dx, dy, dw, dh);
    var vertSquashRatio = detectVerticalSquash(img);
    try {
        ctx.drawImage(img, sx * vertSquashRatio, sy * vertSquashRatio,
                   sw * vertSquashRatio, sh * vertSquashRatio,
                   dx, dy, dw, dh);
    }
    catch (e) {
        alert("5--" + e + "\n" + e.lineNumber + "\n" + e.fileName);
    }
}