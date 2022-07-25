<?php
namespace Ets; 

/**
 * Cofigures all theme related options
 */
class Theme extends \Timber\Site {

	/**
	 * Holds the version of custom scripts
	 *
	 * @var string version number
	 */
	protected $script_ver   = '1.9';

	/**
	 * Name of this theme
	 * used for prefixing
	 *
	 * @var string theme name
	 */
	protected $theme_name   = 'ets';

	/**
	 * Hooks the methods
	 */
	/** Add timber support. */
	public function __construct() {
		add_action('wp_enqueue_scripts',array($this, 'ets_load_custom_scripts') );
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter('nav_menu_item_id', array($this,'clear_nav_menu_item_id', 10, 3) );
		add_filter('nav_menu_css_class', array($this,'clear_nav_menu_item_class', 10, 3) );
		add_filter('nav_menu_css_class', array($this,'add_additional_class_on_li', 10, 3) );
		add_filter('nav_menu_link_attributes', array($this,'add_additional_class_on_a', 1, 3) );
		add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax');
		add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax');
		load_theme_textdomain('etstwig');
		parent::__construct();
	}

	//add style and script
	public function ets_load_custom_scripts() {
	    wp_enqueue_script( 'popper_min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');

	    wp_enqueue_script( 'slick_min_js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',array('jquery'), '0.1',true);

	    wp_enqueue_script( 'bootstrap_min_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');

	    wp_enqueue_script( 'script', get_template_directory_uri().'/assests/js/main.js', array('jquery'), '0.1', true );

	    $see_more_array = array(
	                            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
	                        );
	    wp_localize_script( 'script', 'see_more_post', $see_more_array );

	    wp_enqueue_script( 'sticky-header', get_template_directory_uri().'/assests/js/sticky-header.js', array(), '0.1', true );

	   wp_enqueue_style( 'style', get_template_directory_uri().'/assests/css/style.css', array(), '0.1','all' );

	    wp_enqueue_style( 'bootstrap-min-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );

	    wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );

	    wp_enqueue_style( 'awesome-min-css', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css' );

	    wp_enqueue_style( 'all-min-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' );
	    
	    wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/assests/css/slick-theme.css', array(), '0.1','all' );
	}

	/** This is where you can register custom post types. */
	public function register_post_types() {
		 register_nav_menus( array('primary-menu' =>'header-menu') );

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	public function add_to_context( $context ) {
		//$context['menu']  = new Timber\Menu('primary-menu');
		$context['site']  = $this;
		return $context;
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
   		add_theme_support( 'custom-logo' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

	
	}
	//remove menu by default classes and id
	public function clear_nav_menu_item_id($id, $item, $args) {
	    return "";
	}

	public function clear_nav_menu_item_class($classes, $item, $args) {
	    return array();
	}

	//add new classes in li menus
	public function add_additional_class_on_li($classes, $item, $args) {

	    if(isset($args->add_li_class)) {
	    }
	        $classes[] = 'nav-item';
	    return $classes;
	}

	//add class in link
	public function add_additional_class_on_a($classes, $item, $args)
	{
	    if (isset($args->add_a_class)) {
	        $classes['class'] = $args->add_a_class;
	    }
	    return $classes;
	}
}
new Theme();