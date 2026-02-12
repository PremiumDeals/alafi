<?php
/**
 * Custom My Account UI.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_account_dashboard_card' ) ) {
	function alafi_account_dashboard_card(): void {
		if ( ! is_account_page() ) {
			return;
		}
		echo '<section class="alafi-account-dashboard grid gap-4 md:grid-cols-3">';
		echo '<article class="rounded-xl border p-4"><h3>' . esc_html__( 'Wallet', 'alafi' ) . '</h3><p>' . esc_html__( 'Track credits and cashback.', 'alafi' ) . '</p></article>';
		echo '<article class="rounded-xl border p-4"><h3>' . esc_html__( 'Order Timeline', 'alafi' ) . '</h3><p>' . esc_html__( 'Monitor every order milestone.', 'alafi' ) . '</p></article>';
		echo '<article class="rounded-xl border p-4"><h3>' . esc_html__( 'Saved Addresses', 'alafi' ) . '</h3><p>' . esc_html__( 'Manage frequently used delivery addresses.', 'alafi' ) . '</p></article>';
		echo '</section>';
	}
}
add_action( 'woocommerce_account_content', 'alafi_account_dashboard_card', 5 );
