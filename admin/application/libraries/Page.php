<?php
/**
 * 分页类
 * Enter description here ...
 * @author BenBen
 *
 */
class Page{
	/**
	 * 创建分页字符串
	 * Enter description here ...
	 * @param unknown_type $pageIndex
	 * @param unknown_type $pageSize
	 * @param unknown_type $totalCount
	 * @param unknown_type $arr_key
	 * @param unknown_type $arr_value
	 */
	public function create($pageindex, $pagesize, $totalcount, $arr_key, $arr_value){
		$str_page='';
		$str='';
		for($i = 0; $i < count ( $arr_key ); $i ++) {
			// if ($arr_value[$i]!=""&&!empty($arr_value[$i]))
			$str .= $arr_key [$i] . "=" . $arr_value [$i] . "&";
		}
		$pagecount = 0;
		if ($totalcount % $pagesize == 0)
			$pagecount = ( int ) ($totalcount / $pagesize);
		else
			$pagecount = ( int ) ($totalcount / $pagesize + 1);

		if ($pagecount > 1) {
			$breakpage = 9;
			$currentposition = 4;
			$breakspace = 2;
			$maxspace = 4;
			$prevnum = $pageindex - $currentposition;
			$nextnum = $pageindex + $currentposition;
			if ($prevnum < 1)
			$prevnum = 1;
			if ($nextnum > $pagecount)
			$nextnum = $pagecount;

			if ($pageindex == 1)
				$str_page.= '<ul class="pagination"><li class="active"><a href="javascript:void(0);">&lt;&lt;前页</a></li></ul> ';
			else
				$str_page.= '<ul class="pagination"><li><a href="'.current_url().'?' . $str . 'page=' . ($pageindex - 1) . '">&lt;&lt;前页 </a></li></ul>';

			$str_page.= '<ul class="pagination pagination-group">';	
				
			if ($prevnum - $breakspace > $maxspace) {
				for($i = 1; $i <= $breakspace; $i ++)
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';

				$str_page.= '<li><a href="javascript:void(0);">...</a></li>';
				for($i = $pagecount - $breakpage + 1; $i < $prevnum; $i ++)
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';
			} else {
				for($i = 1; $i < $prevnum; $i ++)
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';
			}
			for($i = $prevnum; $i <= $nextnum; $i ++) {
				if ($pageindex == $i)
				$str_page.= '<li class="active"><a href="#">' . $i . '</a></li> '; // 当前页面
				else
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';
			}
			if ($pagecount - $breakspace - $nextnum + 1 > $maxspace) {
				for($i = $nextnum + 1; $i <= $breakpage; $i ++)
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';

				$str_page.= '<li><a href="javascript:void(0);">...</a></li>';
				for($i = $pagecount - $breakspace + 1; $i <= $pagecount; $i ++)
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';
			} else {
				for($i = $nextnum + 1; $i <= $pagecount; $i ++)
				$str_page.= '<li><a href="'.current_url().'?' . $str . 'page=' . $i . '">' . $i . ' </a></li>';
			}

			$str_page.= '</ul>';

			if ($pageindex == $pagecount)
			$str_page.= '<ul class="pagination"><li class="active"><a href="javascript:void(0);">后页&gt;&gt;</a></li></ul>';
			else
			$str_page.= '<ul class="pagination"><li><a href="'.current_url().'?' . $str . 'page=' . ($pageindex + 1) . '">后页&gt;&gt;</a></li></ul>';

		}
		return $str_page;
	}
}
?>