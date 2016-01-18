<?php
global $tb_options;
$tb_post_show_post_image = (int) isset($tb_options['tb_post_show_post_image']) ? $tb_options['tb_post_show_post_image'] : 1;
$tb_post_show_post_title = (int) isset($tb_options['tb_post_show_post_title']) ? $tb_options['tb_post_show_post_title'] : 1;
$tb_post_show_post_meta = (int) isset($tb_options['tb_post_show_post_meta']) ? $tb_options['tb_post_show_post_meta'] : 1;
$tb_post_show_post_desc = (int) isset($tb_options['tb_post_show_post_desc']) ? $tb_options['tb_post_show_post_desc'] : 1;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="ro-blog-sub-article">
		<div class="ro-blog-header">
		<?php if ( has_post_thumbnail() && $tb_post_show_post_image ) { ?>
			<?php the_post_thumbnail('custom-blog-single-size'); ?>
		<?php } ?>
			<div class="ro-overlay">
				<?php if ( $tb_post_show_post_title ) { ?>
					<h5><?php the_title(); ?></h5>
				<?php } ?>
				<?php if ( $tb_post_show_post_meta ) { ?>
					<div class="ro-meta"><?php echo 'By '.get_the_author().' - '.human_time_diff( get_the_time('U'), current_time('timestamp') ).' ago'; ?></div>
					<?php
						$text_featured = get_post_meta(get_the_ID(), 'tb_text_featured', true);
						if($text_featured) echo '<h6><span>'.esc_html($text_featured).'</span></h6>';
					?>
					<div class="ro-tags"><?php the_tags( __('<i class="icon icon-tag"></i> <span>TAGS:</span> ', 'robusta'), ', ', '' ); ?> </div>
				<?php } ?>
				<?php if ( is_sticky() ) { ?>
					<span class="publish"><?php _e('<i class="fa fa-thumb-tack"></i> Sticky', 'robusta'); ?></span>
				<?php } ?>
			</div>
		</div>
		<?php if ( $tb_post_show_post_desc ) { ?> 
			<div class="ro-sub-content clearfix">
				<?php
					the_content();
					wp_link_pages(array(
						'before' => '<div class="page-links">' . __('Pages:', 'robusta'),
						'after' => '</div>',
					));
				?>
			</div>
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
	</div>
</article>