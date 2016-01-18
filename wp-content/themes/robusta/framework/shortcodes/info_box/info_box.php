<?php
function ro_info_box_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'img' => '',
		'title' => '',
		'desc' => '',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
	$class[] = 'ro-info-wrap';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="ro-info">
				<div class="ro-overlay"></div>
				<?php echo wp_get_attachment_image( $img, 'full' ); ?>
				<div class="ro-info-inner">
					<?php
						if($title) echo '<h4>'.esc_html($title).'</h4>';
						if($content) echo '<div class="ro-content">'.$content.'</div>';
					?>
				</div>
				<?php 
					$img_url = wp_get_attachment_image_src( $img, 'full' );
					if($img_url[0]) echo '<a class="ro-zoom-image" href="'.esc_url($img_url[0]).'"><i class="icon icon-resize-full"></i></a>';
				?>
			</div>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('info_box', 'ro_info_box_func');}
