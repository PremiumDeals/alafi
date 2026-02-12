<?php
/**
 * WooCommerce customizations.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_wc_setup_hooks' ) ) {
	function alafi_wc_setup_hooks(): void {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		add_action( 'woocommerce_before_shop_loop', 'alafi_wc_loop_open', 5 );
		add_action( 'woocommerce_after_shop_loop', 'alafi_wc_loop_close', 50 );
		add_filter( 'woocommerce_product_single_add_to_cart_text', 'alafi_external_button_text' );
		add_filter( 'woocommerce_checkout_fields', 'alafi_checkout_fields' );
		add_filter( 'woocommerce_my_account_my_orders_query', 'alafi_hpos_order_query' );
	}
}
add_action( 'after_setup_theme', 'alafi_wc_setup_hooks' );

if ( ! function_exists( 'alafi_wc_loop_open' ) ) {
	function alafi_wc_loop_open(): void {
		do_action( 'alafi/product_loop/before' );
		echo '<section class="alafi-product-grid" data-skeleton="products">';
	}
}

if ( ! function_exists( 'alafi_wc_loop_close' ) ) {
	function alafi_wc_loop_close(): void {
		echo '</section>';
		do_action( 'alafi/product_loop/after' );
	}
}

if ( ! function_exists( 'alafi_external_button_text' ) ) {
	function alafi_external_button_text( string $text ): string {
		global $product;
		if ( $product && $product->is_type( 'external' ) ) {
			return apply_filters( 'alafi/product/external_button_text', __( 'Buy on Partner Site', 'alafi' ) );
		}

		return $text;
	}
}

if ( ! function_exists( 'alafi_checkout_fields' ) ) {
	function alafi_checkout_fields( array $fields ): array {
		$fields['billing']['billing_address_1']['class'][] = 'alafi-address-autocomplete';
		$fields['billing']['billing_address_1']['custom_attributes']['data-google-places'] = 'ready';
		return $fields;
	}
}

if ( ! function_exists( 'alafi_hpos_order_query' ) ) {
	function alafi_hpos_order_query( array $query ): array {
		$query['paginate'] = true;
		return $query;
	}
}
