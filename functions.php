<?php
/**
 * Walletstore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Walletstore
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'walletstore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function walletstore_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Walletstore, use a find and replace
		 * to change 'walletstore' to the name of your theme in all the template files.
		 */
		// add_action( 'woocommerce_after_shop_loop_item_title', 'test', 5 );s
		add_action('init', function(){
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		});
		if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
			function woocommerce_template_loop_product_thumbnail() {
				echo woocommerce_get_product_thumbnail();
			} 
		}
		if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
			function woocommerce_get_product_thumbnail( $size = 'shop_catalog' ) {
				global $post, $woocommerce;
				$output = '';
				if ( has_post_thumbnail() ) {
					$src = get_the_post_thumbnail_url( $post->ID, $size );
					$output .= '<img class=" lazyload " src="http://localhost/mthic/wp-content/uploads/woocommerce-placeholder.png" data-src="' . $src . '" data-srcset="' . $src . '" alt="Lazy loading image">';
				} else {
					 $output .= wc_placeholder_img( $size );
				}
				return $output;
			}
		}


		function add_custom_image_class($class) {
			$class .= ' my-custom-class';
			return $class;
		}
		add_filter('get_image_tag_class', 'add_custom_image_class' );

		// function WPTime_add_custom_class_to_all_images($content){
		// 	/* Filter by Qassim Hassan - https://wp-time.com */
		// 	$my_custom_class = "myclassimg"; // your custom class
		// 	$add_class = str_replace('<img', '<img class="'.$my_custom_class.' ', $content); // add class
		// 	return $add_class; // display class to image
		// }
		add_filter('the_content', 'WPTime_add_custom_class_to_all_images');
          
		function new_badge() {
			global $product;
				$newness_days = 30; // Number of days the badge is shown
				$created = strtotime( $product->get_date_created() );
				if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
					echo '<span class="new-badge">' . esc_html__( 'NEW', 'woocommerce' ) . '</span>';
			}
		}
		add_action( 'woocommerce_before_shop_loop_item_title', 'new_badge', 3 );

		remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb' , 20, 0);

		add_action( 'woocommerce_after_shop_loop_item_title', 'my_woocommerce_total_sales', 5 );
		function my_woocommerce_total_sales() {
			global $product;
			$units_sold = $product->get_total_sales();
			echo '<div class="product-total-sales" ><div>' . sprintf( __( 'Đã bán: %s', 'woocommerce' ), $units_sold ) . '</div>';
		 }

		add_action( 'woocommerce_sale_flash', 'sale_badge_percentage', 25 ); 
		function sale_badge_percentage() {
		global $product;
		if ( ! $product->is_on_sale() ) return;
		if ( $product->is_type( 'simple' ) ) {
			$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
		} elseif ( $product->is_type( 'variable' ) ) {
			$max_percentage = 0;
			foreach ( $product->get_children() as $child_id ) {
				$variation = wc_get_product( $child_id );
				$price = $variation->get_regular_price();
				$sale = $variation->get_sale_price();
				if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
				if ( $percentage > $max_percentage ) {
					$max_percentage = $percentage;
				}
			}
		}
		if ( $max_percentage > 0 ) echo "<span class='product-sale'>-" . round($max_percentage) . "%</span>"; // If you would like to show -40% off then add text after % sign
		}


		if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

			/**
			 * Show the product title in the product loop. By default this is an H2.
			 */
			function my_woocommerce_template_loop_product_title() {
				echo '</div><p title= "'. get_the_title() .'" class="product-title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
		remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
		add_action('woocommerce_shop_loop_item_title','my_woocommerce_template_loop_product_title',10);

		// if ( ! function_exists( 'woocommerce_template_loop_product_link_open' ) ) {
		// 	/**
		// 	 * Insert the opening anchor tag for products in the loop.
		// 	 */
			function my_woocommerce_template_loop_product_link_open() {
				global $product;
		
				$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		
				echo '<a title="'. get_the_title() .'" href="' . esc_url( $link ) . '" class=" product-link woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-img">';
			}
		
		remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
		add_action('woocommerce_before_shop_loop_item','my_woocommerce_template_loop_product_link_open',10);
		add_theme_support('woocommerce');
		add_theme_support('custom-logo');

		load_theme_textdomain( 'walletstore', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'walletstore' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'walletstore_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'walletstore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function walletstore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'walletstore_content_width', 640 );
}
add_action( 'after_setup_theme', 'walletstore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function walletstore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'walletstore' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'walletstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'walletstore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function walletstore_scripts() {
	wp_enqueue_style( 'walletstore-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'walletstore-style', 'rtl', 'replace' );

	wp_enqueue_script( 'walletstore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'walletstore_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

