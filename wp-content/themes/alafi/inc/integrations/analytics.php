<?php
/**
 * GA4 data layer integration.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_print_data_layer' ) ) {
	function alafi_print_data_layer(): void {
		$data = apply_filters(
			'alafi/analytics/data_layer',
			array(
				'event'     => 'page_view',
				'page_type' => is_product() ? 'product' : ( is_checkout() ? 'checkout' : 'other' ),
			)
		);

		echo '<script>window.dataLayer = window.dataLayer || [];window.dataLayer.push(' . wp_json_encode( $data ) . ');</script>';
	}
}
add_action( 'wp_head', 'alafi_print_data_layer', 30 );
