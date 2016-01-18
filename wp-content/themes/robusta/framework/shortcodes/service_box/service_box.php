<?php
function ro_service_box_func($atts) {
    extract(shortcode_atts(array(
		'style' => 'style1',
		'icon' => '',
		'title' => '',
        'desc' => '',
        'ex_link' => '#',
        'el_class' => ''
    ), $atts));

    $class = array();
	$class[] = 'ro-service-wrap';
	$class[] = $style;
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<a href="<?php echo esc_url($ex_link); ?>">
				<div class="ro-service clearfix">
					<?php 
						if($icon) echo '<span><i class="'.esc_attr($icon).'"></i></span>';
						if($title) echo '<h6>'.esc_html($title).'</h6>';
						if($desc) echo '<p>'.esc_html($desc).'</p>';
					?>
				</div>
			</a>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('service_box', 'ro_service_box_func');}
