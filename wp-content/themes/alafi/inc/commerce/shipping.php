<?php
/**
 * Shipping UX extensions.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_render_pincode_checker' ) ) {
	function alafi_render_pincode_checker(): void {
		do_action( 'alafi/shipping_checker/before' );
		echo '<div id="alafi-pincode-checker" class="rounded border p-4">';
		echo '<label for="alafi-pincode" class="block text-sm font-semibold">' . esc_html__( 'Check delivery availability', 'alafi' ) . '</label>';
		echo '<div class="mt-2 flex gap-2">';
		echo '<input id="alafi-pincode" class="w-full border px-3 py-2" type="text" maxlength="6" placeholder="560001" />';
		echo '<button type="button" class="alafi-pincode-btn bg-black px-4 py-2 text-white">' . esc_html__( 'Check', 'alafi' ) . '</button>';
		echo '</div><p class="mt-2 text-xs" data-pincode-result></p></div>';
		do_action( 'alafi/shipping_checker/after' );
	}
}
add_action( 'woocommerce_single_product_summary', 'alafi_render_pincode_checker', 35 );
