<?php
/**
 * Main functions file
 *
 * This file is the WordPress functions.php file, which which contains many
 * of the functions for set up and operation of the theme
 *
 * @package     Canuck WordPress Theme
 * @copyright   Copyright (C) 2017  Kevin Archibald
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/**
 * ---- load files ---------------
 */
require( get_template_directory() . '/css/custom-css.php' );
require( get_template_directory() . '/includes/post-functions.php' );
require( get_template_directory() . '/includes/custom-functions.php' );
require( get_template_directory() . '/includes/custom-header.php' );
if ( is_admin() ) {
	require( get_template_directory() . '/includes/metabox-functions.php' );
	require( get_template_directory() . '/includes/theme-page.php' );
}
if ( is_customize_preview() ) {
	require( get_template_directory() . '/includes/kha-customizer.php' );
}
require( get_template_directory() . '/widgets/class-canuck-author-widget.php' );
require( get_template_directory() . '/widgets/class-canuck-category-widget.php' );
require( get_template_directory() . '/widgets/class-canuck-recent-posts-widget.php' );
if ( false === get_theme_mod( 'canuck_disable_widget_slider' ) ? true : false ) {
	require( get_template_directory() . '/widgets/class-canuck-slider-widget.php' );
}
require( get_template_directory() . '/includes/media-grabber.php' );
if ( class_exists( 'WooCommerce' ) ) {
	require( get_template_directory() . '/includes/woocommerce-functions.php' );
}

