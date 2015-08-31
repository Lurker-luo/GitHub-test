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
    <title>拼图后台管理-后台管理</title>
    <base href="<?php echo base_url(); ?>" />
    <link type="text/css" rel="stylesheet" href="statics/css/pintuer.css" />
    <link type="text/css" rel="stylesheet" href="statics/css/admin.css" />
    <script type="text/javascript" src="statics/js/jquery.js"></script>
    <script language='javascript'>
        $(function(){
			$(".admin-navbar ul li").each(function(){
				$(this).click(function(){
					$(".admin-navbar ul li").removeClass("active");
					$(this).addClass("active");
					$("ul li:last").html($(this).find("a").html());
				});
			});
        });
    </script>
</head>
<body>
    <div class="righter nav-navicon" id="admin-nav">
	    <div class="lefter">
	        <div class="logo">
	            <a href="#" target="_blank">
	                <img src="statics/images/logo.png" alt="后台管理系统" />
	            </a>
	        </div>
	    </div>
	    <div class="mainer">
	        <div class="admin-navbar">
	            <span class="float-right">
		            <a class="button button-little bg-main" href="#" target="_blank">前台首页 </a>
		            <a class="button button-little bg-yellow" href="javascript:parent.location.href='index.php/Login/login';">注销登录</a>
	            </span>
	            <ul class="nav nav-inline admin-nav">
	            	<li class="active" id='item0'><a href="javascript:parent.location.href='index.php/Index/index';" target="menu" class="icon-home">开始</a> </li>
	            <?php 
	            if ($menu){
	            	foreach ($menu as $item){
	            		?>
	            		<li id='item<?php echo $item['id']; ?>'><a href="index.php/Index/left?id=<?php echo $item['id']; ?>" target="menu" class="icon-home"><?php echo $item['title']; ?></a> </li>
	            		<?php 
	            	}
	            }
	            ?>
	            </ul>
	        </div>
	        <div class="admin-bread">
	            <span>您好，<?php echo $user['username']; ?>，欢迎您的光临。</span>
	            <ul class="bread">
	                <li><a href="javascript:parent.location.href='index.php/Index/index';" class="icon-home">开始</a></li>
	                <li>后台首页</li>
	            </ul>
	        </div>
	    </div>
	</div>
</body>
</html>