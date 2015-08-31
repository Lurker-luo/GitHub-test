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
    <link type="text/css" rel="stylesheet" href="statics/css/pintuer.css" />
    <link type="text/css" rel="stylesheet" href="statics/css/admin.css" />
    <script type="text/javascript" src="statics/js/jquery.js"></script>
    <script type="text/javascript" src="statics/js/pintuer.js"></script>
    <script type="text/javascript" src="statics/js/respond.js"></script>
    <script type="text/javascript">
    	$(function(){
    		$("input:checkbox").click(function(){
				if($(this).attr("level")=='1'){
					if($(this).is(':checked')){//选择时
						//二级菜单
						var inputs2=$("input[pid='"+$(this).attr('id')+"']");
						inputs2.prop("checked",true);
						for(var i=0;i<inputs2.length;i++){
							//三级菜单
							var inputs3=$("input[pid='"+$(inputs2[i]).attr('id')+"']");
							inputs3.prop("checked",true);
						}
					}else{
						var inputs2=$("input[pid='"+$(this).attr('id')+"']");
						inputs2.removeAttr("checked");
						for(var i=0;i<inputs2.length;i++){
							//三级菜单
							var inputs3=$("input[pid='"+$(inputs2[i]).attr('id')+"']");
							inputs3.removeAttr("checked");
						}
					}
				}else if($(this).attr("level")=='2'){
					if($(this).is(':checked')){//选择时
						$("input[pid='"+$(this).attr('id')+"']").attr("checked",true);
						$("input[id='"+$(this).attr('pid')+"']").attr("checked",true);
					}else{
						$("input[pid='"+$(this).attr('id')+"']").removeAttr("checked");
					}
				}else if($(this).attr("level")=='3'){
					if($(this).is(':checked')){//选择时
						//二级菜单
						var inputs2=$("input[id='"+$(this).attr('pid')+"']");
						inputs2.prop("checked",true);
						for(var i=0;i<inputs2.length;i++){
							//一级菜单
							var inputs3=$("input[id='"+$(inputs2[i]).attr('pid')+"']");
							inputs3.prop("checked",true);
						}
					}
				}
			});
        });
    </script>
</head>
<body>
    <div class="admin">
        <form method="post" class="form-x" action="index.php/Role/access">
     	<div style="display:none;">
	    	<input type="hidden" name="cmd" value="submit" />
	    	<input type="hidden" name="role_id" value="<?php echo $role['id']; ?>" />
	    </div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong>权限配置</strong></div>
	       	<table class="table">
		  		<tr>
					<td>
			  			<fieldset style="height: auto;"><legend>你正在为用户组：<span style="color:blue;font-weight:bold;"><?php echo $role['name']; ?></span> 分配权限</legend>
			      		<?php 
						if ($nodes){
							foreach ($nodes as $node){
								?>
								<p style="text-indent:<?php echo $node['level']*20; ?>px;<?php echo $node['level']=='3'?'float:left;margin-right:20px;':'clear:both;'; ?>">
									<input type="checkbox" id="<?php echo $node['id']; ?>" name="access[]" pid="<?php echo $node['pid']; ?>" value="<?php echo $node['id']; ?>_<?php echo $node['level']; ?>" level="<?php echo $node['level']; ?>" <?php echo $node['access']=='1'?'checked="checked"':''; ?> />
									<span style="font-weight:bold;"><?php echo $node['level']=='1'?'项目':($node['level']=='2'?'<span style="color:green;">模块</span>':($node['level']=='3'?'操作':'未知权限')); ?></span>
									<label name="name" value="<?php echo $node['id']; ?>"><?php echo $node['title']; ?></label>
								</p>
								<?php 	
							}
						}
						?>
						</fieldset>
			 		</td>
		   		</tr>
	   		</table>
        </div>
        <div class="form-button" style="text-align:center;"><button class="button bg-main" type="submit">  提  交   </button></div>
        </form>
        <br />
        <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">居俪网</a>构建</p>
    </div>
</body>
</html>