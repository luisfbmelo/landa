<?php 
class WdTheme 
{
	protected $options = array();
	protected $arrFunctions = array();
	protected $arrWidgets = array();
	protected $arrIncludes = array();
	public function __construct($options){
		$this->options = $options;
		$this->initArrFunctions();
		$this->initArrWidgets();
		$this->initArrIncludes();
		$this->constant($options);
	}

	public function init(){
		////// Active theme
		$this->hookActive($this->options['theme_slug'], array($this,'activeTheme'));

		$this->initIncludes();
		
		///// After Setup theme
		add_action( 'after_setup_theme', array($this,'wpdancesetup'));
		
		////// deactive theme
		$this->hookDeactive($this->options['theme_slug'], array($this,'deactiveTheme'));
				
		add_action('wp_enqueue_scripts',array($this,'addScripts'));
		
		//add_action('wp_enqueue_scripts',array($this,'addTailScripts'),1000000);
			
		$this->initFunctions();
		$this->initWidgets();
		
		//call admin
		require_once THEME_INCLUDES.'/metaboxes.php';
		$classNameAdmin = 'AdminTheme';
		$panel = new $classNameAdmin();
		
		//$this->loadImageSize();
		add_action( 'init' , array($this, 'loadImageSize'));
		$this->extension();
		
		//add_action('wp_enqueue_scripts',array($this,'addLastScripts'));
	}
	
	protected function initArrFunctions(){
		$this->arrFunctions = array('main','global_var','preview_mod','ads','filter_editor','quicksand','slide','search','markup_categories','lightbox_control','breadcrumbs','sidebar','twitter_update','feed_burner','excerpt',/*'thumbnail',*/'pagination','theme_control','filter_theme','posted_in_on','video','comment','theme_sidebar','custom_style','header_function','footer_function','mega_menu_column','wdmenus','woo-cart','woo-product','woo-hook','bbpress_hook','woo-account','custom_term', 'woo-wishlist', 'loading_page', 'ajax_function', 'video');
	}
	
	
	protected function initArrWidgets(){
		$this->arrWidgets = array('flickr','customrecent','emads','custompages','twitterupdate','ew_multitab'
								,'ew_video','recent_comments_custom','ew_social','productaz','ew_subscriptions', 'best_selling_product', 'wd_woo_products', 'hot_product', 'recent_product', 'instagram');
	}
	
	protected function initArrIncludes(){
		$this->arrIncludes = array('twitteroauth','mobile_detect','twitteroauth','class-tgm-plugin-activation', 'Instagram');
	}
	
	public function theme_slug_render_title(){
		?>
		<title>
			<?php
			global $page, $paged;	
			if ( defined('WPSEO_VERSION') ) {
				wp_title('');
			} else {
				wp_title( '|', true, 'right' );

				// Add the blog name.
				bloginfo( 'name' );

				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";

				// Add a page number if necessary:
				if ( $paged >= 2 || $page >= 2 )
					echo ' | ' . sprintf( __( 'Page %s', 'wpdance' ), max( $paged, $page ) );
			}
			?>
		</title>	
		<?php
	}
	
