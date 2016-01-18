<?php
function ro_heading_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'tpl' => 'tpl1',
        'img' => '',
		'text' => '',
        'sub_text' => '',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);

    $class = array();
    $class[] = 'ro-hr-heading';
    $class[] = $tpl;
    $class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<?php include $tpl.'.php'; ?>
		</div>
    <?php
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('heading', 'ro_heading_func'); }
