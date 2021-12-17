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
		//remvoe sale badge single peoduct

	   remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash', 10);
		//remove product image
		remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_images', 20 );

		function add_content_after_addtocart() {
			$current_product_id = get_the_ID();
			$product = wc_get_product( $current_product_id );
			$checkout_url = WC()->cart->get_checkout_url();
			if( $product->is_type( 'simple' ) ){
				echo '<a href="'.$checkout_url.'?add-to-cart='.$current_product_id.'" class="buy-now-simple">Buy Now</a>';
			}
			function buy_now_variable() {
				echo $_POST['variation-id'];
	
			}
		}
		add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart' );

		// Replace range price to selected product's price
		function selected_variation_price_replace_variable_price_range(){
			global $product;

			if( $product->is_type('variable') ):
			?><style>
		.woocommerce-variation-price {
			display: none;
		}
		</style>
		<script>
		jQuery(function($) {
			var p = 'p.price'
			q = $(p).html();

			$('form.cart').on('show_variation', function(event, data) {
				if (data.price_html) {
					$(p).html(data.price_html);
				}
			}).on('hide_variation', function(event) {
				$(p).html(q);
			});
		});
		</script>
		<?php
			endif;
		}
		add_action('woocommerce_before_add_to_cart_form', 'selected_variation_price_replace_variable_price_range');
		
		//remove img s ingle product
		remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_images', 20 );


		//remove short description	
		remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20);
		//remove a linh in image single product
		function custom_remove_product_link( $html ) {
			return strip_tags( $html, '<div><img>' );
		}
		add_filter( 'woocommerce_single_product_image_thumbnail_html', 'custom_remove_product_link' );

		
		//remove price variation product
		function grouped_price_range_from( $price, $product, $child_prices ) {
		$prices = array( min( $child_prices ), max( $child_prices ) );
		$price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
		return $price;
		}
		add_filter( 'woocommerce_grouped_price_html', 'grouped_price_range_from', 10, 3 );

		function wc_varb_price_range( $wcv_price, $product ) {
			$prefix = sprintf('%s ', __('', 'wcvp_range'));
			$wcv_reg_min_price = $product->get_variation_regular_price( 'min', true );	
			$wcv_min_sale_price    = $product->get_variation_sale_price( 'min', true );	
			$wcv_max_price = $product->get_variation_price( 'max', true );	
			$wcv_min_price = $product->get_variation_price( 'min', true );		
			$wcv_price = ( $wcv_min_sale_price == $wcv_reg_min_price ) ?
		
				wc_price( $wcv_reg_min_price ) :
		
				'<ins>' . wc_price( $wcv_min_sale_price ) . '</ins>'.'<ins class="max-price"> - ' . wc_price( $wcv_reg_min_price ) . '</ins>';		
			return ( $wcv_min_price == $wcv_max_price ) ?		
				$wcv_price :		
				sprintf('%s %s', $prefix, $wcv_price);
		}
		add_filter( 'woocommerce_variable_sale_price_html', 'wc_varb_price_range', 10, 2 );
		add_filter( 'woocommerce_variable_price_html', 'wc_varb_price_range', 10, 2 );

		//remove star rating
		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

		//add star average rating, view, units sold
		function add_start_average_rating (){
			global $product;
			$average = $product->get_average_rating();
			$review_count = $product->get_review_count();
			$reviewperk = $review_count / 1000;
			$total_sales = $product->get_total_sales();
			$total_salesperk = $total_sales / 1000;
			echo '<div class="rate-review-total-price"><div class="rate-review-total"><p class="avarage-rating"><i class="fas fa-star"></i> ' . sprintf( __( '%s', 'woocommerce' ), $average ).wc_get_rating_html($average) . '</p>';
			if( $reviewperk >= 1){
				echo '<p class="review-count">'. sprintf( __('Đánh giá: %s', 'woocomerece'), $reviewperk).'k'. '</p>';
			} else {
				echo '<p class="review-count">'. sprintf( __('Đánh giá: %s', 'woocomerece'), $review_count). '</p>';
			}
			if( $total_salesperk >= 1) {
				echo '<p class="total-sales">' . sprintf( __( 'Đã bán: %s', 'woocommerce' ), $total_sales ) .'k'. '</p></div>';
			} else {
				echo '<p class="total-sales">' . sprintf( __( 'Đã bán: %s', 'woocommerce' ), $total_sales ) . '</p></div>';
			}	
		 }
		add_action('woocommerce_single_product_summary', 'add_start_average_rating', 5, 10);


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
			$units_sold_per_k = $units_sold / 1000;
			if ( $units_sold_per_k >= 1) {
				echo '<div class="product-total-sales" ><div>' . sprintf( __( 'Đã bán: %s k', 'woocommerce' ), $units_sold_per_k ) . '</div>';
			} else {
			echo '<div class="product-total-sales" ><p>' . sprintf( __( 'Đã bán: %s ', 'woocommerce' ), $units_sold ) . '</p>';
			}
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