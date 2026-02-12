<?php
/**
 * Schema markup.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_schema_output' ) ) {
	function alafi_schema_output(): void {
		if ( ! function_exists( 'is_product' ) || ! is_product() ) {
			return;
		}

		global $product;
		if ( ! $product ) {
			return;
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'Product',
			'name'     => $product->get_name(),
			'sku'      => $product->get_sku(),
			'offers'   => array(
				'@type'         => 'Offer',
				'priceCurrency' => get_woocommerce_currency(),
				'price'         => $product->get_price(),
			),
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
	}
}
add_action( 'wp_head', 'alafi_schema_output', 35 );
