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
                <strong>添加管理员</strong>
            </div>
            <div class="tab-body">
                <br />
                <div class="tab-panel active" id="tab-set">
                    <form method="post" class="form-x" action="index.php/User/add">
                    <div style="display:none;">
	                	<input type="hidden" name="cmd" value="submit" />
	                </div>
                    <div class="form-group">
                        <div class="label"><label for="readme">登录名</label></div>
                        <div class="field">
                            <input type="text" class="input" id="username" name="username" size="50" placeholder="登录名" data-validate="required:请填写管理员的登录名" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="sitename">登录密码</label></div>
                        <div class="field">
                            <input type="password" class="input" id="password" name="password" size="50" placeholder="登录密码" data-validate="required:请填写管理员的登录密码" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label for="siteurl">所属角色组</label></div>
                        <div class="field">
                        	<select id="role_id" class="input" name="role_id">
                        		<?php 
                        		if ($roles){
                        			foreach ($roles as $role){
                        				?>
                        				<option value="<?php echo $role['id']; ?>">
                        					<?php 
                        					if ($role['level']=='1'){
                        						echo '';
                        					}else if ($role['level']=='2'){
                        						echo '&nbsp;&nbsp;&nbsp;&nbsp;|--';
                        					}else if ($role['level']=='3'){
                        						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--';
                        					}else if ($role['level']=='4'){
                        						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--';
                        					}
                        					echo $role['name'];
                        					?>
                        				</option>
                        				<?php 
                        			}
                        		}
                        		?>
                        	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>状态</label></div>
                        <div class="field">
                            <div class="button-group button-group-small radio">
                                <label class="button active"><input name="status" value="1" checked="checked" type="radio"><span class="icon icon-check"></span>开启</label>
                                <label class="button"><input name="status" value="0" type="radio"><span class="icon icon-times"></span>关闭</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="button bg-main" type="submit">提交</button></div>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">居俪网</a>构建</p>
    </div>
</body>
</html>
