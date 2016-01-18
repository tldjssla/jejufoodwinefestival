<?php
/**
 * ReduxFramework Theme Config File
 * For full documentation, please visit: https://docs.reduxframework.com
 * */

if ( ! class_exists( 'Redux_Framework_theme_config' ) ) {

	class Redux_Framework_theme_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
			add_action( 'admin_enqueue_scripts', array( $this, 'ro_theme_add_scripts' ));

		}
		public function ro_theme_add_scripts(){
			wp_enqueue_script( 'action', URI_PATH_ADMIN.'/assets/js/action.js', false );
			wp_enqueue_style( 'style_admin', URI_PATH_ADMIN.'/assets/css/style_admin.css', false );
		}
		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			//$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			//add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

			// Function to test the compiler hook and demo CSS output.
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

			// Change the default value of a field after it's been set, but before it's been useds
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

			// Dynamically add a section. Can be also used to modify sections/fields
			//add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		/**
		 * This is a test function that will let you see when the compiler hook occurs.
		 * It only runs if a field    set with compiler=>true is changed.
		 * */
		function compiler_action( $options, $css, $changed_values ) {
			echo '<h1>The compiler hook has run!</h1>';
			echo "<pre>";
			print_r( $changed_values ); // Values that have changed since the last save
			echo "</pre>";
			//print_r($options); //Option values
			//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

			/*
		  // Demo of how to use the dynamic CSS and write your own static CSS file
		  $filename = dirname(__FILE__) . '/style' . '.css';
		  global $wp_filesystem;
		  if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
		  WP_Filesystem();
		  }

		  if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename,
				$css,
				FS_CHMOD_FILE // predefined mode settings for WP files
			);
		  }
		 */
		}

		/**
		 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 * Simply include this function in the child themes functions.php file.
		 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 * so you must use get_template_directory_uri() if you want to use any of the built in icons
		 * */
		function dynamic_section( $sections ) {
			//$sections = array();
			$sections[] = array(
				'title'  => __( 'Section via hook', 'robusta' ),
				'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'robusta' ),
				'icon'   => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**
		 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
		 * */
		function change_arguments( $args ) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**
		 * Filter hook for filtering the default value of any given field. Very useful in development mode.
		 * */
		function change_defaults( $defaults ) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array(
					ReduxFrameworkPlugin::instance(),
					'plugin_metalinks'
				), null, 2 );

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}

		public function setSections() {

			/**
			 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 * */
			// Background Patterns Reader
			$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns      = array();

			if ( is_dir( $sample_patterns_path ) ) :

				if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
					$sample_patterns = array();

					while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

						if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
							$name              = explode( '.', $sample_patterns_file );
							$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
							$sample_patterns[] = array(
								'alt' => $name,
								'img' => $sample_patterns_url . $sample_patterns_file
							);
						}
					}
				endif;
			endif;

			ob_start();

			$ct          = wp_get_theme();
			$this->theme = $ct;
			$item_name   = $this->theme->get( 'Name' );
			$tags        = $this->theme->Tags;
			$screenshot  = $this->theme->get_screenshot();
			$class       = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'robusta' ), $this->theme->display( 'Name' ) );

			?>
			<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $screenshot ) : ?>
					<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
						<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
						   title="<?php echo esc_attr( $customize_title ); ?>">
							<img src="<?php echo esc_url( $screenshot ); ?>"
								 alt="<?php esc_attr_e( 'Current theme preview', 'robusta' ); ?>"/>
						</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
						 alt="<?php esc_attr_e( 'Current theme preview', 'robusta' ); ?>"/>
				<?php endif; ?>

				<h4><?php echo esc_html( $this->theme->display( 'Name' ) ); ?></h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __( 'By %s', 'robusta' ), $this->theme->display( 'Author' ) ); ?></li>
						<li><?php printf( __( 'Version %s', 'robusta' ), $this->theme->display( 'Version' ) ); ?></li>
						<li><?php echo '<strong>' . __( 'Tags', 'robusta' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
					</ul>
					<p class="theme-description"><?php echo esc_html( $this->theme->display( 'Description' ) ); ?></p>
					<?php
						if ( $this->theme->parent() ) {
							printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'robusta' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'robusta' ), $this->theme->parent()->display( 'Name' ) );
						}
					?>

				</div>
			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			$sampleHTML = '';
			if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
				Redux_Functions::initWpFilesystem();

				global $wp_filesystem;

				$sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
			}
			
			$of_options_fontsize = array("8px" => "8px", "9px" => "9px", "10px" => "10px", "11px" => "11px", "12px" => "12px", "13px" => "13px", "14px" => "14px", "15px" => "15px", "16px" => "16px", "17px" => "17px", "18px" => "18px", "19px" => "19px", "20px" => "20px", "21px" => "21px", "22px" => "22px", "23px" => "23px", "24px" => "24px", "25px" => "25px", "26px" => "26px", "27px" => "27px", "28px" => "28px", "29px" => "29px", "30px" => "30px", "31px" => "31px", "32px" => "32px", "33px" => "33px", "34px" => "34px", "35px" => "35px", "36px" => "36px", "37px" => "37px", "38px" => "38px", "39px" => "39px", "40px" => "40px");
			$of_options_font = array("1" => "Google Font", "2" => "Standard Font", "3" => "Custom Font");
			
			//Google font API
			$of_options_google_font = array();
			if (is_admin()) {
				$results = '';
				$whitelist = array('127.0.0.1','::1');
				if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
					$results = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=AIzaSyDnf-ujK_DUCihfvzqdlBokan6zbnrJbi0');
					if (!is_wp_error($results)) {
							$results = json_decode($results['body']);
							if(isset($results->items)){
								foreach ($results->items as $font) {
									$of_options_google_font[$font->family] = $font->family;
								}
							}
					}
				}
			}
			//Standard Fonts
			$of_options_standard_fonts = array(
				'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
				"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
				"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
				"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
				"Courier, monospace" => "Courier, monospace",
				"Garamond, serif" => "Garamond, serif",
				"Georgia, serif" => "Georgia, serif",
				"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
				"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
				"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
				"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
				"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
				"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
				"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
				"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
			);
			// Custom Font
			$fonts = array();
			$of_options_custom_fonts = array();
			$font_path = get_template_directory() . "/fonts";
			if (!$handle = opendir($font_path)) {
				$fonts = array();
			} else {
				while (false !== ($file = readdir($handle))) {
					if (strpos($file, ".ttf") !== false ||
						strpos($file, ".eot") !== false ||
						strpos($file, ".svg") !== false ||
						strpos($file, ".woff") !== false
					) {
						$fonts[] = $file;
					}
				}
			}
			closedir($handle);

			foreach ($fonts as $font) {
				$font_name = str_replace(array('.ttf', '.eot', '.svg', '.woff'), '', $font);
				$of_options_custom_fonts[$font_name] = $font_name;
			}
			/* remove dup item */
			$of_options_custom_fonts = array_unique($of_options_custom_fonts);
			
			/*Sidebar option*/
			$of_options_sidebar = array("Main Sidebar" => "Main Sidebar", "Blog Left Sidebar" => "Blog Left Sidebar", "Blog Right Sidebar" => "Blog Right Sidebar", "Custom Sidebar 1" => "Custom Sidebar 1", "Custom Sidebar 2" => "Custom Sidebar 2", "Custom Sidebar 3" => "Custom Sidebar 3", "Custom Sidebar 4" => "Custom Sidebar 4");
			
			/*General Setting*/
			$this->sections[] = array(
				'title'  => __( 'General Setting', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-cogs',
				'fields' => array(
					array(
						'id'       => 'tb_less',
						'type'     => 'switch',
						'title'    => __( 'Less Design', 'robusta' ),
						'subtitle' => __( 'Use the less design features.', 'robusta' ),
						'default'  => false,
					),
					array(
						'id'       => 'tb_smoothscroll',
						'type'     => 'switch',
						'title'    => __( 'Smoothscroll', 'robusta' ),
						'subtitle' => __( 'Use the smoothscroll in your site.', 'robusta' ),
						'default'  => false,
					),
					array(
						'id'       => 'tb_background',
						'type'     => 'background',
						'title'    => __('Body Background', 'robusta'),
						'subtitle' => __('Body background with image, color, etc.', 'robusta'),
						'default'  => array(
							'background-color' => '#ffffff',
						)
					),
					array(
						'id'       => 'tb_google_analytic',
						'type'     => 'switch',
						'title'    => __( 'Google Analytic', 'robusta' ),
						'subtitle' => __( 'Use the Google Analytic in your site.', 'robusta' ),
						'default'  => false,
					),
					array(
						'id'       => 'tb_tracking_id',
						'type'     => 'text',
						'title'    => __('Tracking ID', 'robusta'),
						'subtitle' => __('Please, enter Tracking ID.', 'robusta'),
						'required' => array( 'tb_google_analytic', "=", 1 ),
						'default'  => ''
					),
				)
				
			);
			/*Logo*/
			$this->sections[] = array(
				'title'  => __( 'Logo', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-viadeo',
				'fields' => array(
					array(
						'id'       => 'tb_favicon_image',
						'type'     => 'media',
						'url'      => true,
						'title'    => __('Favicon Image', 'robusta'),
						'subtitle' => __('Select an image file for your favicon.', 'robusta'),
						'default'  => array(
							'url'	=> URI_PATH.'/favicon.ico'
						),
					),
					array(
						'id'       => 'tb_logo_image_hv1',
						'type'     => 'media',
						'url'      => true,
						'title'    => __('Logo Image Heder 1', 'robusta'),
						'subtitle' => __('Select an image file for your logo.', 'robusta'),
						'default'  => array(
							'url'	=> URI_PATH.'/assets/images/logo-v1.png'
						),
					),
					array(
						'id'       => 'tb_logo_image_hv2',
						'type'     => 'media',
						'url'      => true,
						'title'    => __('Logo Image Heder 2', 'robusta'),
						'subtitle' => __('Select an image file for your logo.', 'robusta'),
						'default'  => array(
							'url'	=> URI_PATH.'/assets/images/logo-v2.png'
						),
					),
					
				)
				
			);
			/*Header*/
			$this->sections[] = array(
				'title'  => __( 'Header', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-file-edit',
				'fields' => array(
					array( 
						'id'       => 'tb_header_layout',
						'type'     => 'image_select',
						'title'    => __('Header Layout', 'robusta'),
						'subtitle' => __('Select header layout in your site.', 'robusta'),
						'options'  => array(
							'header-v1'	=> array(
									'alt'   => 'Header V1',
									'img'   => URI_PATH.'/assets/images/headers/header-v1.png'
								),
							'header-v2'	=> array(
										'alt'   => 'Header V2',
										'img'   => URI_PATH.'/assets/images/headers/header-v2.png'
									),
						),
						'default' => 'header-v1'
					),
					array(
						'id'       => 'tb_header_stick',
						'type'     => 'switch',
						'title'    => __( 'Header Stick', 'robusta' ),
						'subtitle' => __( 'Enable header stick.', 'robusta' ),
						'default'  => false,
					),
					array(
						'id'       => 'tb_manage_location',
						'type'     => 'select',
						'title'    => __('Manage Location', 'robusta'),
						'subtitle' => __('Select manage location of menu in this header.', 'robusta'),
						'options'  => array(
							'' => 'Auto Navigation',
							'main_navigation' => 'Main Navigation',
							'secondary_navigation' => 'Secondary Navigation'
						),
						'default'  => '',
					),
				)
			);
			/*Menu Header V1*/
			$this->sections[] = array(
				'title'  => __( 'Menu Header V1', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-list',
			);
			$this->sections[] = array(
				'title'  => __( 'First Level', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'          => 'tb_first_level_font_hv1',
						'type'        => 'typography', 
						'title'       => __('Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('.ro-header-v1 .ro-menu-list > ul > li > a, .ro-header-v2 .ro-menu-list > ul > li > a'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#fff', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '12px', 
							'line-height' => '61px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id' => 'tb_first_level_padding_hv1',
						'title' => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding.', 'robusta'),
						'type' => 'spacing',
						'mode' => 'padding',
						'units' => array('px'),
						'output' => array('.ro-header-v1 .ro-menu-list > ul > li > a'),
						'default' => array(
							'padding-top'     => '0px', 
							'padding-right'   => '15px', 
							'padding-bottom'  => '0px', 
							'padding-left'    => '15px',
							'units'          => 'px', 
						)
					),
				)
			);
			$this->sections[] = array(
				'title'  => __( 'Sub Level', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'          => 'tb_sub_level_font_hv1',
						'type'        => 'typography', 
						'title'       => __('Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('.ro-header-v1 .ro-menu-list > ul > li.menu-item-has-children > ul > li a'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#fff', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '12px', 
							'line-height' => '26.4px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id' => 'tb_sub_level_padding_hv1',
						'title' => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding.', 'robusta'),
						'type' => 'spacing',
						'mode' => 'padding',
						'units' => array('px'),
						'output' => array('.ro-header-v1 .ro-menu-list > ul > li.menu-item-has-children > ul > li > a'),
						'default' => array(
							'padding-top'     => '10px', 
							'padding-right'   => '10px', 
							'padding-bottom'  => '10px', 
							'padding-left'    => '20px',
							'units'          => 'px', 
						)
					),
					
				)
			);
			/*Menu Header V2*/
			$this->sections[] = array(
				'title'  => __( 'Menu Header V2', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-list',
			);
			$this->sections[] = array(
				'title'  => __( 'First Level', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'          => 'tb_first_level_font_hv2',
						'type'        => 'typography', 
						'title'       => __('Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('.ro-header-v2 .ro-menu-list > ul > li > a'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#202020', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '12px', 
							'line-height' => '101px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id' => 'tb_first_level_padding_hv2',
						'title' => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding.', 'robusta'),
						'type' => 'spacing',
						'mode' => 'padding',
						'units' => array('px'),
						'output' => array('.ro-header-v2 .ro-menu-list > ul > li > a'),
						'default' => array(
							'padding-top'     => '0px', 
							'padding-right'   => '15px', 
							'padding-bottom'  => '0px', 
							'padding-left'    => '15px',
							'units'          => 'px', 
						)
					),
				)
			);
			$this->sections[] = array(
				'title'  => __( 'Sub Level', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'          => 'tb_sub_level_font_hv2',
						'type'        => 'typography', 
						'title'       => __('Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('.ro-header-v2 .ro-menu-list > ul > li.menu-item-has-children > ul > li a'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#fff', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '12px', 
							'line-height' => '26.4px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id' => 'tb_sub_level_padding_hv2',
						'title' => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding.', 'robusta'),
						'type' => 'spacing',
						'mode' => 'padding',
						'units' => array('px'),
						'output' => array('.ro-header-v2 .ro-menu-list > ul > li.menu-item-has-children > ul > li > a'),
						'default' => array(
							'padding-top'     => '10px', 
							'padding-right'   => '10px', 
							'padding-bottom'  => '10px', 
							'padding-left'    => '20px',
							'units'          => 'px', 
						)
					),
					
				)
			);
			/*Footer*/
			$this->sections[] = array(
				'title'  => __( 'Footer', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-file-edit',
			);
			$this->sections[] = array(
				'title'  => __( 'Footer Top', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id' => 'tb_footer_top_margin',
						'title' => __('Margin', 'robusta'),
						'subtitle' => __('Please, Enter margin.', 'robusta'),
						'type' => 'spacing',
						'mode' => 'margin',
						'units' => array('px'),
						'output' => array('.ro-footer .ro-footer-top'),
						'default' => array(
							'margin-top'     => '0px', 
							'margin-right'   => '0px', 
							'margin-bottom'  => '0px', 
							'margin-left'    => '0px',
							'units'          => 'px', 
						)
					),
					array(
						'id' => 'tb_footer_top_padding',
						'title' => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding.', 'robusta'),
						'type' => 'spacing',
						'units' => array('px'),
						'output' => array('.ro-footer .ro-footer-top'),
						'default' => array(
							'padding-top'     => '0px', 
							'padding-right'   => '0px', 
							'padding-bottom'  => '0px', 
							'padding-left'    => '0px',
							'units'          => 'px', 
						)
					),
					array(
						'id'       => 'tb_footer_top_column',
						'type'     => 'select',
						'title'    => __('Footer Top Columns', 'robusta'),
						'subtitle' => __('Select column of footer top.', 'robusta'),
						'options'  => array(
							'1' => '1 Column',
							'2' => '2 Columns',
							'3' => '3 Columns',
							'4' => '4 Columns'
						),
						'default'  => '4',
					),
					array(
						'id'       => 'tb_footer_top_col1',
						'type'     => 'text',
						'title'    => __('Footer Top Column 1', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
						'required' => array('tb_footer_top_column','>=','1')
					),
					array(
						'id'       => 'tb_footer_top_col2',
						'type'     => 'text',
						'title'    => __('Footer Top Column 2', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
						'required' => array('tb_footer_top_column','>=','2')
					),
					array(
						'id'       => 'tb_footer_top_col3',
						'type'     => 'text',
						'title'    => __('Footer Top Column 3', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
						'required' => array('tb_footer_top_column','>=','3')
					),
					array(
						'id'       => 'tb_footer_top_col4',
						'type'     => 'text',
						'title'    => __('Footer Top Column 4', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
						'required' => array('tb_footer_top_column','>=','4')
					),
				
				)
				
			);
			$this->sections[] = array(
				'title'  => __( 'Footer Bottom', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id' => 'tb_footer_bottom_margin',
						'title' => __('Margin', 'robusta'),
						'subtitle' => __('Please, Enter margin.', 'robusta'),
						'type' => 'spacing',
						'mode' => 'margin',
						'units' => array('px'),
						'output' => array('.ro-footer .ro-footer-bottom'),
						'default' => array(
							'margin-top'     => '0px', 
							'margin-right'   => '0px', 
							'margin-bottom'  => '0px', 
							'margin-left'    => '0px',
							'units'          => 'px', 
						)
					),
					array(
						'id' => 'tb_footer_bottom_padding',
						'title' => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding.', 'robusta'),
						'type' => 'spacing',
						'units' => array('px'),
						'output' => array('.ro-footer .ro-footer-bottom'),
						'default' => array(
							'padding-top'     => '30px', 
							'padding-right'   => '0px', 
							'padding-bottom'  => '30px', 
							'padding-left'    => '0px',
							'units'          => 'px', 
						)
					),
					array(
						'id'       => 'tb_footer_bottom_column',
						'type'     => 'select',
						'title'    => __('Footer Bottom Columns', 'robusta'),
						'subtitle' => __('Select column of footer bottom.', 'robusta'),
						'options'  => array(
							'1' => '1 Column',
							'2' => '2 Columns'
						),
						'default'  => '2',
					),
					array(
						'id'       => 'tb_footer_bottom_col1',
						'type'     => 'text',
						'title'    => __('Footer Bottom Column 1', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-6 col-lg-6 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
						'required' => array('tb_footer_bottom_column','>=','1')
					),
					array(
						'id'       => 'tb_footer_bottom_col2',
						'type'     => 'text',
						'title'    => __('Footer Bottom Column 2', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-6 col-lg-6 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
						'required' => array('tb_footer_bottom_column','>=','2')
					),
				
				)

			);
			$this->sections[] = array(
				'title'  => __( 'Footer Dark Styling', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'       => 'tb_footer_top_bg',
						'type'     => 'background',
						'title'    => __('Footer Top Background', 'robusta'),
						'subtitle' => __('background with image, color, etc.', 'robusta'),
						'default'  => array(
							'background-color' => '#000000',
						),
						'output' => array('.ro-footer .ro-footer-top'),
					),
					array(
						'id'       => 'tb_footer_top_text_color',
						'type'     => 'color',
						'title'    => __('Footer Top Text Color', 'robusta'),
						'subtitle' => __('Controls the text color. (default: #EEEEEE).', 'robusta'),
						'default'  => '#EEEEEE',
						'validate' => 'color',
						'output' => array('.ro-footer .ro-footer-top'),
					),
					array(
						'id'       => 'tb_footer_top_heading_color',
						'type'     => 'color',
						'title'    => __('Footer Top Heading Color', 'robusta'),
						'subtitle' => __('Controls the headings color. (default: #FFFFFF).', 'robusta'),
						'default'  => '#FFFFFF',
						'validate' => 'color',
						'output' => array('.ro-footer .ro-footer-top h1,.ro-footer .ro-footer-top h2,.ro-footer .ro-footer-top h3,.ro-footer .ro-footer-top h4,.ro-footer .ro-footer-top h5,.ro-footer .ro-footer-top h6'),
					),
					array(
						'id'       => 'tb_footer_top_link_color',
						'type'     => 'link_color',
						'title'    => __('Footer Top Links Color', 'robusta'),
						'subtitle' => __('Controls the link color. (default: #FFFFFF).', 'robusta'),
						'default'  => array(
							'regular'  => '#FFFFFF',
							'hover'    => '#FFFFFF',
							'active'   => '#FFFFFF',
							'visited'  => '#FFFFFF',
						),
						'output' => array('.ro-footer .ro-footer-top a'),
					),
					array(
						'id'       => 'tb_footer_bottom_bg',
						'type'     => 'background',
						'title'    => __('Footer Bottom Background', 'robusta'),
						'subtitle' => __('background with image, color, etc.', 'robusta'),
						'default'  => array(
							'background-color' => '#000000',
						),
						'output' => array('.ro-footer .ro-footer-bottom'),
					),
					array(
						'id'       => 'tb_footer_bottom_text_color',
						'type'     => 'color',
						'title'    => __('Footer Bottom Text Color', 'robusta'),
						'subtitle' => __('Controls the text color. (default: #EEEEEE).', 'robusta'),
						'default'  => '#EEEEEE',
						'validate' => 'color',
						'output' => array('.ro-footer .ro-footer-bottom'),
					),
					array(
						'id'       => 'tb_footer_bottom_heading_color',
						'type'     => 'color',
						'title'    => __('Footer Bottom Heading Color', 'robusta'),
						'subtitle' => __('Controls the headings color. (default: #CCCCCC).', 'robusta'),
						'default'  => '#CCCCCC',
						'validate' => 'color',
						'output' => array('.ro-footer .ro-footer-bottom h1,.ro-footer .ro-footer-bottom h2,.ro-footer .ro-footer-bottom h3,.ro-footer .ro-footer-bottom h4,.ro-footer .ro-footer-bottom h5,.ro-footer .ro-footer-bottom h6'),
					),
					array(
						'id'       => 'tb_footer_bottom_link_color',
						'type'     => 'link_color',
						'title'    => __('Footer Bottom Links Color', 'robusta'),
						'subtitle' => __('Controls the link color. (default: #FFFFFF).', 'robusta'),
						'default'  => array(
							'regular'  => '#FFFFFF',
							'hover'    => '#FFFFFF',
							'active'   => '#FFFFFF',
							'visited'  => '#FFFFFF',
						),
						'output' => array('.ro-footer .ro-footer-bottom a'),
					),
				)
			);
			$this->sections[] = array(
				'title'  => __( 'Footer White Styling', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'       => 'tb_footer_white_top_bg',
						'type'     => 'background',
						'title'    => __('Footer Top Background', 'robusta'),
						'subtitle' => __('background with image, color, etc.', 'robusta'),
						'default'  => array(
							'background-color' => '#ffffff',
						),
						'output' => array('.ro-footer.footer-white .ro-footer-top'),
					),
					array(
						'id'       => 'tb_footer_white_top_text_color',
						'type'     => 'color',
						'title'    => __('Footer Top Text Color', 'robusta'),
						'subtitle' => __('Controls the text color. (default: #EEEEEE).', 'robusta'),
						'default'  => '#444444',
						'validate' => 'color',
						'output' => array('.ro-footer.footer-white .ro-footer-top'),
					),
					array(
						'id'       => 'tb_footer_white_top_heading_color',
						'type'     => 'color',
						'title'    => __('Footer Top Heading Color', 'robusta'),
						'subtitle' => __('Controls the headings color. (default: #FFFFFF).', 'robusta'),
						'default'  => '#222222',
						'validate' => 'color',
						'output' => array('.ro-footer.footer-white .ro-footer-top h1,.ro-footer .ro-footer-top h2,.ro-footer .ro-footer-top h3,.ro-footer .ro-footer-top h4,.ro-footer .ro-footer-top h5,.ro-footer .ro-footer-top h6'),
					),
					array(
						'id'       => 'tb_footer_white_top_link_color',
						'type'     => 'link_color',
						'title'    => __('Footer Top Links Color', 'robusta'),
						'subtitle' => __('Controls the link color. (default: #FFFFFF).', 'robusta'),
						'default'  => array(
							'regular'  => '#222222',
							'hover'    => '#222222',
							'active'   => '#222222',
							'visited'  => '#222222',
						),
						'output' => array('.ro-footer.footer-white .ro-footer-top a'),
					),
					array(
						'id'       => 'tb_footer_white_bottom_bg',
						'type'     => 'background',
						'title'    => __('Footer Bottom Background', 'robusta'),
						'subtitle' => __('background with image, color, etc.', 'robusta'),
						'default'  => array(
							'background-color' => '#000000',
						),
						'output' => array('.ro-footer.footer-white .ro-footer-bottom'),
					),
					array(
						'id'       => 'tb_footer_white_bottom_text_color',
						'type'     => 'color',
						'title'    => __('Footer Bottom Text Color', 'robusta'),
						'subtitle' => __('Controls the text color. (default: #EEEEEE).', 'robusta'),
						'default'  => '#EEEEEE',
						'validate' => 'color',
						'output' => array('.ro-footer.footer-white .ro-footer-bottom'),
					),
					array(
						'id'       => 'tb_footer_white_bottom_heading_color',
						'type'     => 'color',
						'title'    => __('Footer Bottom Heading Color', 'robusta'),
						'subtitle' => __('Controls the headings color. (default: #CCCCCC).', 'robusta'),
						'default'  => '#CCCCCC',
						'validate' => 'color',
						'output' => array('.ro-footer.footer-white .ro-footer-bottom h1,.ro-footer .ro-footer-bottom h2,.ro-footer .ro-footer-bottom h3,.ro-footer .ro-footer-bottom h4,.ro-footer .ro-footer-bottom h5,.ro-footer .ro-footer-bottom h6'),
					),
					array(
						'id'       => 'tb_footer_white_bottom_link_color',
						'type'     => 'link_color',
						'title'    => __('Footer Bottom Links Color', 'robusta'),
						'subtitle' => __('Controls the link color. (default: #FFFFFF).', 'robusta'),
						'default'  => array(
							'regular'  => '#FFFFFF',
							'hover'    => '#FFFFFF',
							'active'   => '#FFFFFF',
							'visited'  => '#FFFFFF',
						),
						'output' => array('.ro-footer.footer-white .ro-footer-bottom a'),
					),
				)
			);
			/*Styling Setting*/
			$this->sections[] = array(
				'title'  => __( 'Styling Options', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-tint',
				'fields' => array(
					array(
						'id'       => 'tb_primary_color',
						'type'     => 'color',
						'title'    => __('Primary Color', 'robusta'),
						'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #FF2B42).', 'robusta'),
						'default'  => '#FF2B42',
						'validate' => 'color',
					),
					array(
						'id'       => 'tb_secondary_color',
						'type'     => 'color',
						'title'    => __('Secondary Color', 'robusta'),
						'subtitle' => __('Controls several items, ex: link hovers, highlights, and more. (default: #222222).', 'robusta'),
						'default'  => '#222222',
						'validate' => 'color',
					),
				)
			);
			/*Typography Setting*/
			$this->sections[] = array(
				'title'  => __( 'Typography', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-font',
				'fields' => array(
					/*Body font*/
					array(
						'id'          => 'tb_body_font',
						'type'        => 'typography', 
						'title'       => __('Body Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#333333', 
							'font-style'  => '400', 
							'font-family' => 'Raleway', 
							'google'      => true,
							'font-size'   => '14px', 
							'line-height' => '28px',
							'letter-spacing' => '0.48px'
						),
					),
					array(
						'id'          => 'tb_h1_font',
						'type'        => 'typography', 
						'title'       => __('H1 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h1, .ro-font-size-1'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '45px', 
							'line-height' => '58.5px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h2_font',
						'type'        => 'typography', 
						'title'       => __('H2 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h2, .ro-font-size-2'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '30px', 
							'line-height' => '39px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h3_font',
						'type'        => 'typography', 
						'title'       => __('H3 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h3, .ro-font-size-3'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '24px', 
							'line-height' => '31.2px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h4_font',
						'type'        => 'typography', 
						'title'       => __('H4 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h4, .ro-font-size-4'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '20px', 
							'line-height' => '26px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h5_font',
						'type'        => 'typography', 
						'title'       => __('H5 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h5, .ro-font-size-5'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '18px', 
							'line-height' => '23.4px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h6_font',
						'type'        => 'typography', 
						'title'       => __('H6 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h6, .ro-font-size-6'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '16px', 
							'line-height' => '20.8px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h7_font',
						'type'        => 'typography', 
						'title'       => __('H7 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h7, .ro-font-size-7'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '14px', 
							'line-height' => '18.2px',
							'letter-spacing' => '1.6px'
						),
					),
					array(
						'id'          => 'tb_h8_font',
						'type'        => 'typography', 
						'title'       => __('H8 Font Options', 'robusta'),
						'google'      => true, 
						'font-backup' => true,
						'letter-spacing' => true,
						'output'      => array('body h8, .ro-font-size-8'),
						'units'       =>'px',
						'subtitle'    => __('Typography option with each property can be called individually.', 'robusta'),
						'default'     => array(
							'color'       => '#222222', 
							'font-style'  => '400', 
							'font-family' => 'Montserrat', 
							'google'      => true,
							'font-size'   => '13px', 
							'line-height' => '16.9px',
							'letter-spacing' => '1.6px'
						),
					),
				)
			);
			/*Title Bar Setting*/
			$this->sections[] = array(
				'title'  => __( 'Title Bar', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-livejournal',
				'fields' => array(
					array(
						'id'             => 'tb_title_bar_margin',
						'type'           => 'spacing',
						'output'         => array('.ro-blog-title-bar, .ro-page-title-shop'),
						'mode'           => 'margin',
						'units'          => array('em', 'px'),
						'title'    => __('Margin', 'robusta'),
						'subtitle' => __('Please, Enter margin of title bar.', 'robusta'),
						'default'            => array(
							'margin-top'     => '0px', 
							'margin-right'   => '0px', 
							'margin-bottom'  => '60px', 
							'margin-left'    => '0px',
							'units'          => 'px', 
						)
					),
					array(
						'id'             => 'tb_title_bar_padding',
						'type'           => 'spacing',
						'output'         => array('.ro-blog-title-bar, .ro-page-title-shop'),
						'mode'           => 'padding',
						'units'          => array('em', 'px'),
						'title'    => __('Padding', 'robusta'),
						'subtitle' => __('Please, Enter padding of title bar.', 'robusta'),
						'default'            => array(
							'padding-top'     => '180px', 
							'padding-right'   => '0px', 
							'padding-bottom'  => '70px', 
							'padding-left'    => '0px',
							'units'          => 'px', 
						)
					),
					array(
						'id'       => 'tb_title_bar_bg',
						'type'     => 'background',
						'title'    => __('Background', 'robusta'),
						'subtitle' => __('background with image, color, etc.', 'robusta'),
						'output'    => array('.ro-blog-title-bar, .ro-page-title-shop'), 
						'default'  => array(
							'background-color' => '#222222',
							'background-repeat' => 'no-repeat',
							'background-position' => 'center center',
							'background-size' => 'cover',
							'background-image' => URI_PATH.'/assets/images/bg_title_bar.jpg',
							
						)
					),
					array(
						'id'       => 'tb_title_bar_heading_color',
						'type'     => 'color',
						'title'    => __('Title Bar Heading Color', 'robusta'),
						'subtitle' => __('Controls the headings color of title bar. (default: #ffffff).', 'robusta'),
						'output'    => array('.ro-blog-title-bar h2, .woocommerce .ro-page-title-shop h2'),
						'default'  => '#ffffff',
						'validate' => 'color',
					),
					array(
						'id'       => 'tb_title_bar_link_color',
						'type'     => 'link_color',
						'title'    => __('Title Bar Link Color', 'robusta'),
						'subtitle' => __('Controls the links color of title bar. (default: #ffffff).', 'robusta'),
						'output'    => array('.ro-blog-title-bar a, .woocommerce .ro-page-title-shop a'),
						'default'  => array(
							'regular'  => '#ffffff',
							'hover'    => '#ff2b42',
							'active'   => '#ff2b42',
							'visited'  => '#ff2b42',
						)
					),
					array(
						'id'       => 'tb_title_bar_text_color',
						'type'     => 'color',
						'title'    => __('Title Bar Text Color', 'robusta'),
						'subtitle' => __('Controls the text color of title bar. (default: #ffffff).', 'robusta'),
						'output'    => array('.ro-blog-title-bar , .woocommerce .ro-page-title-shop nav'),
						'default'  => '#ffffff',
						'validate' => 'color',
					),
					array(
						'id'       => 'tb_page_breadcrumb_delimiter',
						'type'     => 'text',
						'title'    => __('Delimiter', 'robusta'),
						'subtitle' => __('Please, Enter Delimiter of page breadcrumb in title bar.', 'robusta'),
						'default'  => '/'
					)
				)
			);
			/*Post Setting*/
			$this->sections[] = array(
				'title'  => __( 'Post Setting', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-file-edit',
				'fields' => array(
					
				)
				
			);
			$this->sections[] = array(
				'title'  => __( 'Title Bar', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array(
						'id'       => 'tb_post_show_page_title',
						'type'     => 'switch',
						'title'    => __( 'Show Page Title', 'robusta' ),
						'subtitle' => __( 'Show page title in page title bar.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_page_breadcrumb',
						'type'     => 'switch',
						'title'    => __( 'Show Page Breadcrumb', 'robusta' ),
						'subtitle' => __( 'Show page breadcrumb in page title bar.', 'robusta' ),
						'default'  => true,
					)
				)
			);
			$this->sections[] = array(
				'title'  => __( 'Blog Post', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array( 
						'id'       => 'tb_blog_layout',
						'type'     => 'image_select',
						'title'    => __('Select Layout', 'robusta'),
						'subtitle' => __('Select layout of blog.', 'robusta'),
						'options'  => array(
							'2cl'	=> array(
										'alt'   => '2cl',
										'img'   => URI_PATH_ADMIN.'/assets/images/2cl.png'
									),
							'2cr'	=> array(
										'alt'   => '2cr',
										'img'   => URI_PATH_ADMIN.'/assets/images/2cr.png'
									)
						),
						'default' => '2cr'
					),
					array(
						'id'       => 'tb_blog_left_sidebar',
						'type'     => 'select',
						'title'    => __('Sidebar Left', 'robusta'),
						'subtitle' => __('Select sidebar left in blog.', 'robusta'),
						'options'  => $of_options_sidebar,
						'default'  => 'Main Sidebar',
						'required' => array('tb_blog_layout','=', '2cl')
					),
					array(
						'id'       => 'tb_blog_left_sidebar_col',
						'type'     => 'text',
						'title'    => __('Sidebar Left Column', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-4 col-md-3 col-lg-3',
						'required' => array('tb_blog_layout','=', '2cl')
					),
					
					array(
						'id'       => 'tb_blog_content_col',
						'type'     => 'text',
						'title'    => __('Content Column', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-8 col-md-9 col-lg-9'
					),
					array(
						'id'       => 'tb_blog_right_sidebar',
						'type'     => 'select',
						'title'    => __('Sidebar Right', 'robusta'),
						'subtitle' => __('Select sidebar right in blog.', 'robusta'),
						'options'  => $of_options_sidebar,
						'default'  => 'Main Sidebar',
						'required' => array('tb_blog_layout','=', '2cr')
					),
					array(
						'id'       => 'tb_blog_right_siedebar_col',
						'type'     => 'text',
						'title'    => __('Sidebar Right Column', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-4 col-md-3 col-lg-3',
						'required' => array('tb_blog_layout','=', '2cr')
					),
					array(
						'id'       => 'tb_blog_show_post_image',
						'type'     => 'switch',
						'title'    => __( 'Show Featured Image', 'robusta' ),
						'subtitle' => __( 'Show or not featured image of post in blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_blog_show_post_title',
						'type'     => 'switch',
						'title'    => __( 'Show Title', 'robusta' ),
						'subtitle' => __( 'Show or not title of post in blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_blog_show_post_meta',
						'type'     => 'switch',
						'title'    => __( 'Show Meta', 'robusta' ),
						'subtitle' => __( 'Show or not meta of post in blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_blog_show_post_excerpt',
						'type'     => 'switch',
						'title'    => __( 'Show Excerpt', 'robusta' ),
						'subtitle' => __( 'Show or not excerpt of post in blog.', 'robusta' ),
						'default'  => true,
					), 
					array(
						'id'       => 'tb_blog_post_readmore_text',
						'type'     => 'text',
						'title'    => __( 'Read More Text', 'robusta' ),
						'subtitle' => __( 'Enter text of label button read more in blog.', 'robusta' ),
						'default'  => 'Read More',
					),
				) 
			);
			$this->sections[] = array(
				'title'  => __( 'Single Post', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => '',
				'subsection' => true,
				'fields' => array(
					array( 
						'id'       => 'tb_post_layout',
						'type'     => 'image_select',
						'title'    => __('Select Layout', 'robusta'),
						'subtitle' => __('Select layout of single blog.', 'robusta'),
						'options'  => array(
							'2cl'	=> array(
										'alt'   => '2cl',
										'img'   => URI_PATH_ADMIN.'/assets/images/2cl.png'
									),
							'2cr'	=> array(
										'alt'   => '2cr',
										'img'   => URI_PATH_ADMIN.'/assets/images/2cr.png'
									)
						),
						'default' => '2cr'
					),
					array(
						'id'       => 'tb_post_left_sidebar',
						'type'     => 'select',
						'title'    => __('Sidebar Left', 'robusta'),
						'subtitle' => __('Select sidebar left in blog.', 'robusta'),
						'options'  => $of_options_sidebar,
						'default'  => 'Main Sidebar',
						'required' => array('tb_post_layout','=', '2cl')
					),
					array(
						'id'       => 'tb_post_left_sidebar_col',
						'type'     => 'text',
						'title'    => __('Left Sidebar Column', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-4 col-md-3 col-lg-3',
						'required' => array('tb_post_layout','=', '2cl')
					),
					array(
						'id'       => 'tb_post_content_col',
						'type'     => 'text',
						'title'    => __('Content Column', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-8 col-md-9 col-lg-9',
					),
					array(
						'id'       => 'tb_post_right_sidebar',
						'type'     => 'select',
						'title'    => __('Sidebar Right', 'robusta'),
						'subtitle' => __('Select sidebar right in blog.', 'robusta'),
						'options'  => $of_options_sidebar,
						'default'  => 'Main Sidebar',
						'required' => array('tb_blog_layout','=', '2cr')
					),
					array(
						'id'       => 'tb_post_right_siedebar_col',
						'type'     => 'text',
						'title'    => __('Right Sidebar Column', 'robusta'),
						'subtitle' => __('Please, Enter class bootstrap and extra class. Ex: col-xs-12 col-sm-6 col-md-3 col-lg-3 el-class.', 'robusta'),
						'default'  => 'col-xs-12 col-sm-4 col-md-3 col-lg-3',
						'required' => array('tb_blog_layout','=', '2cr')
					),
					array(
						'id'       => 'tb_post_show_post_image',
						'type'     => 'switch',
						'title'    => __( 'Show Featured Image', 'robusta' ),
						'subtitle' => __( 'Show or not featured image of post on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_post_title',
						'type'     => 'switch',
						'title'    => __( 'Show Title', 'robusta' ),
						'subtitle' => __( 'Show or not title of post on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_post_meta',
						'type'     => 'switch',
						'title'    => __( 'Show Meta', 'robusta' ),
						'subtitle' => __( 'Show or not meta of post on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_post_desc',
						'type'     => 'switch',
						'title'    => __( 'Show Description', 'robusta' ),
						'subtitle' => __( 'Show or not description of post on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array( 
						'id'       => 'tb_post_show_post_nav',
						'type'     => 'switch',
						'title'    => __( 'Show Navigation', 'robusta' ),
						'subtitle' => __( 'Show or not post navigation on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_post_tags',
						'type'     => 'switch',
						'title'    => __( 'Show Tags', 'robusta' ),
						'subtitle' => __( 'Show or not post tags on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_post_author',
						'type'     => 'switch',
						'title'    => __( 'Show Author', 'robusta' ),
						'subtitle' => __( 'Show or not post author on your single blog.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_post_show_post_comment',
						'type'     => 'switch',
						'title'    => __( 'Show Comment', 'robusta' ),
						'subtitle' => __( 'Show or not post comment on your single blog.', 'robusta' ),
						'default'  => true,
					),
				)
			);
			/*Page Setting*/
			$this->sections[] = array(
				'title'  => __( 'Page Setting', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-list-alt',
				'fields' => array(
					array(
						'id'       => 'tb_page_show_page_title',
						'type'     => 'switch',
						'title'    => __( 'Show Page Title', 'robusta' ),
						'subtitle' => __( 'Show page title in page title bar.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_page_show_page_breadcrumb',
						'type'     => 'switch',
						'title'    => __( 'Show Page Breadcrumb', 'robusta' ),
						'subtitle' => __( 'Show page breadcrumb in page title bar.', 'robusta' ),
						'default'  => true,
					),
					array(
						'id'       => 'tb_page_show_page_comment',
						'type'     => 'switch',
						'title'    => __( 'Show Page Comment', 'robusta' ),
						'subtitle' => __( 'Show or not page comment on your page.', 'robusta' ),
						'default'  => true,
					)
				)
				
			);
			/*Custom CSS*/
			$this->sections[] = array(
				'title'  => __( 'Custom CSS', 'robusta' ),
				'desc'   => __( '', 'robusta' ),
				'icon'   => 'el-icon-css',
				'fields' => array(
					array(
						'id'       => 'custom_css_code',
						'type'     => 'ace_editor',
						'title'    => __('Custom CSS Code', 'robusta'),
						'subtitle' => __('Quickly add some CSS to your theme by adding it to this block..', 'robusta'),
						'mode'     => 'css',
						'theme'    => 'monokai',
						'default'  => ''
					)
				)
				
			);
			/*Import / Export*/
			$this->sections[] = array(
				'title'  => __( 'Import / Export', 'robusta' ),
				'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'robusta' ),
				'icon'   => 'el-icon-refresh',
				'fields' => array(
					array(
						'id'         => 'tb_import_export',
						'type'       => 'import_export',
						'title'      => 'Import Export',
						'subtitle'   => 'Save and restore your Redux options',
						'full_width' => false,
					),
					array (
						'id'            => 'tb_import',
						'type'          => 'js_button',
						'title'         => 'Import sample data',
						'subtitle'      => '<a class="button-secondary" id="import" href="javascript:void(0);">Import</a><p class="import-message"></p>',
					),
				),
			);
			
		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-1',
				'title'   => __( 'Theme Information 1', 'robusta' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'robusta' )
			);

			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-2',
				'title'   => __( 'Theme Information 2', 'robusta' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'robusta' )
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'robusta' );
		}

		/**
		 * All the possible arguments for Redux.
		 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'             => 'tb_options',
				// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'         => $theme->get( 'Name' ),
				// Name that appears at the top of your panel
				'display_version'      => $theme->get( 'Version' ),
				// Version that appears at the top of your panel
				'menu_type'            => 'menu',
				//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'       => true,
				// Show the sections below the admin menu item or not
				'menu_title'           => __( 'Theme Options', 'robusta' ),
				'page_title'           => __( 'Theme Options', 'robusta' ),
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key'       => '',
				// Set it you want google fonts to update weekly. A google_api_key value is required.
				'google_update_weekly' => false,
				// Must be defined to add google fonts to the typography module
				'async_typography'     => true,
				// Use a asynchronous font on the front end or font string
				//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
				'admin_bar'            => true,
				// Show the panel pages on the admin bar
				'admin_bar_icon'     => 'dashicons-portfolio',
				// Choose an icon for the admin bar menu
				'admin_bar_priority' => 50,
				// Choose an priority for the admin bar menu
				'global_variable'      => '',
				// Set a different name for your global variable other than the opt_name
				'dev_mode'             => false,
				// Show the time the page took to load, etc
				'update_notice'        => false,
				// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
				'customizer'           => true,
				// Enable basic customizer support
				//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'        => null,
				// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'          => 'themes.php',
				// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'     => 'manage_options',
				// Permissions needed to access the options panel.
				'menu_icon'            => '',
				// Specify a custom URL to an icon
				'last_tab'             => '',
				// Force your panel to always open to a specific tab (by id)
				'page_icon'            => 'icon-themes',
				// Icon displayed in the admin panel next to your menu_title
				'page_slug'            => '_options',
				// Page slug used to denote the panel
				'save_defaults'        => true,
				// On load save the defaults to DB before user clicks save or not
				'default_show'         => false,
				// If true, shows the default value next to each field that is not the default value.
				'default_mark'         => '',
				// What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export'   => true,
				// Shows the Import/Export panel when not used as a field.

				// CAREFUL -> These options are for advanced use only
				'transient_time'       => 60 * MINUTE_IN_SECONDS,
				'output'               => true,
				// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'           => true,
				// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'             => '',
				// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'          => false,
				// REMOVE

				// HINTS
				'hints'                => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'light',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
						),
					),
				)
			);
			
			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			$this->args['share_icons'][] = array(
				'url'   => '#',
				'title' => 'Visit us on GitHub',
				'icon'  => 'el-icon-github'
				//'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			);
			$this->args['share_icons'][] = array(
				'url'   => '#',
				'title' => 'Like us on Facebook',
				'icon'  => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url'   => '#',
				'title' => 'Follow us on Twitter',
				'icon'  => 'el-icon-twitter'
			);
			$this->args['share_icons'][] = array(
				'url'   => '#',
				'title' => 'Find us on LinkedIn',
				'icon'  => 'el-icon-linkedin'
			);
		}

		public function validate_callback_function( $field, $value, $existing_value ) {
			$error = true;
			$value = 'just testing';

			/*
		  do your validation

		  if(something) {
			$value = $value;
		  } elseif(something else) {
			$error = true;
			$value = $existing_value;
			
		  }
		 */

			$return['value'] = $value;
			$field['msg']    = 'your custom error message';
			if ( $error == true ) {
				$return['error'] = $field;
			}

			return $return;
		}

		public function class_field_callback( $field, $value ) {
			print_r( $field );
			echo '<br/>CLASS CALLBACK';
			print_r( $value );
		}

	}

	global $reduxConfig;
	$reduxConfig = new Redux_Framework_theme_config();
} else {
	echo "The class named Redux_Framework_theme_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}

/**
 * Custom function for the callback referenced above
 */
if ( ! function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field( $field, $value ) {
		print_r( $field );
		echo '<br/>';
		print_r( $value );
	}
endif;

/**
 * Custom function for the callback validation referenced above
 * */
if ( ! function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function( $field, $value, $existing_value ) {
		$error = true;
		$value = 'just testing';

		/*
	  do your validation

	  if(something) {
		$value = $value;
	  } elseif(something else) {
		$error = true;
		$value = $existing_value;
		
	  }
	 */

		$return['value'] = $value;
		$field['msg']    = 'your custom error message';
		if ( $error == true ) {
			$return['error'] = $field;
		}

		return $return;
	}
endif;
