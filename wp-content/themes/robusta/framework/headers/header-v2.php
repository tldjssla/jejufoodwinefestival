<?php
	global $tb_options;
	$cl_stick = $tb_options['tb_header_stick'] ? ' ro-header-stick': '';
?>
<!-- Start Header -->
<header>
	<div class="ro-header-v2 ro-header-fixed<?php echo esc_attr($cl_stick) ?>"><!-- ro-header-stick/ro-header-fixed -->
		<div class="container">
			<div class="row">
				<div class="col-md-1">
					<div class="ro-logo">
						<a href="<?php echo esc_url(home_url()); ?>">
							<?php ro_theme_logo('v2'); ?>
						</a>
					</div>
					<div id="ro-hamburger" class="ro-hamburger visible-xs visible-sm"><span></span></div>
				</div>
				<div class="col-md-11">
					<?php
					$manage_location = get_post_meta(get_the_ID(), 'tb_manage_location', true);
					if ( !$manage_location ) {
						$manage_location = $tb_options['tb_manage_location'];
					}
					$arr = array(
						'theme_location' => $manage_location,
						'menu_id' => 'nav',
						'menu' => '',
						'container_class' => 'ro-menu-list hidden-xs hidden-sm',
						'menu_class'      => 'text-right',
						'echo'            => true,
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
					);
					if ($manage_location) {
						wp_nav_menu( $arr );
					} else { ?>
					<div class="menu-list-default">
						<?php wp_page_menu();?>
					</div>    
					<?php } ?>
					<?php if (is_active_sidebar("tbtheme-mini-cart-sidebar")) dynamic_sidebar("Mini Cart Sidebar"); ?>
					<?php if (is_active_sidebar("tbtheme-menu-sidebar")) { ?>
						<div class="ro-menu-sidebar hidden-sm hidden-xs">
							<a href="javascript:void(0)"><i class="icon icon-menu"></i></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="ro-menu-canvas-overlay"></div>
<div class="ro-menu-canvas">
	<?php dynamic_sidebar("Menu Sidebar"); ?>
</div>
<!-- End Header -->