<?php
/**
 * KBoard 게시글 리스트
 * @link www.cosmosfarm.com
 * @copyright Copyright 2013 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */
class KBContentList {
	
	var $board_id;
	var $total;
	var $index;
	var $col_category1;
	var $col_category2;
	var $rpp = 10;
	var $page = 1;
	var $resource;
	var $resource_notice;
	var $resource_reply;
	var $row;
	
	public function __construct($board_id=''){
		if($board_id) $this->setBoardID($board_id);
	}
	
	/**
	 * 모든 게시판의 내용을 반환한다.
	 * @return KBContentList
	 */
	public function init(){
		global $wpdb;
		$this->total = $wpdb->get_var("SELECT COUNT(*) FROM `{$wpdb->prefix}kboard_board_content` WHERE 1");
		$this->resource = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE 1 ORDER BY `date` DESC LIMIT ".($this->page-1)*$this->rpp.",$this->rpp");
		$this->index = $this->total;
		return $this;
	}
	
	/**
	 * 모든 게시판의 내용을 반환한다.
	 * @return KBContentList
	 */
	public function initWithKeyword($keyword=''){
		global $wpdb;
		if($keyword) $where = "`title` LIKE '%$keyword%' OR `content` LIKE '%$keyword%'";
		else $where = '1';
		$this->total = $wpdb->get_var("SELECT COUNT(*) FROM `{$wpdb->prefix}kboard_board_content` WHERE $where");
		$this->resource = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE $where ORDER BY `date` DESC LIMIT ".($this->page-1)*$this->rpp.",$this->rpp");
		$this->index = $this->total;
		return $this;
	}
	
	/**
	 * RSS 피드 출력을 위한 리스트를 반환한다.
	 * @return KBContentList
	 */
	public function initWithRSS(){
		global $wpdb;
		$read = array();
		$result = $wpdb->get_results("SELECT `uid` FROM `{$wpdb->prefix}kboard_board_setting` WHERE `permission_read`='all'");
		foreach($result as $row) $read[] = $row->uid;
		if($read) $where[] = 'board_id IN(' . implode(',', $read) . ')';
		$where[] = "secret=''";
		$this->total = $wpdb->get_var("SELECT COUNT(*) FROM `{$wpdb->prefix}kboard_board_content` WHERE " . implode(' AND ', $where));
		$this->resource = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE " . implode(' AND ', $where) . " ORDER BY `date` DESC LIMIT ".($this->page-1)*$this->rpp.",$this->rpp");
		$this->index = $this->total;
		return $this;
	}
	
	/**
	 * 게시판 아이디를 입력한다.
	 * @param int $board_id
	 * @return KBContentList
	 */
	public function setBoardID($board_id){
		$this->board_id = $board_id;
		return $this;
	}
	
	/**
	 * 페이지 번호를 입력한다.
	 * @param int $page
	 * @return KBContentList
	 */
	public function page($page){
		if($page) $this->page = $page;
		return $this;
	}
	
	/**
	 * 한 페이지에 표시될 게시물 숫자를 입력한다. 
	 * @param int $rpp
	 * @return KBContentList
	 */
	public function rpp($rpp){
		if($rpp) $this->rpp = $rpp;
		return $this;
	}
	
	/**
	 * 카테고리1을 입력한다.
	 * @param string $category
	 * @return KBContentList
	 */
	public function category1($category){
		if($category) $this->col_category1 = $category;
		return $this;
	}
	
	/**
	 * 카테고리2를 입력한다.
	 * @param string $category
	 * @return KBContentList
	 */
	public function category2($category){
		if($category) $this->col_category2 = $category;
		return $this;
	}
	
