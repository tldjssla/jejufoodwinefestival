<?php
function ro_blog_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'columns' =>  3,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'img' => '',
		'show_title' => 0,
        'show_excerpt' => 0,
		'excerpt_lenght' => 18,
        'excerpt_more' => '... ',
        'read_more_text' => '',
		'show_meta' => 0,
		'show_actions' => 0,
        'text_featured' => '',
    ), $atts));
			
    $class = array();
    $class[] = 'ro-blog-wrapper clearfix';
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
		$class_columns = '';
		switch ($columns) {
			case 1:
				$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				break;
			case 2:
				$class_columns = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
				break;
			case 3:
				$class_columns = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
				break;
			case 4:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
			default:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
		}
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<?php $count = 0; while ( $wp_query->have_posts() ) { $wp_query->the_post(); $count++ ?>
				<div class="<?php echo esc_attr($class_columns); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="ro-blog-item">
							<?php if($count == 1 && $text_featured) echo '<span class="ro-first-item">'.esc_html($text_featured).'</span>'; ?>
							<?php if (has_post_thumbnail()) the_post_thumbnail('custom-blog-grid-size');  ?>
							<div class="ro-content-overlay">
								<?php if ( $img ) echo '<div class="ro-logo">'.wp_get_attachment_image( $img, 'full' ).'</div>'; ?>
								<?php if ( $show_title ) { ?>
									<h6 class="ro-font-size-7"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
								<?php } ?>
								<?php if ( $show_meta ) { ?>
									<div class="ro-meta"><?php echo 'By '.get_the_author().' - '.human_time_diff( get_the_time('U'), current_time('timestamp') ).' ago'; ?></div>
								<?php } ?>
								<?php if ( $show_excerpt ) { ?>
									<div class="ro-excerpt">
										<?php echo ro_custom_excerpt($excerpt_lenght, $excerpt_more); if ($read_more_text) echo '<a href="'.get_the_permalink().'">'.esc_html($read_more_text).'</a>'; ?>
									</div>
								<?php } ?>
								<?php if ( $show_actions ) { ?>
									<ul>
										<li><?php post_favorite(); ?></li>
										<li><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?> <i class="icon icon-chat"></i> <span>comments</span></a></li>
										<?php $share_all = pssc_facebook( get_the_ID() ) + pssc_twitter( get_the_ID() ) + pssc_pinterest( get_the_ID() ); ?>
										<li><a href="<?php the_permalink(); ?>"><?php echo $share_all; ?> <i class="icon icon-share"></i> <span>shares</span></a></li>
									</ul>
								<?php } ?>
							</div>
						</div>
					</article>
				</div>
			<?php } ?>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('blog', 'ro_blog_func'); }
