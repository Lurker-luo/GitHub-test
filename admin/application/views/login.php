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
    <title>广东医学院党校培训系统后台管理-管理员登录</title>
    <base href="<?php echo base_url(); ?>" />
    <link type="text/css" rel="stylesheet" href="statics/css/pintuer.css" />
    <link type="text/css" rel="stylesheet" href="statics/css/admin.css" />
    <script type="text/javascript" src="statics/js/jquery.js"></script>
    <script type="text/javascript" src="statics/js/pintuer.js"></script>
    <script type="text/javascript" src="statics/js/respond.js"></script>
</head>
<body>
    <div class="container">
        <div class="line">
            <div class="xs6 xm4 xs3-move xm4-move">
                <br />
                <br />
                <div class="media media-y">
                    <a href="#" target="_blank">
                        <img src="statics/images/logo.png" class="radius" alt="后台管理系统" />
                    </a>
                </div>
                <br />
                <br />
                <form action="index.php/Login/login" method="post">
                <div style="display:none;">
                	<input type="hidden" name="cmd" value="submit" />
                </div>
                <div class="panel">
                    <div class="panel-head">
                        <strong>登录广东医学院党校培训系统-后台管理</strong></div>
                    <div class="panel-body" style="padding: 30px;">
                        <div class="form-group">
                            <div class="field field-icon-right">
                                <input type="text" class="input" maxlength="10" name="username" value="jooli" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" />
                                <span class="icon icon-user"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field field-icon-right">
                                <input type="password" class="input" maxlength="18" name="password" value="jooli_botuu" placeholder="登录密码" data-validate="required:请填写密码,length#>=6:密码长度不符合要求" />
                                <span class="icon icon-key"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <input type="text" class="input" maxlength="4" name="passcode" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
                                <img src="index.php/Login/create_Code" style="cursor:pointer;" onclick="$(this).attr('src','index.php/Login/create_Code');" width="80" height="32" class="passcode" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-foot text-center">
                        <button type="submit" class="button button-block bg-main text-big">立即登录后台</button>
                   	</div>
                </div>
                </form>
                <div class="text-right text-small text-gray padding-top">
                    <a class="text-gray" target="_blank" href="#">广东医学院党校培训系统-</a>后台管理</div>
            </div>
        </div>
    </div>
</body>
</html>
