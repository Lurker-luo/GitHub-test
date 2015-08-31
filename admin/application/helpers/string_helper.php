<?php
/**
 * 参数：
 * $str_cut 需要截断的字符串
 * $length 允许字符串显示的最大长度
 * 程序功能：截取全角和半角（汉字和英文）混合的字符串以避免乱码
 */
function substr_cut($str_cut, $length) {
	if (strlen ( $str_cut ) > $length) {
		for($i = 0; $i < $length; $i ++)
			if (ord ( $str_cut [$i] ) > 128)
				$i ++;
		$str_cut = substr ( $str_cut, 0, $i );
	}
	return $str_cut;
}
/**
 * 截取字符串函数
 * Enter description here ...
 * @param unknown_type $str
 * @param unknown_type $len
 * @param unknown_type $encode
 */
function CutString($str, $len, $encode = 'utf-8'/*$encode='GB2312'*/){
	if (strlen ( $str ) <= $len or $len < 1) {
		return $str;
	} else {
		for($i = 0; $i <= $len; $i ++) {
			$temp_str = substr ( $str, 0, 1 );
			if (ord ( $temp_str ) > 127) {
				$i ++;
				if ($i <= $len) {
					if ($encode == 'utf-8') {
						$new_str [] = substr ( $str, 0, 3 );
						$str = substr ( $str, 3 );
					} else {
						$new_str [] = substr ( $str, 0, 2 );
						$str = substr ( $str, 2 );
					}
				}
			} else {
				$new_str [] = substr ( $str, 0, 1 );
				$str = substr ( $str, 1 );
			}
		}
		return join ( $new_str );
	}
}
/**
 * 返回经htmlspecialchars处理过的字符串或数组
 * @param $obj 需要处理的字符串或数组
 * @return mixed
 */
function new_html_special_chars($string) {
	$encoding = 'utf-8';
	if(strtolower(CHARSET)=='gbk') $encoding = 'ISO-8859-15';
	if(!is_array($string)) return htmlspecialchars($string,ENT_QUOTES,$encoding);
	foreach($string as $key => $val) $string[$key] = new_html_special_chars($val);
	return $string;
}

function new_html_entity_decode($string) {
	$encoding = 'utf-8';
	if(strtolower(CHARSET)=='gbk') $encoding = 'ISO-8859-15';
	return html_entity_decode($string,ENT_QUOTES,$encoding);
}

function new_htmlentities($string) {
	$encoding = 'utf-8';
	if(strtolower(CHARSET)=='gbk') $encoding = 'ISO-8859-15';
	return htmlentities($string,ENT_QUOTES,$encoding);
}
/**
 * 获取客户端IP
 * Enter description here ...
 */
function GetIP() {
	if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
		$ip = getenv ( "HTTP_CLIENT_IP" );
	else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
		$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
	else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
		$ip = getenv ( "REMOTE_ADDR" );
	else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
		$ip = $_SERVER ['REMOTE_ADDR'];
	else
		$ip = "unknown";
	return ($ip);
}
/**
 * 根据IP获取地理位置
 * Enter description here ...
 * @param unknown_type $ip
 */
function GetIpLookup($ip = ''){  
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
    if(empty($res)){ return false; }  
    $jsonMatches = array();  
    preg_match('#\{.+?\}#', $res, $jsonMatches);  
    if(!isset($jsonMatches[0])){ return false; }  
    $json = json_decode($jsonMatches[0], true);  
    if(isset($json['ret']) && $json['ret'] == 1){  
        $json['ip'] = $ip;  
        unset($json['ret']);  
    }else{  
        return false;  
    }  
    return $json;  
}  
/**
 * 生成随机编码
 * Enter description here ...
 * @param unknown_type $length
 */
function create_random($length = 32) {
	// 密码字符集，可任意添加你需要的字符
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$password = '';
	for($i = 0; $i < $length; $i ++) {
		// 这里提供两种字符获取方式
		// 第一种是使用 substr 截取$chars中的任意一位字符；
		// 第二种是取字符数组 $chars 的任意元素
		// $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		$password .= $chars [mt_rand ( 0, strlen ( $chars ) - 1 )];
	}
	return $password;
}
/**
 * 手机发送验证码
 * Enter description here ...
 * @param unknown_type $length
 */
function create_yzm($length = 6) {
	// 密码字符集，可任意添加你需要的字符
	$chars = '0123456789';
	
	$password = '';
	for($i = 0; $i < $length; $i ++) {
		// 这里提供两种字符获取方式
		// 第一种是使用 substr 截取$chars中的任意一位字符；
		// 第二种是取字符数组 $chars 的任意元素
		// $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		$password .= $chars [mt_rand ( 0, strlen ( $chars ) - 1 )];
	}
	return $password;
}