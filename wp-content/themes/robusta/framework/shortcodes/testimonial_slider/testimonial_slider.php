<?php
function ro_testimonial_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'show_image' => 0,
        'show_title' => 0,
        'show_excerpt' => 0,
        'show_quotation' => 0,
        'show_position' => 0,
    ), $atts));
			
    $class = array();
    $class[] = 'ro-testimonial-slider';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'testimonial',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'testimonial_category',
                                    'field' => 'id',
                                    'terms' => $category
                                )
                        );
    }
    $wp_query = new WP_Query($args);
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="ro-testimonial">
			<ul class="slides">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
					<li class="ro-item clearfix">
						<div class="ro-image">
							<?php if( has_post_thumbnail() && $show_image ) { the_post_thumbnail('full'); } ?>
						</div>
						<div class="ro-content">
							<?php if( $show_quotation ) echo '<h6 class="ro-quote">&ldquo; '.get_post_meta( get_the_ID(), 'tb_testimonial_quotation', true ).' &rdquo;</h6>'; ?>
							<?php if( $show_excerpt ) { ?>
								<div class="ro-excerpt"><?php the_excerpt(); ?></div>
							<?php } ?>
							<?php if( $show_title ) { ?>
								<h6 class="ro-title ro-font-size-7"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
							<?php } ?>
							<?php if( $show_position ) echo '<div class="ro-position">'.get_post_meta( get_the_ID(), 'tb_testimonial_position', true ).'</div>' ?>
							
						</div>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('testimonial_slider', 'ro_testimonial_slider_func'); }
