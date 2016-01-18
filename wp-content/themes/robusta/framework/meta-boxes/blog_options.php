<div id="tb-blog-loading" class="tb_loading" style="display: block;">
	<div id="followingBallsG">
	<div id="followingBallsG_1" class="followingBallsG">
	</div>
	<div id="followingBallsG_2" class="followingBallsG">
	</div>
	<div id="followingBallsG_3" class="followingBallsG">
	</div>
	<div id="followingBallsG_4" class="followingBallsG">
	</div>
	</div>
</div>
<div id="tb-blog-metabox" class='tb_metabox' style="display: none;">
	<div id="tb-tab-blog" class='categorydiv'>
		<ul class='category-tabs'>
		   <li class='tb-tab'><a href="#tabs-general"><i class="dashicons dashicons-admin-settings"></i> <?php echo _e('GENERAL','robusta');?></a></li>
		</ul>
		<div class='tb-tabs-panel'>
			<div id="tabs-general">
				<p class="tb_header tb-title-mb"><i class="dashicons dashicons-menu"></i><?php echo _e('Header Setting','robusta'); ?></p>
				<?php
					$headers = array('global' => 'Global', 'header-v1' => 'Header V1','header-v2' => 'Header V2');
					$this->select('header',
							'Header',
							$headers,
							'',
							''
					);
				?>
				<p class="tb_footer tb-title-mb"><i class="dashicons dashicons-menu"></i><?php echo _e('Footer Setting','robusta'); ?></p>
				<?php
					$footer = array('footer-dark' => 'Footer Dark', 'footer-white' => 'Footer White');
					$this->select('footer',
							'Footer Style',
							$footer,
							'',
							''
					);
				?>
				<p class="tb_info  tb-title-mb"><i class="dashicons dashicons-admin-settings"></i><?php echo _e('Background Title Bar','robusta'); ?></p>
				<?php
					$this->upload('bg_title_bar', 'Choose image');
				?>
				<p class="tb_info  tb-title-mb"><i class="dashicons dashicons-megaphone"></i><?php echo _e('Manage Locations','robusta'); ?></p>
				<?php
					$manage_location = array(''=>'Auto','main_navigation'=>'Main Navigation','secondary_navigation'=>'Secondary Navigation');
					$this->select('manage_location',
							'Manage Locations',
							$manage_location,
							'',
							''
					);
				?>
			</div>
		</div>
	</div>
</div>