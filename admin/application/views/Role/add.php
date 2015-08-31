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
</head>
<body>
    <div class="admin">
        <div class="tab">
            <div class="tab-head">
                <strong>添加用户组</strong>
            </div>
            <div class="tab-body">
                <br />
                <div class="tab-panel active" id="tab-set">
                    <form method="post" class="form-x" action="index.php/Role/add">
                    <div style="display:none;">
	                	<input type="hidden" name="cmd" value="submit" />
	                </div>
	                <div class="form-group">
                        <div class="label"><label for="siteurl">继承用户组</label></div>
                        <div class="field">
                            <select id="pid" name="pid" class="input">
                            	<?php 
                            	if ($parent){
                            		if ($level<3){
	                            		foreach ($parent as $par){
				        					?>
				        					<option value="<?php echo $par['id']; ?>">
				        					<?php 
				        					if ($par['level']=='1'){
				        						echo '';
				        					}else if ($par['level']=='2'){
				        						echo '|--';
				        					}else{
				        						echo '&nbsp;&nbsp;&nbsp;&nbsp;|--';
				        					}
				        					echo $par['name'];
				        					?>
				        					</option>
				        					<?php 
				        				}
                            		}else{
                            			?>
                            			<option value="<?php echo $parent['id']; ?>"><?php echo $parent['name']; ?></option>
                            			<?php 
                            		}
                            	}
                            	?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="sitename">用户组名称</label></div>
                        <div class="field">
                            <input type="text" class="input" id="name" name="name" size="50" placeholder="用户组名称" data-validate="required:请填写用户组名称" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="readme">
                                用户组描述</label></div>
                        <div class="field">
                            <textarea class="input" rows="5" id="remark" name="remark" cols="50" placeholder="用户组描述"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>
                                用户组状态</label></div>
                        <div class="field">
                            <div class="button-group button-group-small radio">
                                <label class="button active"><input name="status" value="1" checked="checked" type="radio"><span class="icon icon-check"></span>开启</label>
                                <label class="button"><input name="status" value="0" type="radio"><span class="icon icon-times"></span>关闭</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="button bg-main" type="submit">
                            提交</button></div>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">居俪网</a>构建</p>
    </div>
</body>
</html>