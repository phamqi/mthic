<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walletstore
 */

get_header();
?>

<main  id="primary" class="site-main">
    <div class="main__carousel">
        <div id="indicator" class="main__carousel-indicators">
            <span id="dot1" onclick="currentSlide(1)" class="main__carousel-dot"></span>
            <span id="dot2" onclick="currentSlide(2)" class="main__carousel-dot"></span>
            <span id="dot3" onclick="currentSlide(3)" class="main__carousel-dot"></span>
        </div>
        <div  id="main-carousel-list" class="main__carousel-list">
            <div class="main__carousel-item">
                <a class="main__carousel-link" href="">
                    <picture>
                        <source media="(min-width: 960px)"
                            srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-1296x.jpg">
                        <source media="(min-width: 650px)"
                            srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg">
                        <source srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-540x.jpg">
                        <img src="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg" alt="a"
                            style="width:100%">
                    </picture>
                </a>
            </div>
            <div class="main__carousel-item">
                <a class="main__carousel-link" href="">
                    <picture>
                        <source media="(min-width: 960px)"
                            srcset="<?php bloginfo('template_directory') ?>/assets/img/slide2-1296x.jpg">
                        <source media="(min-width: 650px)"
                            srcset="<?php bloginfo('template_directory') ?>/assets/img/slide2-700x.jpg">
                        <source srcset="<?php bloginfo('template_directory') ?>/assets/img/slide2-540x.jpg">
                        <img src="<?php bloginfo('template_directory') ?>/assets/img/slide2-700x.jpg" alt="a"
                            style="width:100%">
                    </picture>
                </a>
            </div>
            <div>
            <div class="main__carousel-item">
                <a class="main__carousel-link" href="">
                    <picture>
                        <source media="(min-width: 960px)"
                            srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-1296x.jpg">
                        <source media="(min-width: 650px)"
                            srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg">
                        <source srcset="<?php bloginfo('template_directory') ?>/assets/img/slide1-540x.jpg">
                        <img src="<?php bloginfo('template_directory') ?>/assets/img/slide1-700x.jpg" alt="a"
                            style="width:100%">
                    </picture>
                </a>
            </div>
            </div>
        </div>
        <button id="carousel-prev" class="main__carousel-prev"><i class="fas fa-chevron-left"></i></button>
        <button id="carousel-next" class="main__carousel-next"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="main__content cs-container">
        <div class="main__flashsale-title">
            <h1>F</h1>
            <h1 class="main__flashsale-thunder"></h1>
            <h1>ash Sale</h1>
        </div>
        <div class="main__flashsale-product">
            <input type="checkbox" id="main-flashsale-checkbox" class="main__flashsale-checkbox">
            <div id="main-flashsale-list" class="main__flashsale-list">
                <?php echo do_shortcode('[products limit="10" lazy_load="true" ]'); ?>
                <!-- on_sale="true" class="quick-sale" -->
            </div>
            <label class="main__flashsale-prev" for="main-flashsale-checkbox"><i
                    class="fas fa-chevron-left"></i></label>
            <label class="main__flashsale-next" for="main-flashsale-checkbox"><i
                    class="fas fa-chevron-right"></i></label>
        </div>
        <div class="main__bestsaller-title">
            <h1>BEST SALLER</h1>
        </div>
        <div class="main__bestsaller-product">
            <div class="main__bestsaller-top">
                <?php 
			global $wpdb;
			global $product;
			$count = 1;
				$results = $wpdb->get_results(
					"SELECT min_price, product_id FROM $wpdb->wc_product_meta_lookup 
					WHERE max_price = 20.000
					LIMIT 3");
				foreach($results as $release) {
					if($count ==2) {
						echo '<div class="main__bestsaller-23">';
					}
					echo '<div class="main__bestsaller-'. $count; echo '">';
					echo '<span class="main__bestsaller-badge-'.$count.'">'.$count .'</span>';
					echo '<a href="' .get_the_permalink($release->product_id) . '">';
					echo '<div class="main__bestsaller-details">';
					echo '<p>'; echo  get_the_title($release->product_id ); echo '</p>';
					echo '<span>'. $release->min_price .'</span></div>';
					echo '<img src="'; ?> <?php echo get_the_post_thumbnail_url($release->product_id); ?> <?php echo '"></a></div>';
					if($count ==3) {
						echo '</div>';
					}
					$count ++;
				}
			?>
            </div>
            <div class="main__bestsaller-bot">
                <input type="checkbox" id="main-bestsaller-checkbox" class="main__flashsale-checkbox">
                <div class="main__bestsaller-list">
                    <?php echo do_shortcode('[products limit="10" lazy_load="true" ]'); ?>
                </div>
                <label class="main__flashsale-next" for="main-bestsaller-checkbox"><i
                        class="fas fa-chevron-right"></i></label>
            </div>
        </div>
    </div>
</main><!-- #main -->
<script src="<?php bloginfo('template_directory') ?>/assets/js/slides.js"></script>
<?php
get_footer();