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
    <style type="text/css">
    	.active{
    		background: #e6f2fb;
    		border-top: solid 1px #b5cfd9;
    		border-bottom: solid 1px #b5cfd9;
    	}
    	.ul_title{
    		background:#09c;
    		text-align:center;
    		height:32px;
    		margin:0;
    		line-height:38px;
    		color: #333;
    		overflow:hidden;
    		font-size:14px;
    		font: inherit;
    		vertical-align: baseline;
    	}
    	ul{
    		margin-top: 0;
    	}
    </style>
    <script type="text/javascript" src="statics/js/jquery.js"></script>
    <script type="text/javascript" src="statics/js/pintuer.js"></script>
    <script type="text/javascript" src="statics/js/respond.js"></script>
 	<script language='javascript'>
        $(function(){
			$("ul li").each(function(){
				$(this).click(function(){
					if($(this).parent().attr("class")!='ul_title'){
						$("ul li").removeClass("active");
						$(this).addClass("active");
					}
				});
			});
        });
    </script>
</head>
<body>
	<div class="main_column">
	    <div class="left_column">
	    	<?php 
	    	if ($nodes){
	    		foreach ($nodes as $node){
	    			?>
	    			<ul class="ul_title">
	    				<li><?php echo $node['title']; ?></li>
	    			</ul>
			        <ul>
			        <?php 
			        $childs=$node['child'];
			        if ($childs){
			        	foreach ($childs as $child){
			        		?>
			        		<li style="margin-left: 0px;height:32px;">
			        			<a style="padding-left: 0px;height:32px;" target="main" href="index.php/<?php echo $node['name']; ?>/<?php echo $child['name']; ?>"><?php echo $child['title']; ?></a>
			        		</li>
			        		<?php 
			        	}
			        }
			        ?>
			        </ul>
	    			<?php 
	    		}
	    	}
	    	?>
	    </div>
	</div>
</body>
</html>
