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
                <strong>添加权限</strong>
            </div>
            <div class="tab-body">
                <br />
                <div class="tab-panel active" id="tab-set">
                    <form method="post" class="form-x" action="index.php/Node/add">
                    <div style="display:none;">
	                	<input type="hidden" name="cmd" value="submit" />
	                </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="readme">英文名称</label></div>
                        <div class="field">
                            <input type="text" class="input" id="name" name="name" size="50" placeholder="英文名称" data-validate="required:请填写英文名称" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="sitename">中文名称</label></div>
                        <div class="field">
                            <input type="text" class="input" id="title" name="title" size="50" placeholder="中文名称" data-validate="required:请填写中文名称" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label for="siteurl">类型</label></div>
                        <div class="field">
                            <select id="level" name="level" class="input">
                            <?php 
                            if ($level<=2){
                            	?>
                            	<option value="1">项目</option>
                            	<?php 
                            }
                            ?>
                            	<option value="2">模块</option>
                            	<option value="3">操作</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>父节点</label></div>
                        <div class="field">
                            <select id="pid" name="pid" class="input">
                           	<?php 
                            if ($level<=2){
                            	?>
                            	<option value="0">根节点</option>
                            	<?php 
                            }
                            ?>
                            	<?php 
                            	if ($parent){
	                            	foreach ($parent as $par){
			        					?>
			        					<option value="<?php echo $par['id']; ?>"><?php echo $par['level']=='1'?$par['title']:'&nbsp;&nbsp;&nbsp;&nbsp;|--'.$par['title']; ?></option>
			        					<?php 
			        				}
                            	}
                            	?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="title">排序</label></div>
                        <div class="field">
                            <input type="text" class="input" id="sort" name="sort" size="50" placeholder="排序" value="1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="keywords">描述</label></div>
                        <div class="field">
                            <textarea class="input" id="remark" name="remark" rows="5" cols="50" placeholder="请填写权限描述" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>左侧菜单</label></div>
                        <div class="field">
                            <div class="button-group button-group-small radio">
                                <label class="button active"><input name="type" value="1" checked="checked" type="radio"><span class="icon icon-check"></span>开启</label>
                                <label class="button"><input name="type" value="0" type="radio"><span class="icon icon-times"></span>关闭</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label"><label>状态</label></div>
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
