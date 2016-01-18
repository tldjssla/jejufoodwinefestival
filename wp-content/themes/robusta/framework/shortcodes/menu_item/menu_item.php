<?php
function ro_menu_item_box_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'title' => '',
		'text_featured' => '',
		'desc' => '',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
	$class[] = 'ro-menu-item-wrap';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="ro-menu-item">
				<?php
					if($text_featured) $text_featured = '<span>'.esc_html($text_featured).'</span>';
					if($title) echo '<h6>'.esc_html($title).$text_featured.'</h6>';
					if($content) echo '<div class="ro-content">'.$content.'</div>';
				?>
			</div>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('menu_item', 'ro_menu_item_box_func');}
