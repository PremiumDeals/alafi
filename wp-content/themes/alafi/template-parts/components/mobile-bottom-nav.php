<?php
/**
 * Mobile bottom nav.
 */
$cart_url    = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart' );
$account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account' );
?>
<nav class="fixed bottom-0 left-0 right-0 border-t bg-white p-2 md:hidden" aria-label="Mobile Bottom Navigation">
	<ul class="grid grid-cols-4 text-center text-xs">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
		<li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>">Category</a></li>
		<li><a href="<?php echo esc_url( $cart_url ); ?>">Cart</a></li>
		<li><a href="<?php echo esc_url( $account_url ); ?>">Account</a></li>
	</ul>
</nav>
