		<?php
		wp_reset_postdata();
		global $tb_options, $post;
		$tb_footer = get_post_meta($post->ID, 'tb_footer', true);
		?>
		<footer id="footer" class="ro-footer <?php echo $tb_footer; ?>">
			<!-- Start Footer Top -->
			<?php if($tb_options['tb_footer_top_column']){ ?>
			<div class="ro-footer-top">
				<div class="container">
					<div class="row same-height">
						<!-- Start Footer Sidebar Top 1 -->
						<?php if($tb_options['tb_footer_top_column']>=1){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_col1']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-widget")) { dynamic_sidebar("Footer Top Widget 1"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 1 -->
						<!-- Start Footer Sidebar Top 2 -->
						<?php if($tb_options['tb_footer_top_column']>=2){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_col2']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-widget-2")) { dynamic_sidebar("Footer Top Widget 2"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 2 -->
						<!-- Start Footer Sidebar Top 3 -->
						<?php if($tb_options['tb_footer_top_column']>=3){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_col3']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-widget-3")) { dynamic_sidebar("Footer Top Widget 3"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 3 -->
						<!-- Start Footer Sidebar Top 4 -->
						<?php if($tb_options['tb_footer_top_column']>=4){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_col4']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-widget-4")) { dynamic_sidebar("Footer Top Widget 4"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 4 -->
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- End Footer Top -->
			<!-- Start Footer Bottom -->
			<?php if($tb_options['tb_footer_bottom_column']){ ?>
			<div class="ro-footer-bottom">
				<div class="container">
					<div class="row">
						<!-- Start Footer Sidebar Bottom Left -->
						<?php if($tb_options['tb_footer_bottom_column']>=1){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_bottom_col1']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-bottom-widget")) { dynamic_sidebar("Footer Bottom Widget 1"); } ?>
							</div>
						<?php } ?>
						<!-- Start Footer Sidebar Bottom Left -->
						<!-- Start Footer Sidebar Bottom Right -->
						<?php if($tb_options['tb_footer_bottom_column']>=2){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_bottom_col2']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-bottom-widget-2")) { dynamic_sidebar("Footer Bottom Widget 2"); } ?>
							</div>
						<?php } ?>
						<!-- Start Footer Sidebar Bottom Right -->
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- End Footer Bottom -->
		</footer>
	</div><!-- #wrap -->
	<div id="ro-backtop"><i class="icon-up"></i></div>
	<?php wp_footer(); ?>
</body>