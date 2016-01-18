<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<?php 
		foreach ( $tabs as $key => $tab ) {
			if($key == 'reviews'){
				?>
					<h6 class="ro-reviews-title"><span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span></h6>
					<div class="ro-reviews-content">
						<?php call_user_func( $tab['callback'], $key, $tab ); ?>
					</div>
				<?php
			}
			
		} 
	?>

<?php endif; ?>