	public function theme_slug_render_title_filter( $title, $sep  ){
		
		if ( is_feed() ) {
			return $title;
		}
		global $page, $paged;	
			
		$title .= get_bloginfo( 'name', 'display' );
		
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'wpdance' ), max( $paged, $page ) );
		}
		
		return $title;
			
	}
	
	public function wpdancesetup() {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );		
		//add_theme_support( 'custom-header', $args ) ;
		
		add_theme_support( 'title-tag' );
		
		
		if ( ! function_exists( '_wp_render_title_tag' ) ) :
			add_action( 'wp_head', array( $this, 'theme_slug_render_title' ) );
		endif;
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		$defaults = array(
			'default-color'          => '',
			'default-image'          => get_template_directory_uri()."/images/default-background.png",
			// 'wp-head-callback'       => 'head_callback_on_bg',
			// 'admin-head-callback'    => '',
			// 'admin-preview-callback' => ''
		);
		
		global $wp_version;
		/*if ( version_compare( $wp_version, '3.4', '>=' ) ) :
			add_theme_support( 'custom-background', $defaults );
		else :
			add_custom_background( $defaults );
		endif;	*/
		add_theme_support( 'custom-background', $defaults );
				
		add_post_type_support( 'forum', array('thumbnail') );
		add_theme_support( 'woocommerce' );	
		if ( ! isset( $content_width ) ) $content_width = 960;
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'wpdance', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'wpdance' )
		) );
		
		register_nav_menus( array(
			'mobile' =>  __( 'Mobile Navigation', 'wpdance' )
		) );
		
		register_nav_menus( array(
			'vertical_menu' =>  __( 'Vertical Navigation', 'wpdance' )
		) );
		


		// Your changeable header business starts here
		if ( ! defined( 'HEADER_TEXTCOLOR' ) )
			define( 'HEADER_TEXTCOLOR', '' );

		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		if ( ! defined( 'HEADER_IMAGE' ) )
			define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to wpdance_header_image_width and wpdance_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'wpdance_header_image_width', 940 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'wpdance_header_image_height', 198 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 940 pixels wide by 198 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See wpdance_admin_header_style(), below.


		// ... and thus ends the changeable header business.
		
		
		$detect = new Mobile_Detect;
		$_is_tablet = $detect->isTablet();
		$_is_mobile = $detect->isMobile() && !$_is_tablet;
		define( 'WD_IS_MOBILE', $_is_mobile );
		define( 'WD_IS_TABLET', $_is_tablet );
		
		//print_r(get_option(THEME_SLUG.'wd_mega_menu_config')); die();
	}
	
	protected function constant($options){
		define('DS',DIRECTORY_SEPARATOR);	
		define('THEME_NAME', $options['theme_name']);
		define('THEME_SLUG', $options['theme_slug'].'_');
		
		define('THEME_DIR', get_template_directory());
		
		define('THEME_CACHE', get_template_directory().DS.'cache_theme'.DS);
		
		define('THEME_URI', get_template_directory_uri());
		
		define('THEME_FRAMEWORK', THEME_DIR . '/framework');
		
		define('THEME_FRAMEWORK_URI', THEME_URI . '/framework');
		
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');

		define('THEME_INCLUDES', THEME_FRAMEWORK . '/includes');
		
		define('THEME_INCLUDES_AJAX', THEME_INCLUDES . '/ajax');
		
		define('THEME_LIB', THEME_FRAMEWORK . '/lib');
		
		define('THEME_INCLUDES_URI', THEME_URI . '/framework/includes');
		
		define('THEME_EXTENSION', THEME_FRAMEWORK . '/extension');
		
		define('THEME_EXTENDS_EXTENDVC_URI', THEME_FRAMEWORK.'/extendvc');
		
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');

		/*	
		define('ENABLED_FONT', false);
		define('ENABLED_COLOR', false);
		define('ENABLED_PREVIEW', false);
		define('SITE_LAYOUT', 'wide');
		*/
		
		define('USING_CSS_CACHE', true);
		
	}
	
	protected function initFunctions(){
		foreach($this->arrFunctions as $function){
			if(file_exists(THEME_FUNCTIONS."/{$function}.php"))
			{
				require_once THEME_FUNCTIONS."/{$function}.php";
			}	
		}
	}
	
	protected function extension(){
		$this->extendVC();
	}
	
	protected function initWidgets(){
		foreach($this->arrWidgets as $widget){
			if(file_exists(THEME_WIDGETS."/{$widget}.php"))
			{
				require_once THEME_WIDGETS."/{$widget}.php";
			}
		}
		add_action( 'widgets_init', array($this,'loadWidgets'));
	}
	
	protected function initIncludes(){
		foreach($this->arrIncludes as $include){
			if(file_exists(THEME_LIB."/{$include}.php")){
				require_once THEME_LIB."/{$include}.php";
			}
		}
	}
		
	public function loadWidgets(){
		foreach($this->arrWidgets as $widget)
			register_widget( 'WP_Widget_'.ucfirst($widget) );
	}
	
	public function activeTheme(){
		//Single Image
		update_option( 'shop_single_image_size', array('height'=>'700', 'width' => '570', 'crop' => 1 ));
		//Thumbnail Image
		update_option( 'shop_thumbnail_image_size', array('height'=>'90', 'width' => '70', 'crop' => 1 ));
		//Catalog Image
		update_option( 'shop_catalog_image_size', array('height'=>'328', 'width' => '278', 'crop' => 1 ));	
		
	}
	
	public function hookActive($code, $function){
		$optionKey="theme_is_activated_" . $code;
		if(!get_option($optionKey)) {
			call_user_func($function);
			update_option($optionKey , 1);
		}
	}
	
	public function deactiveTheme(){
	
	}
	
	/**
	 * @desc registers deactivation hook
	 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
	 * @param callback $function : Function to call when theme gets deactivated.
	 */
	public function hookDeactive($code, $function) {
		// store function in code specific global
		$GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;

		// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
		$fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

		// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
		// Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
		// Your theme can perceive this hook as a deactivation hook.)
		add_action("switch_theme", $fn);
	}
	
	public function addTailScripts(){

		global $wd_data;
	
		wp_register_style( 'custom_default', THEME_CSS.'/custom_default.less');
		wp_enqueue_style('custom_default');	
		
		

		wp_register_script( 'less', THEME_JS.'/less.js');
		wp_enqueue_script('less');	
	}
	
	public function addLastScripts(){
		if(is_rtl()) {
			wp_register_style( 'wd-rtl', THEME_CSS.'/wd_rtl.css');
			wp_enqueue_style('wd-rtl');
		}
	}
	
	public function addScripts(){
		global $is_IE, $wd_data;
		
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'default-quicksand', "$protocol://fonts.googleapis.com/css?family=Quicksand:400,300,700" );
		wp_enqueue_style( 'default-lato', "$protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic" );
		
		wp_register_style( 'bootstrap', THEME_CSS.'/bootstrap.css');
		wp_enqueue_style('bootstrap');
		
		wp_register_style( 'bootstrap-theme', THEME_CSS.'/bootstrap-theme.css');
		wp_enqueue_style('bootstrap-theme');
		
		wp_enqueue_style( 'default', get_stylesheet_uri() ); 
		wp_register_style( 'reset', THEME_CSS.'/reset.css');
		wp_enqueue_style('reset');
		wp_register_style( 'flexslider', THEME_CSS.'/flexslider.css');
		wp_enqueue_style('flexslider');
		wp_register_style( 'colorpicker', THEME_CSS.'/colorpicker.css');
		wp_enqueue_style('colorpicker');
		wp_register_style( 'fancybox_css', THEME_CSS.'/jquery.fancybox.css');
		wp_enqueue_style('fancybox_css');
		
		/*
		wp_register_style( 'ticker-css', THEME_FRAMEWORK_CSS_URI.'/ticker-style.css');
		wp_enqueue_style('ticker-css');
		*/
		
		wp_register_style( 'font-awesome', THEME_FRAMEWORK_URI.'/css/font-awesome.css');
		wp_enqueue_style('font-awesome');
		wp_register_style( 'base', THEME_CSS.'/base.css');
		wp_enqueue_style('base');
		wp_register_style( 'wd-widget', THEME_CSS.'/widget.css');
		wp_enqueue_style('wd-widget');
		wp_register_style( 'select2', THEME_CSS.'/select2.css');
		wp_enqueue_style('select2');
		wp_register_style( 'nivo-slider-css', THEME_CSS.'/nivo-slider.css');
		wp_enqueue_style('nivo-slider-css');	
		wp_register_style( 'cs-animate', THEME_CSS.'/cs-animate.css');
		wp_enqueue_style('cs-animate');
		
		if(is_rtl()) {
			wp_register_style( 'wd-rtl', THEME_CSS.'/wd_rtl.css');
			wp_enqueue_style('wd-rtl');
		}
		
		wp_register_style( 'responsive', THEME_CSS.'/responsive.css');
		wp_enqueue_style('responsive');
		
		if( is_page_template( 'page-templates/onepage-template.php' ) && !wp_is_mobile() ) {
			wp_register_style( 'jquery.fullPage.css', THEME_CSS.'/jquery.fullPage.css');
			wp_enqueue_style('jquery.fullPage.css');
			
			wp_register_script( 'jquery.fullPage', THEME_JS.'/jquery.fullPage.js',false,false,true);
			if(isset($wd_data['wd_h_bg_color'])) $fp_stickyColor = wd_readableColour($wd_data['wd_h_bg_color'], 0.3);
			else $fp_stickyColor = "#000";
			wp_localize_script('jquery.fullPage', 'wd_fullpage_sticky', $fp_stickyColor);
			wp_enqueue_script( 'jquery.fullPage' );
			//$wd_data['h_bg_color']
			
		}
		
		wp_enqueue_script('jquery');	
		wp_register_script( 'bootstrap', THEME_JS.'/bootstrap.js',false,false,true);
		wp_enqueue_script('bootstrap');		
		wp_register_script( 'TweenMax', THEME_JS.'/TweenMax.min.js',false,false,true);
		wp_enqueue_script('TweenMax');
		
		/*
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-mouse");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-effects-core");
		*/
		
		wp_enqueue_script('flexslider-js',THEME_JS.'/jquery.flexslider-min.js',false,true);

		wp_register_script( 'bootstrap-colorpicker', THEME_JS.'/bootstrap-colorpicker.js',false,false,true);
		wp_enqueue_script('bootstrap-colorpicker');	
		
		wp_register_script( 'include-script', THEME_JS.'/include-script.js',false,false,true);
		wp_enqueue_script('include-script');

		wp_register_script( 'jquery.carouFredSel', THEME_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
		wp_enqueue_script('jquery.carouFredSel');

		wp_register_script( 'owl.carousel', THEME_JS.'/owl.carousel.min.js',false,false,true);
		wp_enqueue_script('owl.carousel');
			
		wp_register_script( 'jquery.select2', THEME_JS.'/select2.js',false,false,true);
		wp_enqueue_script('jquery.select2');

		wp_register_script( 'jquery.nivo-js', THEME_JS.'/jquery.nivo.slider.js',false,false,true);
		wp_enqueue_script('jquery.nivo-js');		

		wp_register_script( 'jquery-appear', THEME_JS.'/jquery.appear.js',false,false,true);
		wp_enqueue_script('jquery-appear');
		
		wp_register_script( 'isotope-min', THEME_JS.'/isotope.min.js',false,false,true);
		wp_enqueue_script('isotope-min');
		
		/*wp_register_script( 'fullpage-min', THEME_JS.'/jquery.fullPage.min.js',false,false,true);
		wp_enqueue_script('fullpage-min');*/
		
		
		if(is_singular('product')){
			wp_register_script( 'jquery.cloud-zoom', THEME_JS.'/cloud-zoom.1.0.2.js',false,false,true);
			wp_enqueue_script('jquery.cloud-zoom');		
			wp_register_style( 'cloud-zoom-css', THEME_CSS.'/cloud-zoom.css');
			wp_enqueue_style('cloud-zoom-css');
		
		}else{
			wp_register_script( 'jquery.prettyPhoto', THEME_JS.'/jquery.prettyPhoto.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto');	
			wp_register_script( 'jquery.prettyPhoto.init', THEME_JS.'/jquery.prettyPhoto.init.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto.init');				
			wp_register_style( 'css.prettyPhoto', THEME_CSS.'/prettyPhoto.css');
			wp_enqueue_style('css.prettyPhoto');
		}
		
		
		if(!is_admin()){		
			if(wp_is_mobile()) {
				wp_register_script( 'mobile-jquery', THEME_JS.'/jquery.mobile.min.js',false,false,true);
				wp_enqueue_script('mobile-jquery');
				
				wp_register_script( 'mobile-event', THEME_JS.'/mobile-event.js',false,false,true);
				wp_enqueue_script('mobile-event');
			}
			
			
			wp_register_script( 'main-js', THEME_JS.'/main.js',false,false,true);
			wp_enqueue_script('main-js');
			
			
			if(isset($wd_data['wd_smooth_scroll']) && absint($wd_data['wd_smooth_scroll']) == 1){
				if(!wp_is_mobile()) {
					if($this->is_windows() && $this->is_chrome()) {
						wp_register_script( 'smooth-scroll', THEME_JS.'/smoothScroll.js',false,false,true);
						wp_enqueue_script('smooth-scroll');
					}
				}
			}
			
			if(isset($wd_data['wd_loading_page']) && absint($wd_data['wd_loading_page']) == 1){ 
				if(!wp_is_mobile()) { 
					wp_register_style( 'pace-page', THEME_CSS.'/pace.page.css');
					wp_enqueue_style('pace-page');
					wp_register_script( 'pace-min', THEME_JS.'/pace.min.js',false,false,true);
					wp_enqueue_script('pace-min');
				}
			}
		}
	}
	
	public function is_windows(){
		$u = $_SERVER['HTTP_USER_AGENT'];
		$window  = (bool)preg_match('/Windows/i', $u );
		return $window;
	}
	public function is_chrome(){
		$u = $_SERVER['HTTP_USER_AGENT'];
		$chrome  = (bool)preg_match('/Chrome/i', $u );
		return $chrome;
	}
	
	public function wd_vcSetAsTheme() {
		vc_set_as_theme();
	}
	//extend visual composer 
	protected function extendVC(){
		
		if (class_exists('Vc_Manager')) {
						
			add_action( 'vc_before_init',array($this,'wd_vcSetAsTheme'));
			
			vc_set_shortcodes_templates_dir(THEME_DIR ."/framework/extension/extendvc/vc_templates");
			
			vc_disable_frontend();

			$this->changing_rows_columns_classes();
		}

		// Initialising Shortcodes
		if (false||class_exists('WPBakeryVisualComposerAbstract')) {
			require_once THEME_EXTENSION. '/extendvc/vc_includes/vc_functions.php';
			require_once THEME_EXTENSION. '/extendvc/vc_includes/vc_images.php';
			//require_once THEME_EXTENSION. '/extendvc/vc_includes/vc_shortcodes.php';
			
			function requireVcExtend(){	
				$vc_generates = array('params','feature_product_slider','top_rated_products','best_selling_products','best_selling_product_slider','specific_product_slider','recent_product_by_slider', 'recent_products', 'sale_products','heading','testimonial','portfolio','recent_blogs','button','feature','quote','wd_projects','team_member','feedbuner','countdown','pricing_table', 'gap','woo-add-to-cart','woo-best-selling-products','woo-featured_products','woo-product','woo-product-attribute','woo-product-category','woo-product-page','woo-products','woo-recent-products','woo-related-product','woo-sale-products','woo-top-rated-products', 'banner','code','wd_video_backg', 'wd_gallery', 'product_filter_by_sub_category', 'child_categories', 'products_filter_by_cats'
				, 'instagram','woo-grid-product-category','custom_product_by_category');		
				foreach($vc_generates as $vc_generate){
					if(file_exists(THEME_EXTENSION."/extendvc/vc_generate/{$vc_generate}.php"))
						require_once THEME_EXTENSION. "/extendvc/vc_generate/{$vc_generate}.php";
				}	
				
			}
			add_action('admin_init', 'requireVcExtend',2);
		}
	}
	
	//overrite row and column classes
	protected function changing_rows_columns_classes(){
		function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
			if ($tag=='vc_row' || $tag=='vc_row_inner') {
				$class_string = str_replace('vc_row-fluid', 'row vc_row-fluid', $class_string);
			}

			/*if ($tag=='vc_column' || $tag=='vc_column_container') {
				$class_string = preg_replace('/vc_col-sm-(\d{1,2})/', '$1', $class_string);
				$class_string = 'wpb_column column_container col-sm-' . intval($class_string) * 2;
			}*/

			return $class_string;
		}
		add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);
	}
	
	function loadImageSize(){
		if ( function_exists( 'add_image_size' ) ) {
		   // Add image size for main slideshow
			global $wd_data;
			$wd_blog_single_thumbnail_width = ( isset($wd_data['wd_blog_single_thumbnail_width']) && absint($wd_data['wd_blog_single_thumbnail_width']) > 0 )? absint($wd_data['wd_blog_single_thumbnail_width']) : 1170;
			
			$wd_blog_thumbnail_width = ( isset($wd_data['wd_blog_thumbnail_width']) && absint($wd_data['wd_blog_thumbnail_width']) > 0 )? absint($wd_data['wd_blog_thumbnail_width']) : 420;
			$wd_blog_thumbnail_height = ( isset($wd_data['wd_blog_thumbnail_height']) && absint($wd_data['wd_blog_thumbnail_height']) > 0 )? absint($wd_data['wd_blog_thumbnail_height']) : 300;
			
			$wd_blog_shortcode_thumbnail_width = ( isset($wd_data['wd_blog_shortcode_thumbnail_width']) && absint($wd_data['wd_blog_shortcode_thumbnail_width']) > 0 )? absint($wd_data['wd_blog_shortcode_thumbnail_width']) : 270;
			$wd_blog_shortcode_thumbnail_height = ( isset($wd_data['wd_blog_shortcode_thumbnail_height']) && absint($wd_data['wd_blog_shortcode_thumbnail_height']) > 0 )? absint($wd_data['wd_blog_shortcode_thumbnail_height']) : 200;
			
			$wd_blog_shortcode_auto_thumbnail_width = ( isset($wd_data['wd_blog_shortcode_auto_thumbnail_width']) && absint($wd_data['wd_blog_shortcode_auto_thumbnail_width']) > 0 )? absint($wd_data['wd_blog_shortcode_auto_thumbnail_width']) : 570;
			
			$wd_blog_shortcode_widget_thumbnail_width = ( isset($wd_data['wd_blog_shortcode_widget_thumbnail_width']) && absint($wd_data['wd_blog_shortcode_widget_thumbnail_width']) > 0 )? absint($wd_data['wd_blog_shortcode_widget_thumbnail_width']) : 100;
			$wd_blog_shortcode_widget_thumbnail_height = ( isset($wd_data['wd_blog_shortcode_widget_thumbnail_height']) && absint($wd_data['wd_blog_shortcode_widget_thumbnail_height']) > 0 )? absint($wd_data['wd_blog_shortcode_widget_thumbnail_height']) : 70;
			
			$wd_tini_shopping_cart_thumbnail_width = ( isset($wd_data['wd_tini_shopping_cart_thumbnail_width']) && absint($wd_data['wd_tini_shopping_cart_thumbnail_width']) > 0 )? absint($wd_data['wd_tini_shopping_cart_thumbnail_width']) : 100;
			$wd_tini_shopping_cart_thumbnail_height = ( isset($wd_data['wd_tini_shopping_cart_thumbnail_height']) && absint($wd_data['wd_tini_shopping_cart_thumbnail_height']) > 0 )? absint($wd_data['wd_tini_shopping_cart_thumbnail_height']) : 120;
			
			$wd_single_products_thumbnail_width = ( isset($wd_data['wd_single_products_thumbnail_width']) && absint($wd_data['wd_single_products_thumbnail_width']) > 0 )? absint($wd_data['wd_single_products_thumbnail_width']) : 100;
			$wd_single_products_thumbnail_height = ( isset($wd_data['wd_single_products_thumbnail_height']) && absint($wd_data['wd_single_products_thumbnail_height']) > 0 )? absint($wd_data['wd_single_products_thumbnail_height']) : 140;
			
			$wd_product_subcategories_thumbnail_width = ( isset($wd_data['wd_product_subcategories_thumbnail_width']) && absint($wd_data['wd_product_subcategories_thumbnail_width']) > 0 )? absint($wd_data['wd_product_subcategories_thumbnail_width']) : 270;
			$wd_product_subcategories_thumbnail_height = ( isset($wd_data['wd_product_subcategories_thumbnail_height']) && absint($wd_data['wd_product_subcategories_thumbnail_height']) > 0 )? absint($wd_data['wd_product_subcategories_thumbnail_height']) : 200;
			
			$wd_product_categories_shortcode_thumbnail_width = ( isset($wd_data['wd_product_categories_shortcode_thumbnail_width']) && absint($wd_data['wd_product_categories_shortcode_thumbnail_width']) > 0 )? absint($wd_data['wd_product_categories_shortcode_thumbnail_width']) : 370;
			$wd_product_categories_shortcode_thumbnail_height = ( isset($wd_data['wd_product_categories_shortcode_thumbnail_height']) && absint($wd_data['wd_product_categories_shortcode_thumbnail_height']) > 0 )? absint($wd_data['wd_product_categories_shortcode_thumbnail_height']) : 540;
			
			add_image_size('blog_single',$wd_blog_single_thumbnail_width); /* image for blog thumbnail */
			
			add_image_size('prod_small_thumb',141,141,true); /* image for slideshow */
			//add_image_size('prod_tini_thumb',70,90,true); /* image for slideshow */
			add_image_size('slider_thumb_wide',150,150,true); /* image for slideshow */
			/*add_image_size('slideshow_box',960,350,true); image for slideshow */
			/*add_image_size('slideshow_wide',1200,450,true); image for slideshow */
			add_image_size('slider',222,48,true); /* image for slideshow */
			add_image_size('slider_thumb_box',100,100,true); /* image for slideshow */
			add_image_size('related_thumb',400,255,true); /* image for slideshow */
			add_image_size('blog_shortcode_auto',$wd_blog_shortcode_auto_thumbnail_width); /* blog shortcode */
			add_image_size('blog_shortcode',$wd_blog_shortcode_thumbnail_width,$wd_blog_shortcode_thumbnail_height, true);
			add_image_size('blog_recent',$wd_blog_shortcode_widget_thumbnail_width,$wd_blog_shortcode_widget_thumbnail_height,true);
			add_image_size('blog_recent_2', 230, 124,true);
			
			add_image_size('blog_thumb',$wd_blog_thumbnail_width,$wd_blog_thumbnail_height,true); /* image for slideshow */
			//add_image_size('woo_shortcode',70,90,true); /* image for testimonial */
			//add_image_size('wd_hot_product',160,160,true); /* image for testimonial */
			
			add_image_size('wd_cart_dropdown',$wd_tini_shopping_cart_thumbnail_width,$wd_tini_shopping_cart_thumbnail_height,true);
			add_image_size('wd_single_product_thumbnail_',$wd_single_products_thumbnail_width,$wd_single_products_thumbnail_height,true);
			add_image_size('wd_sub_categories_thumbnail',$wd_product_subcategories_thumbnail_width,$wd_product_subcategories_thumbnail_height,true); /* image for single product detail */
			add_image_size('wd_categories_thumbnail',$wd_product_categories_shortcode_thumbnail_width,$wd_product_categories_shortcode_thumbnail_height,true); /* image for single product detail */
			
			add_image_size('wd_shop_small_image', 150, 178, true);
			
			add_image_size('wd_menu_icon', 23, 23, true);
			
			add_image_size('wd_testimonial_widget', 270, 124, true);
			
			add_image_size('wd_recent_blog_slider', 370, 270, true);
			
			add_image_size('wd_gallery_1', 600, 600, true);
			add_image_size('wd_gallery_2', 300, 600, true);
			add_image_size('wd_gallery_3', 600, 300, true);
			add_image_size('wd_gallery_4', 300, 300, true);
			
			add_image_size('wd_custom_product_sc', 900, 900, true);
		}
	}
}
?>