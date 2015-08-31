<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 利用show_error函数实现页面跳转及提示
 */
function show_error($url, $status_code = 500, $title = '')
{
	$_error =& load_class('Exceptions', 'core');
	echo $_error->show_error($title, $url, 'error_general', $status_code);
	exit();
}