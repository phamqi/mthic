<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<!-- <header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header> -->
<!-- main -->
	<div class="main__carousel">
        <div id="indicator" class="main__carousel-indicators">
          <span id="dot1" onclick="currentSlide(1)" class="main__carousel-dot"></span>
          <span id="dot2" onclick="currentSlide(2)" class="main__carousel-dot"></span>
          <span id="dot3" onclick="currentSlide(3)" class="main__carousel-dot"></span>
        </div>
        <div class="main__carousel-list">
          <div class="main__carousel-item">
            <a  class="main__carousel-link" href="">
			<picture>
				<source media="(min-width: 960px)" srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-1296x.jpg">
				<source media="(min-width: 650px)" srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg">
				<source srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-540x.jpg">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg" alt="a" style="width:100%">
			</picture>
            </a>
          </div>
		  <div class="main__carousel-item">
            <a  class="main__carousel-link" href="">
			<picture>
				<source media="(min-width: 960px)" srcset="<?php bloginfo('template_directory') ?>/assets/img/slide2-1296x.jpg">
				<source media="(min-width: 650px)" srcset="<?php bloginfo('template_directory') ?>/assets/img/slide2-700x.jpg">
				<source srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-540x.jpg">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/slide2-700x.jpg" alt="a" style="width:100%">
			</picture>
            </a>
          </div>
          <div class="main__carousel-item">
            <a  class="main__carousel-link" href="">
			<picture>
				<source media="(min-width: 960px)" srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-1296x.jpg">
				<source media="(min-width: 650px)" srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg">
				<source srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-540x.jpg">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg" alt="a" style="width:100%">
			</picture>
            </a>
          </div>
        </div>
          <button id="carousel-prev" class="main__carousel-prev" ><i class="fas fa-chevron-left"></i></button>
          <button id="carousel-next" class="main__carousel-next" ><i class="fas fa-chevron-right"></i></button>
	</div>
	<div class="main__content container">
		<div class="main__flashsale-title">
			<h1>F</h1><h1 class="main__flashsale-thunder"></h1><h1>ash Sale</h1>
		</div>
		<div class="main__flashsale-product">
			<input type="checkbox" id="main-flashsale-checkbox" class="main__flashsale-checkbox">
			<div class="main__flashsale-list">		 	
				<?php echo do_shortcode('[products limit="12" on_sale="true" ]'); ?>  <!--class="quick-sale" -->
			</div>
		</div>
		<label class="main__flashsale-prev" for="main-flashsale-checkbox"><i class="fas fa-chevron-left"></i></label>
		<label class="main__flashsale-next" for="main-flashsale-checkbox"><i class="fas fa-chevron-right"></i></label>

	</div>

<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>
</div>
<?php 
get_footer( 'shop' );
?>
