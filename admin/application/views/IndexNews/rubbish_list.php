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
    <title>广东医学院党校培训系统后台管理</title>
    <base href="<?php echo base_url(); ?>" />
    <link type="text/css" rel="stylesheet" href="statics/css/pintuer.css" />
    <link type="text/css" rel="stylesheet" href="statics/css/admin.css" />
    <script type="text/javascript" src="statics/js/jquery.js"></script>
    <script type="text/javascript" src="statics/js/pintuer.js"></script>
    <script type="text/javascript" src="statics/js/respond.js"></script>
  	<script type="text/javascript" src="statics/plugin/layer-v1.8.2/layer.min.js"></script>
    <script type="text/javascript">
    	 //单个还原
    	function ret(id){
            layer.confirm('还原后首页新闻将在前台显示，确定要这么做吗？', function(){ 
            	location.href="index.php/IndexNews/operate?cmd=ret&ids="+id;
    		},'提示信息',function(index){
    			layer.close(index); 
        	});
       	}
       	//单个删除
       	function del(id){
            layer.confirm('删除首页新闻后将不可恢复，确定要这么做吗？', function(){ 
            	location.href="index.php/IndexNews/operate?cmd=del&ids="+id;
    		},'提示信息',function(index){
    			layer.close(index); 
        	});
       	}
    	//批量还原
    	function ret_all(){
			var ids="";
			$('input[name="id"]:checked').each(function(){
        		if(ids!=''){
        			ids+=",";
                }	
        		ids+=$(this).val();
			});
            if(ids==''){
            	layer.msg('请选择还原项！');
            	return false;
           	}
            layer.confirm('还原后首页新闻将在前台显示，确定要这么做吗？', function(){ 
            	location.href="index.php/IndexNews/operate?cmd=ret&ids="+ids;
    		},'提示信息',function(index){
    			layer.close(index); 
        	});
       	}       	
       	//批量删除
       	function del_all(){
       		var ids="";
			$('input[name="id"]:checked').each(function(){
        		if(ids!=''){
        			ids+=",";
                }	
        		ids+=$(this).val();
			});
            if(ids==''){
            	layer.msg('请选择删除项！');
            	return false;
           	}
            layer.confirm('删除首页新闻后将不可恢复，确定要这么做吗？', function(){ 
            	location.href="index.php/IndexNews/operate?cmd=del&ids="+ids;
    		},'提示信息',function(index){
    			layer.close(index); 
        	});
       	}
    </script>
</head>
<body>
    <div class="admin">
        <form method="post">
        <div class="panel admin-panel">
            <div class="panel-head">
                <strong>主页新闻列表</strong></div>
            <div class="padding border-bottom">
                <input type="button" class="button button-small checkall" name="checkall" checkfor="id" value="全选" />
                <input type="button" class="button button-small border-green" onclick="ret_all();" value="批量还原" />
                <input type="button" class="button button-small border-yellow" onclick="del_all();" value="批量删除" />
            </div>
            <table class="table table-hover">
                <tr>
                    <th width="45">
                        选择
                    </th>
                    <th width="20">
                        ID
                    </th>
                    <th width="80">
                      所属栏目
                    </th>
                    <th width="150">
                       文章题目
                    </th>
                    <th width="50">
                        作者
                    </th>
                    <th width="50">
                       来源
                    </th>
                   	<th >
                        文章内容
                    </th>
                   	<th width="80">
                        审核状态
                    </th>
                    <th width="100">
                        操作
                    </th>
                </tr>
                <?php 
                if ($IndexNews){
                	foreach ($IndexNews as $item){
                		?>
                		<tr>
		                    <td>
		                        <input type="checkbox" name="id" value="<?php echo $item['id']; ?>" />
		                    </td>
		                    <td>
		                        <?php echo $item['id']; ?>
		                    </td>
		                    <td>
		                        <?php echo $item['asection_name']; ?>
		                    </td>
		                    <td>
		                        <?php echo $item['section_name']; ?>
		                    </td>
		                    <td>
		                        <?php echo $item['author']; ?>
		                    </td>
		                     <td>
				                <?php echo $item['source']; ?>
				            </td>
				             <td>
				                <?php echo $item['content']; ?>
				            </td>
				            <td>
				                <?php echo $item['status']=='1'?'已发布':'不发布'; ?>
				            </td>
		                    <td>
		                        <a class="button border-green button-little" href="javascript:void(0);" onclick="ret(<?php echo $item['id']; ?>);">还原</a>
		                        <a class="button border-red button-little" href="javascript:void(0);" onclick="del(<?php echo $item['id']; ?>);">删除</a>
		                    </td>
		                </tr>
                		<?php 
                	}
                }
                ?>
            </table>
            <div class="panel-foot text-center">
                <?php echo $page; ?>
            </div>
        </div>
        </form>
        <br />
        <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">居俪网</a>构建</p>
    </div>
</body>
</html>