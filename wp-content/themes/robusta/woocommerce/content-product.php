<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="col-sm-6 col-md-3">
	<article <?php post_class(); ?>>

		<div class="ro-item-image">
			<?php do_action( 'woocommerce_template_loop_product_thumbnail' ); ?>
			<div class="ro-overlay">
				<div class="ro-btns">
					<?php do_action( 'woocommerce_template_loop_add_to_cart' ); ?>
					<?php echo '<a class="ro-readmore-button" href="'.get_the_permalink().'">Read More</a>' ?>
				</div>
			</div>
		</div>
		<div class="ro-item-content">
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<?php do_action( 'woocommerce_template_loop_price' ); ?>
		</div>
	</article>
</div>
