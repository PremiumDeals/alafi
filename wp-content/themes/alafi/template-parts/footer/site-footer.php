<?php
/**
 * Site footer template part.
 */
?>
<footer class="mt-16 border-t bg-white">
	<div class="mx-auto max-w-7xl px-4 py-10">
		<?php do_action( 'alafi/footer/content_before' ); ?>
		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'mb-4 flex flex-wrap gap-4 text-sm' ) ); ?>
		<p class="text-sm text-gray-600">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
		<?php do_action( 'alafi/footer/content_after' ); ?>
	</div>
	<?php get_template_part( 'template-parts/components/mobile', 'bottom-nav' ); ?>
</footer>
