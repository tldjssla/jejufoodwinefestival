<?php
/**
 * Single Product title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$sub_title = get_post_meta( get_the_ID(), 'ro_sub_title', true );
?>
<h6 class="ro-title-description"><?php _e('PRODUCT\'S DESCRIPTION', 'woocommerce'); ?></h6>
<h3 class="ro-title"><?php the_title(); ?></h3>
<?php if($sub_title) echo '<h6 class="ro-sub-title">'.$sub_title.'</h6>'; ?>
