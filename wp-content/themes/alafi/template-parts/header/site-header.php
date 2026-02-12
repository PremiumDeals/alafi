<?php
/**
 * Site header template part.
 */
?>
<header class="sticky top-0 z-50 border-b bg-white/95 backdrop-blur">
	<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
		<a class="text-xl font-bold" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php do_action( 'alafi/header/nav_before' ); ?>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'hidden gap-5 md:flex' ) ); ?>
		<?php do_action( 'alafi/header/nav_after' ); ?>
	</div>
</header>
