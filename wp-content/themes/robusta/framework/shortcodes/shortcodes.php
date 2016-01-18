<?php
$elements = array(
	'video',
	'heading',
	'blog',
	'blog_list',
	'testimonial_slider',
	'service_box',
	'info_box',
	'menu_item',
	'blog_slider',
	'team_slider',
	'latest_news_slider',
	'video_fancybox_button',
	'countdown',
	'product_grid',
	'map_v3',
	
);

foreach ($elements as $element) {
	include($element .'/'. $element.'.php');
}

