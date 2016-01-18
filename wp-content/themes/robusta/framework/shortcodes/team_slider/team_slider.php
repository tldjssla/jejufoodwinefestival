<?php
function ro_team_slider_func($atts, $content = null) {
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
    $class[] = 'ro-team-slider-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'team',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'team_category',
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
		<h5>
			<span class="icon icon-shutterstock-166641992-converted-33"></span>
			HEART DISEASES
		</h5>
		<div class="ro-team-slider flexslider ro-section-item">
			<ul class="slides">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<li class="ro-team-slider-item">
					<div class="ro-item-inner">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } ?>
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<div class="ro-excerpt"><?php the_excerpt(); ?></div>
						<div class="ro-hr"></div>
						<div class="ro-meta">
							<div class="ro-phone">8410.058.9860; branch 1</div>
							<div class="ro-email">dr.micheprino@gmail.com</div>
							<div class="ro-address">Block 2/126, 12 st. NYC</div>
						</div>
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

if(function_exists('insert_shortcode')) { insert_shortcode('team_slider', 'ro_team_slider_func'); }
