<?php
function ro_blog_list_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
		'show_pagination' => 0,
        'el_class' => '',
		'show_title' => 0,
        'show_excerpt' => 0,
        'excerpt_lenght' => 50,
        'excerpt_more' => '... ',
        'read_more_text' => '',
		'show_meta' => 0,
		'show_actions' => 0,
    ), $atts));
	
    $class = array();
    $class[] = 'ro-blog-list-wrapper clearfix';
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
		<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="ro-blog-item">
					<?php if ( $show_title ) { ?>
						<h5 class="clearfix">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php
								$text_featured = get_post_meta(get_the_ID(), 'tb_text_featured', true);
								if($text_featured) echo '<span>'.esc_html($text_featured).'</span>';
							?>
						</h5>
					<?php } ?>
					<?php if ( $show_meta ) { ?>
						<div class="ro-meta"><?php echo 'By '.get_the_author().' - '.human_time_diff( get_the_time('U'), current_time('timestamp') ).' ago'; ?></div>
					<?php } ?>
					<?php if (has_post_thumbnail()) the_post_thumbnail('custom-blog-list-size');  ?>
					<?php if ( $show_excerpt ) { ?>
						<div class="ro-excerpt">
							<?php echo ro_custom_excerpt($excerpt_lenght, $excerpt_more); if ($read_more_text) echo '<a href="'.get_the_permalink().'">'.esc_html($read_more_text).'</a>'; ?>
						</div>
					<?php } ?>
					<?php if ( $show_actions ) { ?>
						<div class="ro-actions clearfix">
							<ul class="pull-left">
								<li><?php post_favorite(); ?></li>
								<li><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?> <i class="icon icon-chat"></i> <span>comments</span></a></li>
								<?php $share_all = pssc_facebook( get_the_ID() ) + pssc_twitter( get_the_ID() ) + pssc_pinterest( get_the_ID() ); ?>
								<li><a href="<?php the_permalink(); ?>"><?php echo $share_all; ?> <i class="icon icon-share"></i> <span>shares</span></a></li>
							</ul>
							<ul class="ro-share pull-right">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="icon icon-facebook"></i></a></li>
								<li><a href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="icon icon-twitter"></i></a></li>
								<li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"><i class="icon icon-pinterest"></i></a></li>
							</ul>
						</div>
					<?php } ?>
					<?php 
						$extra_img = get_post_meta(get_the_ID(), 'tb_extra_img_url', true);
						if($extra_img) echo '<div class="ro-extra-img"><a href="#"><img alt="extra_img" src="'.esc_url($extra_img).'"></a></div>';
					?>
				</div>
			</article>
		<?php } ?>
		<div style="clear: both;"></div>
		<?php if ($show_pagination) { ?>
			<nav class="ro-pagination <?php echo esc_attr($pos_pagination); ?>" role="navigation">
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
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('blog_list', 'ro_blog_list_func'); }
