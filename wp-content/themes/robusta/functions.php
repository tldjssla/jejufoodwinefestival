<?php
/* Define THEME */
if (!defined('URI_PATH')) define('URI_PATH', get_template_directory_uri());
if (!defined('ABS_PATH')) define('ABS_PATH', get_template_directory());
if (!defined('URI_PATH_FR')) define('URI_PATH_FR', URI_PATH.'/framework');
if (!defined('ABS_PATH_FR')) define('ABS_PATH_FR', ABS_PATH.'/framework');
if (!defined('URI_PATH_ADMIN')) define('URI_PATH_ADMIN', URI_PATH_FR.'/admin');
if (!defined('ABS_PATH_ADMIN')) define('ABS_PATH_ADMIN', ABS_PATH_FR.'/admin');
/* Theme Options */
if ( !class_exists( 'ReduxFramework' ) ) {
    require_once( ABS_PATH . '/redux-framework/ReduxCore/framework.php' );
}
require_once (ABS_PATH_ADMIN.'/theme-options.php');
require_once (ABS_PATH_ADMIN.'/index.php');
global $tb_options;
/* Template Functions */
require_once ABS_PATH_FR . '/template-functions.php';
/* Template Functions */
require_once ABS_PATH_FR . '/templates/post-favorite.php';
require_once ABS_PATH_FR . '/templates/post-functions.php';
/* Post Type */
require_once ABS_PATH_FR.'/post-type/testimonial.php';
/* Function for Framework */
require_once ABS_PATH_FR . '/includes.php';
/* Register Sidebar */
if (!function_exists('tb_RegisterSidebar')) {
	function tb_RegisterSidebar(){
		global $tb_options;
		register_sidebar(array(
			'name' => __('Main Sidebar', 'robusta'),
			'id' => 'tbtheme-main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Blog Left Sidebar', 'robusta'),
			'id' => 'tbtheme-left-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Blog Right Sidebar', 'robusta'),
			'id' => 'tbtheme-right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebars(4, array(
			'name' => __('Custom Sidebar %d', 'robusta'),
			'id' => 'tbtheme-custom-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebar(array(
			'name' => __('Menu Sidebar', 'robusta'),
			'id' => 'tbtheme-menu-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));  
		$tb_footer_top_args = array();
		$tb_footer_top_args = array(
			'id' => 'tbtheme-footer-top-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		);
		$tb_footer_top_column = isset($tb_options['tb_footer_top_column']) ? (int)$tb_options['tb_footer_top_column'] : 4;
		$tb_footer_top_args['name'] = ($tb_footer_top_column>=2) ? 'Footer Top Widget %d' : 'Footer Top Widget 1';
		register_sidebars($tb_footer_top_column, $tb_footer_top_args);
		$tb_footer_bottom_args = array();
		$tb_footer_bottom_args = array(
			'id' => 'tbtheme-footer-bottom-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		);
		$tb_footer_bottom_column = isset($tb_options['tb_footer_bottom_column']) ? (int)$tb_options['tb_footer_bottom_column'] : 2;
		$tb_footer_bottom_args['name'] = ($tb_footer_bottom_column>=2) ? 'Footer Bottom Widget %d' : 'Footer Bottom Widget 1';
		register_sidebars($tb_footer_bottom_column, $tb_footer_bottom_args);
		if (class_exists ( 'Woocommerce' )) {
			register_sidebar(array(
				'name' => __('Mini Cart Sidebar', 'robusta'),
				'id' => 'tbtheme-mini-cart-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="wg-title">',
				'after_title' => '</h5>',
			)); 
		}
	}
}
add_action( 'init', 'tb_RegisterSidebar' );
/* Add Stylesheet And Script */
function tb_theme_enqueue_style() {
	global $tb_options;
	wp_enqueue_style( 'bootstrap.min', URI_PATH.'/assets/css/bootstrap.min.css', false );
	wp_enqueue_style('flexslider', URI_PATH . "/assets/vendors/flexslider/flexslider.css",array(),"");
	wp_enqueue_style('jquery.fancybox', URI_PATH . "/assets/vendors/FancyBox/jquery.fancybox.css",array(),"");
	wp_enqueue_style('font-awesome', URI_PATH.'/assets/css/font-awesome.min.css', array(), '4.1.0');
	wp_enqueue_style('font-ionicons', URI_PATH.'/assets/css/ionicons.min.css', array(), '1.5.2');
	wp_enqueue_style('robusta_icon', URI_PATH.'/assets/css/robusta_icon.css', array(), '1.0.0');
	wp_enqueue_style( 'tb.core.min', URI_PATH.'/assets/css/tb.core.min.css', false );
	wp_enqueue_style( 'style', URI_PATH.'/style.css', false );	
}
add_action( 'wp_enqueue_scripts', 'tb_theme_enqueue_style' );

function tb_theme_enqueue_script() {
	global $tb_options;
	$tb_smoothscroll =& $tb_options['tb_smoothscroll'];
	wp_enqueue_script("jquery");
	wp_enqueue_script( 'bootstrap.min', URI_PATH.'/assets/js/bootstrap.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'menu', URI_PATH.'/assets/js/menu.js', array('jquery'), '', true  );
	wp_enqueue_script( 'datepicker.min', URI_PATH.'/assets/js/datepicker.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'jquery.flexslider-min', URI_PATH.'/assets/vendors/flexslider/jquery.flexslider-min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'jquery.fancybox', URI_PATH.'/assets/vendors/FancyBox/jquery.fancybox.js', array('jquery') );
	wp_enqueue_script( 'parallax', URI_PATH.'/assets/js/parallax.js', array('jquery'), '', true  );
	if($tb_smoothscroll){
		wp_enqueue_script( 'SmoothScroll', URI_PATH.'/assets/js/SmoothScroll.js', array('jquery'), '', true );
	}
	wp_enqueue_script( 'main', URI_PATH.'/assets/js/main.js', array('jquery'), '', true  );
}
add_action( 'wp_enqueue_scripts', 'tb_theme_enqueue_script' );
function tb_Header() {
    global $tb_options,$post;
    $header_layout = $tb_options["tb_header_layout"];
    if($post){
        $tb_header = get_post_meta($post->ID, 'tb_header', true)?get_post_meta($post->ID, 'tb_header', true):'global';
        $header_layout = $tb_header=='global'?$header_layout:$tb_header;
    }
    switch ($header_layout) {
        case 'header-v1':
            get_template_part('framework/headers/header', 'v1');
            break;
		case 'header-v2':
            get_template_part('framework/headers/header', 'v2');
            break;
		default :
			get_template_part('framework/headers/header', 'v1');
			break;
    }
}
/* Style Inline */
function tb_add_style_inline() {
    global $tb_options;
    $custom_style = null;
    if ($tb_options['custom_css_code']) {
        $custom_style .= "{$tb_options['custom_css_code']}";
    }
	$path = URI_PATH;
    wp_enqueue_style('wp_custom_style', URI_PATH . '/assets/css/wp_custom_style.css',array('style'));
    
	/* Body background */
    $tb_background_color =& $tb_options['tb_background']['background-color'];
    $tb_background_image =& $tb_options['tb_background']['background-image'];
    $tb_background_repeat =& $tb_options['tb_background']['background-repeat'];
    $tb_background_position =& $tb_options['tb_background']['background-position'];
    $tb_background_size =& $tb_options['tb_background']['background-size'];
    $tb_background_attachment =& $tb_options['tb_background']['background-attachment'];
	$custom_style .= "body{ background-color: $tb_background_color;}";
	if($tb_background_image){
		$custom_style .= "body{ background: url('$tb_background_image') $tb_background_repeat $tb_background_attachment $tb_background_position;background-size: $tb_background_size;}";
	}
	/* Title bar background */
    $tb_title_bar_bg_color =& $tb_options['tb_title_bar_bg']['background-color'];
    $title_bar_bg_image =& $tb_options['tb_title_bar_bg']['background-image'];
    $title_bar_bg_repeat =& $tb_options['tb_title_bar_bg']['background-repeat'];
    $title_bar_bg_position =& $tb_options['tb_title_bar_bg']['background-position'];
    $title_bar_bg_size =& $tb_options['tb_title_bar_bg']['background-size'];
    $title_bar_bg_attachment =& $tb_options['tb_title_bar_bg']['background-attachment'];
	$custom_style .= ".ro-blog-header { background-color: $tb_title_bar_bg_color;}";
	if($title_bar_bg_image){
		$custom_style .= ".ro-blog-header { background: url('$title_bar_bg_image') $title_bar_bg_repeat $title_bar_bg_attachment $title_bar_bg_position;background-size: $title_bar_bg_size;}";
	}
    wp_add_inline_style( 'wp_custom_style', $custom_style );
    /*End Font*/
}
add_action( 'wp_enqueue_scripts', 'tb_add_style_inline' );
/* Less */
if(isset($tb_options['tb_less'])&&$tb_options['tb_less']){
    require_once ABS_PATH_FR.'/presets.php';
}
/* Widgets */
require_once ABS_PATH_FR.'/widgets/abstract-widget.php';
require_once ABS_PATH_FR.'/widgets/widgets.php';
/* Woo commerce function */
if (class_exists('Woocommerce')) {
    require_once ABS_PATH . '/woocommerce/wc-template-function.php';
    require_once ABS_PATH . '/woocommerce/wc-template-hooks.php';
}
