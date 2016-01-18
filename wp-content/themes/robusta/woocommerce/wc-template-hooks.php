<?php
/**
 * Content Wrappers
 *
 * @see woocommerce_output_content_wrapper()
 * @see woocommerce_output_content_wrapper_end()
 */
add_action( 'woocommerce_output_content_wrapper', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_output_content_wrapper_end', 'woocommerce_output_content_wrapper_end', 10 );
/**
 * Breadcrumbs
 *
 * @see woocommerce_breadcrumb()
 */
add_action( 'woocommerce_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
/**
 * Product Loop Items
 *
 * @see woocommerce_template_loop_add_to_cart()
 * @see woocommerce_template_loop_product_thumbnail()
 * @see woocommerce_template_loop_price()
 * @see woocommerce_template_loop_rating()
 */
add_action( 'woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_template_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_template_loop_product_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_template_loop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_template_loop_rating', 'woocommerce_template_loop_rating', 5 );

/**
 * Cart
 *
 * @see woocommerce_cross_sell_display()
 * @see woocommerce_cart_totals()
 * @see woocommerce_button_proceed_to_checkout()
 */
add_action( 'woocommerce_cross_sell_display', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_cart_totals', 'woocommerce_cart_totals', 10 );
add_action( 'woocommerce_button_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
