<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Walletstore
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
			$checkout_url = WC()->cart->get_checkout_url();
			?>
			<a id="checkout-link" href="<?php echo $checkout_url;?>">Check out</a>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'walletstore' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'walletstore' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'walletstore' ), 'walletstore', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory') ?>/assets/js/lazyload.js"></script>
<script src="<?php bloginfo('template_directory') ?>/assets/js/script.js"></script>
</body>
</html>
