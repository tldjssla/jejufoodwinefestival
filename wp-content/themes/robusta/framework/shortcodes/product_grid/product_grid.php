<?php
function ro_products_grid_render($atts) {
    extract(shortcode_atts(array(
		'product_cat'       	=> '',
        'show'              	=> 'all_products',
        'number'            	=> -1,
        'show_title'        	=> 0,
        'show_price'        	=> 0,
        'hide_free'         	=> 0,
        'show_hidden'       	=> 0,
		'orderby'           	=> 'none',
        'order'             	=> 'none',
		'show_pagination' 		=> 1,
		'el_class' 				=> ''
    ), $atts));
	
	wp_enqueue_script('product.page.ajax', URI_PATH_FR . '/shortcodes/product_grid/ajax-page.js');
	wp_localize_script( 'product.page.ajax', 'variable_js', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
	$data_params = $atts;
	
    $class = array();
    $class[] = 'woocommerce ro-products-grid';
	$class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $query_args = array(
            'posts_per_page' => $number,
			'paged' 		 => $paged,
            'post_status' 	 => 'publish',
            'post_type' 	 => 'product',
            //'no_found_rows'  => 1,
            'order'          => $order
    );

    $query_args['meta_query'] = array();

    if ( empty( $show_hidden ) ) {
                    $query_args['meta_query'][] = WC()->query->visibility_meta_query();
                    $query_args['post_parent']  = 0;
            }

            if ( ! empty( $hide_free ) ) {
            $query_args['meta_query'][] = array(
                        'key'     => '_price',
                        'value'   => 0,
                        'compare' => '>',
                        'type'    => 'DECIMAL',
                    );
    }

    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

    if (isset($product_cat) && $product_cat != '') {
        $cats = explode(',', $product_cat);
        $product_cat = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;

        $query_args['tax_query'] = array(
                    array(
                            'taxonomy' 		=> 'product_cat',
                            'terms' 		=> $category,
                            'field' 		=> 'id',
                            'operator' 		=> 'IN'
                    )
        );
    }
    switch ( $show ) {
            case 'featured' :
                    $query_args['meta_query'][] = array(
                                    'key'   => '_featured',
                                    'value' => 'yes'
                            );
                    break;
            case 'onsale' :
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                            $product_ids_on_sale[] = 0;
                            $query_args['post__in'] = $product_ids_on_sale;
                    break;
    }
    switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
				$query_args['orderby']  = 'rand';
				break;
			case 'sales' :
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'name' :
				$query_args['orderby'] = 'title';
				break;
			default :
				$query_args['orderby']  = 'date';
    }

    $wp_query = new WP_Query( $query_args );
	ob_start();	
	if ( $wp_query->have_posts() ) {
    ?>
    <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="ro-products" data-params="<?php echo esc_attr(json_encode($data_params)); ?>">
			<div class="ro-product-items row">
			<?php
				while ( $wp_query->have_posts() ) { $wp_query->the_post();
					?>
						<div class="col-md-6 col-lg-4">
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
									<?php if( $show_title ) { ?>
										<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
									<?php } ?>
									<?php if( $show_price ) do_action( 'woocommerce_template_loop_price' ); ?>
								</div>
							</article>
						</div>
					<?php
				}
			?>
			<div style="clear: both;"></div>
			</div>
		</div>
        <?php if($show_pagination && $wp_query->max_num_pages > 1){ ?>
			<nav class="pagination text-center" role="navigation">
				<?php
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'robusta' ),
						'next_text' => __( '<i class="fa fa-angle-right"></i>', 'robusta' ),
					) );
				?>
			</nav>
		<?php } ?> 
    </div>
    <?php
    }else {
		echo 'Post not found!';
    } 
    ?>
    
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('products-grid', 'ro_products_grid_render'); }

add_action( 'wp_ajax_nopriv_ro_render_products_grid', 'ro_render_products_grid' );
add_action( 'wp_ajax_ro_render_products_grid', 'ro_render_products_grid' );

function ro_render_products_grid() {
	// print_r($_POST);exit;
	extract($_POST['params']);
	$paged = $_POST['paged'];
	$query_args = array(
            'posts_per_page' => $number,
			'paged' 		 => $paged,
            'post_status' 	 => 'publish',
            'post_type' 	 => 'product',
            //'no_found_rows'  => 1,
            'order'          => $order
    );

    $query_args['meta_query'] = array();

    if ( empty( $show_hidden ) ) {
                    $query_args['meta_query'][] = WC()->query->visibility_meta_query();
                    $query_args['post_parent']  = 0;
            }

            if ( ! empty( $hide_free ) ) {
            $query_args['meta_query'][] = array(
                        'key'     => '_price',
                        'value'   => 0,
                        'compare' => '>',
                        'type'    => 'DECIMAL',
                    );
    }

    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

    if (isset($product_cat) && $product_cat != '') {
        $cats = explode(',', $product_cat);
        $product_cat = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;

        $query_args['tax_query'] = array(
                    array(
                            'taxonomy' 		=> 'product_cat',
                            'terms' 		=> $category,
                            'field' 		=> 'id',
                            'operator' 		=> 'IN'
                    )
        );
    }
    switch ( $show ) {
            case 'featured' :
                    $query_args['meta_query'][] = array(
                                    'key'   => '_featured',
                                    'value' => 'yes'
                            );
                    break;
            case 'onsale' :
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                            $product_ids_on_sale[] = 0;
                            $query_args['post__in'] = $product_ids_on_sale;
                    break;
    }
    switch ( $orderby ) {
			case 'price' :
					$query_args['meta_key'] = '_price';
			$query_args['orderby']  = 'meta_value_num';
					break;
			case 'rand' :
			$query_args['orderby']  = 'rand';
					break;
			case 'sales' :
					$query_args['meta_key'] = 'total_sales';
			$query_args['orderby']  = 'meta_value_num';
					break;
			case 'name' :
				$query_args['orderby'] = 'title';
				break;
			default :
					$query_args['orderby']  = 'date';
    }

    $wp_query = new WP_Query( $query_args );
    ob_start();	
	if ( $wp_query->have_posts() ) {
		while ( $wp_query->have_posts() ) { $wp_query->the_post();
			?>
				<div class="col-md-6 col-lg-4">
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
							<?php if( $show_title ) { ?>
								<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
							<?php } ?>
							<?php if( $show_price ) do_action( 'woocommerce_template_loop_price' ); ?>
						</div>
					</article>
				</div>
			<?php
		}
	}
	wp_reset_postdata();
    $product_list_content = ob_get_clean(); 
    
    
	$big = 999999999; // need an unlikely integer
	ob_start();	
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged  ),
		'total' => $wp_query->max_num_pages,
		'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'robusta' ),
		'next_text' => __( '<i class="fa fa-angle-right"></i>', 'robusta' ),
	) );
	$nav_content = ob_get_clean(); 			    
    
    echo json_encode(array( "products_content" => $product_list_content, "nav_content" => $nav_content)); exit;
}