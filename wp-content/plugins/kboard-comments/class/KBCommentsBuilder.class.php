<?php
/**
 * KBoard 워드프레스 게시판 댓글 빌더
 * @link www.cosmosfarm.com
 * @copyright Copyright 2013 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */
class KBCommentsBuilder {
	
	var $board_id;
	var $content_uid;
	var $skin;
	var $skin_path;
	var $permission_comment_write;
	
	public function __construct(){
		$this->setSkin('default');
	}
	
	/**
	 * 스킨을 지정한다.
	 * @param string $skin
	 * @return KBCommentsBuilder
	 */
	public function setSkin($skin){
		$this->skin = $skin;
		$this->skin_path = KBOARD_COMMENTS_URL_PATH . "/skin/{$skin}";
		return $this;
	}
	
	/**
	 * 댓글창 화면을 생성한다.
	 * @return string
	 */
	public function create(){
		global $user_ID;
		$userdata = $user_ID?get_userdata($user_ID):new stdClass();
		$content_uid = $this->content_uid;
		$skin_path = $this->skin_path;
		
		if(!$this->content_uid) return 'KBoard 댓글 알림 :: content_uid=null, content_uid값은 필수 입니다.';
		
		$commentURL = new KBCommentUrl();
		$commentList = new KBCommentList($this->content_uid);
		$commentBuilder = $this;
		
		$member_uid = isset($userdata->ID)?$userdata->ID:'';
		$member_display = isset($userdata->display_name)?$userdata->display_name:'';
		
		include KBOARD_COMMENTS_DIR_PATH . "/skin/{$this->skin}/list.php";
	}
	
	/**
	 * 댓글 리스트 트리를 생성한다.
	 * @param string $template
	 * @param int $parent_uid
	 */
	public function buildTreeList($template, $parent_uid=''){
		global $user_ID;
		$userdata = $user_ID?get_userdata($user_ID):new stdClass();
		$content_uid = $this->content_uid;
		$skin_path = $this->skin_path;
		
		$commentURL = new KBCommentUrl();
		$commentList = new KBCommentList();
		$commentBuilder = $this;
		
		$member_uid = isset($userdata->ID)?$userdata->ID:'';
		$member_display = isset($userdata->display_name)?$userdata->display_name:'';
		
		if($parent_uid) $commentList->initWithParentUID($parent_uid);
		else $commentList->initWithUID($this->content_uid);
		
		include KBOARD_COMMENTS_DIR_PATH . "/skin/{$this->skin}/{$template}";
	}
	
	/**
	 * 댓글 쓰기 권한이 있는 사용자인지 확인한다.
	 * @return boolean
	 */
	public function isWriter(){
		global $user_ID;
		
		if(!$this->permission_comment_write){
			return true;
		}
		else if(is_user_logged_in()){
			if($this->permission_comment_write=='1'){
				return true;
			}
			else if($this->permission_comment_write=='roles'){
				$board = new KBoard($this->board_id);
				$userdata = $user_ID?get_userdata($user_ID):new stdClass();
				if(isset($userdata->roles) && array_intersect($board->getCommentRoles(), $userdata->roles)){
					return true;
				}
			}
		}
		return false;
	}
}
?>