	/**
	 * 게시판의 리스트를 반환한다.
	 * @param string $keyword
	 * @param string $search
	 * @return resource
	 */
	public function getList($keyword='', $search='title'){
		global $wpdb;
		if(is_array($this->board_id)){
			foreach($this->board_id AS $key => $value){
				$board_ids[] = "'$value'";
			}
			$board_ids = implode(',', $board_ids);
			$where[] = "`board_id` IN ($board_ids)";
		}
		else $where[] = "`board_id`='$this->board_id'";
		
		$where[] = "`notice` LIKE ''";
		if(!$keyword) $where[] = "`parent_uid`='0'";
		if($keyword && $search) $where[] = "`$search` LIKE '%$keyword%'";
		else if($keyword && !$search) $where[] = "(`title` LIKE '%$keyword%' OR `content` LIKE '%$keyword%')";
		if($this->col_category1) $where[] = "`category1` LIKE '$this->col_category1'";
		if($this->col_category2) $where[] = "`category2` LIKE '$this->col_category2'";
		
		// kboard_list_where, kboard_list_orderby 워드프레스 필터 실행
		$where = apply_filters('kboard_list_where', implode(' AND ', $where), $this->board_id);
		$orderby = apply_filters('kboard_list_orderby', '`date` DESC', $this->board_id);
		
		$this->total = $wpdb->get_var("SELECT COUNT(*) FROM `{$wpdb->prefix}kboard_board_content` WHERE $where");
		$this->resource = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE $where ORDER BY $orderby LIMIT ".($this->page-1)*$this->rpp.",$this->rpp");
		$this->index = $this->total - (($this->page-1) * $this->rpp);
		return $this->resource;
	}
	
	/**
	 * 게시판의 모든 리스트를 반환한다.
	 * @return resource
	 */
	public function getAllList(){
		global $wpdb;
		if(is_array($this->board_id)){
			foreach($this->board_id as $key=>$value){
				$board_ids[] = "'$value'";
			}
			$board_ids = implode(',', $board_ids);
			$where = "`board_id` IN ($board_ids)";
		}
		else $where = "`board_id`='$this->board_id'";
		
		$this->total = $wpdb->get_var("SELECT COUNT(*) FROM `{$wpdb->prefix}kboard_board_content` WHERE $where");
		$this->resource = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE $where ORDER BY `date` DESC");
		$this->index = $this->total;
		return $this->resource;
	}
	
	/**
	 * 리스트에서 다음 게시물을 반환한다.
	 * @return KBContent
	 */
	public function hasNext(){
		if(!$this->resource) return '';
		$this->row = current($this->resource);
		
		if($this->row){
			next($this->resource);
			$content = new KBContent();
			$content->initWithRow($this->row);
			return $content;
		}
		else{
			unset($this->resource);
			return '';
		}
	}
	
	/**
	 * 리스트의 현재 인덱스를 반환한다.
	 * @return int
	 */
	public function index(){
		return $this->index--;
	}
	
	/**
	 * 공지사항 리스트를 반환한다.
	 * @return resource
	 */
	public function getNoticeList(){
		global $wpdb;
		if(is_array($this->board_id)){
			foreach($this->board_id AS $key => $value){
				$board_ids[] = "'$value'";
			}
			$board_ids = implode(',', $board_ids);
			$where[] = "`board_id` IN ($board_ids)";
		}
		else $where[] = "`board_id`='$this->board_id'";
		$where[] = "`notice`='true'";
		
		$this->resource_notice = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE " . implode(' AND ', $where) . " ORDER BY `date` DESC");
		return $this->resource_notice;
	}
	
	/**
	 * 공지사항 리스트에서 다음 게시물을 반환한다.
	 * @deprecated
	 * @see ContentList::hasNextNotice()
	 * @return KBContent
	 */
	public function hasNoticeNext(){
		return $this->hasNextNotice();
	}
	
	/**
	 * 공지사항 리스트에서 다음 게시물을 반환한다.
	 * @return Content
	 */
	public function hasNextNotice(){
		if(!$this->resource_notice) $this->getNoticeList();
		$this->row = current($this->resource_notice); 
		
		if($this->row){
			next($this->resource_notice);
			$content = new KBContent();
			$content->initWithRow($this->row);
			return $content;
		}
		else{
			unset($this->resource_notice);
			return '';
		}
	}
	
	/**
	 * 답글 리스트를 반환한다.
	 * @return resource
	 */
	public function getReplyList($parent_uid){
		global $wpdb;
		$this->resource_reply = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}kboard_board_content` WHERE `parent_uid`='$parent_uid' ORDER BY `date` ASC");
		return $this->resource_reply;
	}
	
	/**
	 * 답글 리스트에서 다음 게시물을 반환한다.
	 * @return KBContent
	 */
	public function hasNextReply(){
		if(!$this->resource_reply) return '';
		$this->row = current($this->resource_reply);
	
		if($this->row){
			next($this->resource_reply);
			$content = new KBContent();
			$content->initWithRow($this->row);
			return $content;
		}
		else{
			unset($this->resource_reply);
			return '';
		}
	}
}
?>