if ( ! function_exists( 'canuck_load_js' ) ) {
	/**
	 * Load jQuery Scripts
	 *
	 * Function to load jquery scripts. Some of the functions are conditionally loaded
	 * so that the user can disable naughty scripts.
	 *
	 * @uses is_admin() @uses wp_enqueue_script @uses get_template_directory_uri()
	 */
	function canuck_load_js() {
		$page_template = basename( get_page_template() );
		$disable_colorbox = get_theme_mod( 'canuck_disable_colorboxjs' ) ? true : false;
		$disable_fitvidsjs = get_theme_mod( 'canuck_disable_fitvidsjs' ) ? true : false;
		$disable_smoothscroll = get_theme_mod( 'canuck_disable_smoothscroll' ) ? true : false;
		$disable_scrollreveal = get_theme_mod( 'canuck_disable_scrollreveal' ) ? true : false;
		$disable_widget_slider = get_theme_mod( 'canuck_disable_widget_slider' ) ? true : false;
		$include_pinterest_pinit = get_theme_mod( 'canuck_include_pinit' ) ? true : false;
		if ( ! is_admin() ) {
			// Option to disable fitvids.
			if ( false === $disable_fitvidsjs ) {
				wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '' , true );
				wp_enqueue_script( 'canuck-fitvids-doc-ready', get_template_directory_uri() . '/js/fitvids-doc-ready.js', array( 'jquery' ), '', true );
			}
			// Option to disable smoothscroll.
			if ( false === $disable_smoothscroll ) {
				wp_enqueue_script( 'canuck-smoothscroll', get_template_directory_uri() . '/js/smooth-scroll-scripts.js', array( 'jquery' ), '', true );
			}
			// Option to disable colorbox.
			if ( false === $disable_colorbox ) {
				wp_enqueue_script( 'jquery-colorbox', get_template_directory_uri() . '/js/colorbox/jquery.colorbox-min.js', array( 'jquery' ), '', true );
				wp_enqueue_script( 'canuck-colorbox-doc-ready', get_template_directory_uri() . '/js/colorbox/colorbox_doc_ready.js', array( 'jquery' ), '', true );
			}
			// Load mobile script.
			wp_enqueue_script( 'canuck-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '', true );
			// Load custom js.
			wp_enqueue_script( 'canuck-custom_js', get_template_directory_uri() . '/js/doc-ready-scripts.js', array( 'jquery' ), '', true );
			// Load flex slider.
			wp_enqueue_script( 'jquery-flex-slider', get_template_directory_uri() . '/js/flex-slider/jquery.flexslider.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'canuck-custom-flex-js', get_template_directory_uri() . '/js/flex-doc-ready-scripts.js', array( 'jquery' ), '', true );
			// Load sticky menu.
			wp_enqueue_script( 'canuck-sticky-menu-js', get_template_directory_uri() . '/js/canuck-sticky-menu.js', array( 'jquery' ), '', true );
			// Load parallax and scrollreveal if static home page.
			if ( 'template-home.php' === $page_template ) {
				wp_enqueue_script( 'parralax-js', get_template_directory_uri() . '/js/parallax.min.js', array( 'jquery' ), '', true );
				if ( false === $disable_scrollreveal ) {
					wp_enqueue_script( 'scrollreveal-js', get_template_directory_uri() . '/js/scrollreveal.min.js', array( 'jquery' ), '', true );
					wp_enqueue_script( 'canuck-scrollreveal-js', get_template_directory_uri() . '/js/scrollreveal-doc-ready-scripts.js', array( 'jquery' ), '', true );
				}
				// Load Owl slider.
				wp_enqueue_script( 'jquery-owl-carousel', get_template_directory_uri() . '/js/owl/owl.carousel.min.js', array( 'jquery' ), '', true );
				wp_enqueue_script( 'canuck-custom-owl-js', get_template_directory_uri() . '/js/owl-doc-ready-scripts.js', array( 'jquery' ), '', true );
			}
			// Conditional load widget slider.
			if ( false === $disable_widget_slider ) {
				wp_enqueue_script( 'canuck-widget-flex-js', get_template_directory_uri() . '/js/flex-widget-doc-ready-scripts.js', array( 'jquery' ), '', true );
			}
			if ( 'template-masonry.php' === $page_template || 'template-portfolio.php' === $page_template ) {
				wp_enqueue_script( 'jquery-masonry' );
				wp_enqueue_script( 'imagesloaded' );
				wp_enqueue_script( 'canuck-masonry', get_template_directory_uri() . '/js/masonry-doc-ready-scripts.js', array( 'jquery' ), '', true );
			}
			// Pinterest Pin It.
			if ( true === $include_pinterest_pinit ) {
				wp_enqueue_script( 'pinit-js', get_template_directory_uri() . '/js/pinit.js', array( 'jquery' ), '', true );
			}
			// Load threaded comments.
			if ( is_singular() && comments_open() && 1 === ( get_option( 'thread_comments' ) ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}// End if().
	}
	add_action( 'wp_enqueue_scripts', 'canuck_load_js' );
}// End if().

if ( ! function_exists( 'canuck_styles' ) ) {
	/**
	 * Load CSS Styles
	 *
	 * Function to load css styles. Some of the style sheets are conditionally loaded
	 * so as they are part of jQuery plugins.
	 *
	 * @uses get_theme_mods() found in canuck-options.php
	 * WordPress functions - see codex
	 * @uses wp_register_style() @uses wp_enqueue_style @uses get_template_directory_uri()
	 * @uses get_template_directory_uri()
	 */
	function canuck_styles() {
		$page_template = get_page_template_slug();
		// Load theme fonts.
		$theme_fonts = canuck_fonts();
		if ( 'google' === $theme_fonts['header']['type'] ) {
			wp_enqueue_style( 'canuck-google-1', 'https://fonts.googleapis.com/css?family=' . $theme_fonts['header']['enqueue'] );
		}
		if ( 'google' === $theme_fonts['body']['type'] ) {
			if ( $theme_fonts['header']['enqueue'] !== $theme_fonts['body']['enqueue'] ) {
				wp_enqueue_style( 'canuck-google-2', 'https://fonts.googleapis.com/css?family=' . $theme_fonts['body']['enqueue'] );
			}
		}
		if ( 'google' === $theme_fonts['page']['type'] ) {
			if ( $theme_fonts['header']['enqueue'] !== $theme_fonts['page']['enqueue'] && $theme_fonts['body']['enqueue'] !== $theme_fonts['page']['enqueue'] ) {
				wp_enqueue_style( 'canuck-google-3', 'https://fonts.googleapis.com/css?family=' . $theme_fonts['page']['enqueue'] );
			}
		}
		// Load skins.
		$skinfile = get_theme_mod( 'canuck_color_scheme', 'gray-pink' );
		// Load option css.
		$ka_css = canuck_custom_css();
		if ( is_child_theme() ) {
			wp_enqueue_style( 'canuck-parent', get_template_directory_uri() . '/style.css', array() );
			if ( 'template-portfolio.php' === $page_template ) {
				wp_enqueue_style( 'canuck-template-child', get_template_directory_uri() . '/css/template-portfolio-style.css', array( 'canuck-parent' ) );
			} elseif ( 'template-home.php' === $page_template ) {
				wp_enqueue_style( 'canuck-template-child', get_template_directory_uri() . '/css/template-home-style.css', array( 'canuck-parent' ) );
			} else {
				wp_enqueue_style( 'canuck-template-child', get_template_directory_uri() . '/css/template-blank-style.css', array( 'canuck-parent' ) );
			}
			wp_enqueue_style( 'canuck-skin', get_template_directory_uri() . '/css/' . esc_html( $skinfile ) . '.css', array( 'canuck-template-child' ) );
			wp_add_inline_style( 'canuck-parent', $ka_css );
			/** Note that fontawesome and owl styles are loaded here in case they are not loaded in the child theme
			 *  It is better to load in the child theme (with the same handle) as all styles will then be loaded before the child theme style. */
			wp_enqueue_style( 'font-awesome-style',get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array() );
			wp_enqueue_style( 'owl-carousel-style',get_template_directory_uri() . '/js/owl/assets/owl.carousel.css', array() );
		} else {
			wp_enqueue_style( 'font-awesome-style',get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css',array() );
			wp_enqueue_style( 'owl-carousel-style',get_template_directory_uri() . '/js/owl/assets/owl.carousel.css',array() );
			wp_enqueue_style( 'canuck-style', get_stylesheet_uri(), array() );
			if ( 'template-portfolio.php' === $page_template ) {
				wp_enqueue_style( 'canuck-template', get_theme_file_uri( '/css/template-portfolio-style.css' ), array( 'canuck-style' ), '1.0' );
			} elseif ( 'template-home.php' === $page_template ) {
				wp_enqueue_style( 'canuck-template', get_theme_file_uri( '/css/template-home-style.css' ), array( 'canuck-style' ), '1.0' );
			}
			wp_enqueue_style( 'canuck-skin', get_theme_file_uri( '/css/' . esc_html( $skinfile ) . '.css' ), array( 'canuck-style' ), '1.0' );
			wp_add_inline_style( 'canuck-style', $ka_css );
		}
	}
	add_action( 'wp_enqueue_scripts', 'canuck_styles' );
}// End if().

if ( ! function_exists( 'canuck_register_menu' ) ) {
	/**
	 * Register menus.
	 */
	function canuck_register_menu() {
		register_nav_menu( 'canuck_primary' , __( 'Primary Menu' , 'canuck' ) );
		register_nav_menu( 'canuck_social', __( 'Social Menu' , 'canuck' ) );
	}
	add_action( 'init', 'canuck_register_menu' );
}

/**
 * Add excerpt support for pages
 */
function canuck_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'canuck_add_excerpts_to_pages' );

if ( ! function_exists( 'canuck_theme_supports' ) ) {
	/**
	 * Theme Support Functions.
	 *
	 * This function adds all theme support functions on the after_setup_theme hook.
	 * See the WordPress Codex for each support.
	 */
	function canuck_theme_supports() {
		// Post formats.
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'quote', 'video' ) );
		// Editor-style.
		add_editor_style();
		// Custom Backgrounds.
		add_theme_support( 'custom-background' );
		// Feeds.
		add_theme_support( 'automatic-feed-links' );
		// Thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'canuck_feature', 1100, 367, true );
		add_image_size( 'canuck_small15', 300, 200, true );
		add_image_size( 'canuck_med15', 800, 533, true );
		add_image_size( 'canuck_gallery', 600, 331, true );
		add_image_size( 'canuck_gallery_thumb', 90, 60, true );
		set_post_thumbnail_size( 1100, 733, true );
		// Enable translation.
		load_theme_textdomain( 'canuck', get_template_directory() . '/languages' );
		// HTML5 markup for comment lists, comment forms, search forms and galleries.
		add_theme_support( 'html5' , array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		// Title tags.
		add_theme_support( 'title-tag' );
		// Custom logo support.
		$canuck_logo_args = array(
			'height'      => 100,
			'width'       => 230,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $canuck_logo_args );
		// Global width.
		$GLOBALS['content_width'] = 1600;
		// WooCommerce supports.
		if ( class_exists( 'WooCommerce' ) ) {
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-slider' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
	add_action( 'after_setup_theme', 'canuck_theme_supports' );
}// End if().

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 * from twentyseventeen.
 */
function canuck_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );// XSS OK.
	}
}
add_action( 'wp_head', 'canuck_pingback_header' );

if ( ! function_exists( 'canuck_register_sidebars' ) ) {
	/**
	 * Register Side bars
	 * Thanks to Justin Tadlock for the post on sidebars
	 *
	 * @link http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress
	 */
	function canuck_register_sidebars() {
		register_sidebar( array(
			'id' => 'canuck_default_sidebar_a',
			'name' => __( 'Default A', 'canuck' ),
			'description' => __( 'Use for standard WordPress pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_default_sidebar_b',
			'name' => __( 'Default B', 'canuck' ),
			'description' => __( 'Second sidebar for standard WordPress pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar(array(
			'id' => 'canuck_blog_sidebar_a',
			'name' => __( 'Blog A', 'canuck' ),
			'description' => __( 'First Blog Sidebar', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_blog_sidebar_b',
			'name' => __( 'Blog B', 'canuck' ),
			'description' => __( 'Second Blog Sidebar', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_404_sidebar_a',
			'name' => __( 'Error 404 A', 'canuck' ),
			'description' => __( 'Use this for your 404 page', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_404_sidebar_b',
			'name' => __( 'Error 404 B', 'canuck' ),
			'description' => __( 'Use this for your 404 page', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_contact_sidebar_a',
			'name' => __( 'Contact A', 'canuck' ),
			'description' => __( 'Use this for your Contact page', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar(array(
			'id' => 'canuck_contact_sidebar_b',
			'name' => __( 'Contact B', 'canuck' ),
			'description' => __( 'Use this for your Contact page', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_about_sidebar_a',
			'name' => __( 'About A', 'canuck' ),
			'description' => __( 'Use this for your About page', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_about_sidebar_b',
			'name' => __( 'About B', 'canuck' ),
			'description' => __( 'Use this for your About page', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_home_section1_sidebar',
			'name' => __( 'Home Page Section 1', 'canuck' ),
			'description' => __( 'Used when the Home Page Section 1 useage option is set to widget.', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_home_section3_sidebar',
			'name' => __( 'Home Page Section 3', 'canuck' ),
			'description' => __( 'Used when the Home Page Section 3 useage option is set to widget.', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_home_section5_sidebar',
			'name' => __( 'Home Page Section 5', 'canuck' ),
			'description' => __( 'Used when the Home Page Section 5 useage option is set to widget.', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_home_section7_sidebar',
			'name' => __( 'Home Page Section 7', 'canuck' ),
			'description' => __( 'Used when the Home Page Section 7 useage option is set to widget.', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar(array(
			'id' => 'canuck_home_section10_sidebar',
			'name' => __( 'Home Page Section 10', 'canuck' ),
			'description' => __( 'Used when the Home Page Section 10 useage option is set to widget.', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_home_section11_sidebar',
			'name' => __( 'Home Page Section 11', 'canuck' ),
			'description' => __( 'Used when the Home Page Section 11 useage option is set to widget.', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar(array(
			'id' => 'canuck_footer_a_sidebar',
			'name' => __( 'Footer-A', 'canuck' ),
			'description' => __( 'First column in footer', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_footer_b_sidebar',
			'name' => __( 'Footer-B', 'canuck' ),
			'description' => __( 'Second column in footer', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_footer_c_sidebar',
			'name' => __( 'Footer-C', 'canuck' ),
			'description' => __( 'Third column in footer', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar(array(
			'id' => 'canuck_footer_d_sidebar',
			'name' => __( 'Footer-D', 'canuck' ),
			'description' => __( 'Fourth column in footer', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_sidebar_1',
			'name' => __( 'Sidebar 1', 'canuck' ),
			'description' => __( 'Use for your custom pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_sidebar_2',
			'name' => __( 'Sidebar 2', 'canuck' ),
			'description' => __( 'Use for your custom pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_sidebar_3',
			'name' => __( 'Sidebar 3', 'canuck' ),
			'description' => __( 'Use for your custom pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar(array(
			'id' => 'canuck_sidebar_4',
			'name' => __( 'Sidebar 4', 'canuck' ),
			'description' => __( 'Use for your custom pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_sidebar_5',
			'name' => __( 'Sidebar 5', 'canuck' ),
			'description' => __( 'Use for your custom pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'id' => 'canuck_sidebar_6',
			'name' => __( 'Sidebar 6', 'canuck' ),
			'description' => __( 'Use for your custom pages', 'canuck' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'id' => 'canuck_woo_sidebar_a',
				'name' => __( 'WooCommerce Sidebar a', 'canuck' ),
				'description' => __( 'Use this side bar for the Woo Commerce Shop Page', 'canuck' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
			register_sidebar( array(
				'id' => 'canuck_woo_sidebar_b',
				'name' => __( 'WooCommerce Sidebar b', 'canuck' ),
				'description' => __( 'Use this side bar for the Woo Commerce Shop Page', 'canuck' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
	}
	add_action( 'widgets_init', 'canuck_register_sidebars' );
}// End if().
