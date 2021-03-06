<?php
function ro_blog_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'show_image' => 0,
        'show_title' => 0,
        'show_category' => 0,
        'show_meta' => 0,
        'show_btn_read_more' => 0,
    ), $atts));
			
    $class = array();
    $class[] = 'ro-blog-slider-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'post',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'category',
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
		<div class="ro-blog-slider flexslider ro-section-item">
			<ul class="slides">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<li class="ro-blog-slider-item">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
					<div class="ro-content">
						<h6 class="ro-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						<div class="ro-category"><?php the_terms(get_the_ID(), 'category', '' , ', ' ); ?></div>
						<div class="ro-meta"><?php echo get_the_author().' - '.get_the_date(); ?></div>
						<a class="icon icon-right-open-mini ro-read-more" href="<?php the_permalink(); ?>"></a>
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

if(function_exists('insert_shortcode')) { insert_shortcode('blog_slider', 'ro_blog_slider_func'); }
