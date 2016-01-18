<?php 
$attachment_image = wp_get_attachment_image_src($img, 'full', false);
if ( $attachment_image[0] ) echo '<img src="'.esc_url($attachment_image[0]).'" alt=""/>';
if ( $sub_text ) echo '<h6>'.esc_html($sub_text).'</h6>';
if ( $text ) echo '<h6>'.esc_html($text).'</h6>';
if ( $content ) echo '<div class="ro-content">'.$content.'</div>';
?>
