<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit" />
    <title>居俪网后台管理-后台管理</title>
    <base href="<?php echo base_url(); ?>" />
</head>
<frameset rows="87,*" cols="*" frameborder="no" border="0" framespacing="0"> 
	<frame src="index.php/Index/top" name="topFrame" scrolling="no" /> 
	<frameset cols="180,*" name="btFrame" frameborder="NO" border="0" framespacing="0"> 
		<frame src="index.php/Index/left" noresize name="menu" scrolling="yes" /> 
		<frame src="index.php/Index/right" noresize name="main" scrolling="yes" /> 
	</frameset> 
</frameset>
<noframes>
<body>
您的浏览器不支持框架！
</body>
</noframes>
</html>