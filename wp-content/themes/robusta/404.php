<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header(); ?>
<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_page_show_page_title']) ? $tb_options['tb_page_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_page_show_page_breadcrumb']) ? $tb_options['tb_page_show_page_breadcrumb'] : 1;
ro_theme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);
?>
	<div class="main-content">
		<div class="container">
			<div class="ro-error404-wrap">
				<h1><?php _e('404','robusta');?></h1>
				<h3><?php _e('OOPS! - PAGE NOT FOUND','robusta');?></h3>
				<p><?php _e('<span class="ro-color-dark">We\'re really sorry!</span> Something went wrong trying to display the page, Please try one of these instead','robusta');?></p>
				<a class="ro-btn ro-btn-1" href="<?php echo esc_url( home_url( '/'  ) );?>"><?php _e('BACK TO HOMEPAGE','robusta');?></a>
			</div>
		</div>
	</div>
<?php get_footer(); ?>