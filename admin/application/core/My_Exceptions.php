<?php
/**
 * 利用show_error函数实现页面跳转及提示
 */
class My_Exceptions extends CI_Exceptions {
	/**
	 * 修改show_error函数(non-PHPdoc)
	 * @see system/core/CI_Exceptions::show_error()
	 */
	public function show_error($title, $url, $template = 'jump_url', $status_code = 500)
	{
		/*set_status_header($status_code);
		
		if (ob_get_level()>$this->ob_level+1)
		{
			ob_end_flush();
		}*/
		ob_start();
		$templates_path = VIEWPATH.'Public'.DIRECTORY_SEPARATOR;
		include($templates_path.'jump_url.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}
