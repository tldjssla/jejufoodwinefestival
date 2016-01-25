<?php
if(!defined('ABSPATH')) exit;
/**
 * KBoard 워드프레스 게시판 보안 함수
 * @link www.cosmosfarm.com
 * @copyright Copyright 2013 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */

// 시스템 설정을 가져온다.
$kboard_xssfilter_active = get_option('kboard_xssfilter')?false:true;
if($kboard_xssfilter_active){
	// HTMLPurifier 클래스를 불러온다.
	if(!class_exists('HTMLPurifier')){
		include_once KBOARD_DIR_PATH.'/htmlpurifier/HTMLPurifier.standalone.php';
	}
	
	// HTMLPurifier 설정 캐시 경로 디렉토리 생성
	wp_mkdir_p(WP_CONTENT_DIR.'/uploads/kboard_htmlpurifier');
}

/**
 * Cross-site scripting (XSS) 공격을 방어하기 위해서 위험한 문자열을 제거한다.
 * @param string $data
 */
function kboard_xssfilter($data){
	global $kboard_xssfilter_active;
	if(is_array($data)) return array_map('kboard_xssfilter', $data);
	if($kboard_xssfilter_active){
		if(!isset($GLOBALS['KBOARD']) || !isset($GLOBALS['KBOARD']['HTMLPurifier']) && !$GLOBALS['KBOARD']['HTMLPurifier'] || !isset($GLOBALS['KBOARD']['HTMLPurifier_Config']) || !$GLOBALS['KBOARD']['HTMLPurifier_Config']){
			$HTMLPurifier_Config = HTMLPurifier_Config::createDefault();
			$HTMLPurifier_Config->set('URI.AllowedSchemes', array('http'=>true,'https'=>true,'mailto'=>true));
			$HTMLPurifier_Config->set('URI.SafeIframeRegexp', '(.*)');
			$HTMLPurifier_Config->set('HTML.SafeIframe', true);
			$HTMLPurifier_Config->set('HTML.SafeObject', true);
			$HTMLPurifier_Config->set('HTML.SafeEmbed', true);
			$HTMLPurifier_Config->set('HTML.TidyLevel', 'light');
			$HTMLPurifier_Config->set('HTML.FlashAllowFullScreen', true);
			$HTMLPurifier_Config->set('HTML.AllowedElements','img,div,a,strong,font,span,em,br,p,u,i,b,sup,sub,small,table,thead,tbody,tfoot,tr,td,th,caption,pre,code,ul,li,ol,big,code,blockquote,center,hr,h1,h2,h3,h4,h5,h6,iframe');
			$HTMLPurifier_Config->set('HTML.AllowedAttributes', 'a.href,a.target,img.src,iframe.src,iframe.frameborder,*.id,*.alt,*.style,*.class,*.title,*.width,*.height,*.border,*.colspan,*.rowspan');
			$HTMLPurifier_Config->set('Attr.AllowedFrameTargets', array('_blank'));
			$HTMLPurifier_Config->set('Output.FlashCompat', true);
			$HTMLPurifier_Config->set('Core.RemoveInvalidImg', true);
			$HTMLPurifier_Config->set('Cache.SerializerPath', WP_CONTENT_DIR.'/uploads/kboard_htmlpurifier');
			$GLOBALS['KBOARD']['HTMLPurifier_Config'] = $HTMLPurifier_Config;
			$GLOBALS['KBOARD']['HTMLPurifier'] = HTMLPurifier::getInstance();
			unset($HTMLPurifier_Config);
		}
		$data = $GLOBALS['KBOARD']['HTMLPurifier']->purify(stripslashes($data), $GLOBALS['KBOARD']['HTMLPurifier_Config']);
	}
	return $data;
}

/**
 * 허용된 도메인의 아이프레임만 남기고 모두 제거한다.
 * @param string $data
 * @return string
 */
function kboard_safeiframe($data){
	/*
	 * 허가된 도메인 호스트 (화이트 리스트)
	 */
	$whitelist[] = 'google.com';
	$whitelist[] = 'www.google.com';
	$whitelist[] = 'youtube.com';
	$whitelist[] = 'www.youtube.com';
	$whitelist[] = 'maps.google.com';
	$whitelist[] = 'maps.google.co.kr';
	$whitelist[] = 'serviceapi.nmv.naver.com';
	$whitelist[] = 'serviceapi.rmcnmv.naver.com';
	$whitelist[] = 'videofarm.daum.net';
	$whitelist[] = 'player.vimeo.com';
	$whitelist[] = 'w.soundcloud.com';
	$whitelist[] = 'slideshare.net';
	$whitelist[] = 'www.slideshare.net';
	$whitelist[] = 'channel.pandora.tv';
	$whitelist[] = 'mgoon.com';
	$whitelist[] = 'www.mgoon.com';
	$whitelist[] = 'tudou.com';
	$whitelist[] = 'www.tudou.com';
	$whitelist[] = 'player.youku.com';
	$whitelist[] = 'videomega.tv';
	$whitelist[] = 'mtab.clickmon.co.kr';
	$whitelist[] = 'tab2.clickmon.co.kr';
	
	// kboard_iframe_whitelist 필터
	$whitelist = apply_filters('kboard_iframe_whitelist', $whitelist);
	
	$re = preg_match_all('/<iframe.+?src="(.+?)".+?[^>]*+>/is', $data, $matches);
	$iframe = $matches[0];
	$domain = $matches[1];
	
	foreach($domain as $key=>$value){
		$value = 'http://' . preg_replace('/^(http:\/\/|https:\/\/|\/\/)/i', '', $value);
		$url = parse_url($value);
		if(!in_array($url['host'], $whitelist)){
			$data = str_replace($iframe[$key].'</iframe>', '', $data);
			$data = str_replace($iframe[$key], '', $data);
		}
	}
	
	// 풀스크린 허용
	$data = preg_replace('/<iframe(.*?)>/is', '<iframe$1 allowfullscreen>', $data);
	
	return $data;
}

/**
 * 모든 html을 제거한다.
 * @param object $data
 */
function kboard_htmlclear($data){
	if(is_array($data)) return array_map('kboard_htmlclear', $data);
	$data = strip_tags($data);
	return htmlspecialchars($data);
}
?>