<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <script type="text/javascript" src="statics/js/jquery.js"></script>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
<script type="text/javascript">
	var wait = 3;
	function time() {
		if (wait == 0) {
			location.href='<?php echo $url; ?>';
		} else {
	   		$("#totalSecond").html(wait);
	  		wait--;
	   		setTimeout(function () {
	       		time();
	  		},
	  		1000)
		}
	}
	time();
</script>
</head>
<body><?php echo print_r($url);exit; ?>
	<div id="container">
		<h1><?php echo $title; ?><span id="totalSecond">3</span>秒后自动跳转</h1>
		<p>如果您的页面没有发生跳转，请 <a href="<?php echo $url; ?>">点击这里</a></p>
	</div>
</body>
</html>