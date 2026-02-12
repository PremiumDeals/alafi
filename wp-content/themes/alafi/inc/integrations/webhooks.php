<?php
/**
 * Outbound webhooks for automation.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_dispatch_webhook' ) ) {
	function alafi_dispatch_webhook( string $event, array $payload ): void {
		$endpoint = apply_filters( 'alafi/webhooks/endpoint', '' );
		if ( empty( $endpoint ) ) {
			return;
		}

		wp_remote_post(
			$endpoint,
			array(
				'timeout' => 5,
				'body'    => wp_json_encode( array( 'event' => $event, 'payload' => $payload ) ),
				'headers' => array( 'Content-Type' => 'application/json' ),
			)
		);
	}
}

if ( ! function_exists( 'alafi_webhook_order_created' ) ) {
	function alafi_webhook_order_created( int $order_id ): void {
		alafi_dispatch_webhook( 'order_created', array( 'order_id' => $order_id ) );
	}
}
add_action( 'woocommerce_new_order', 'alafi_webhook_order_created' );

if ( ! function_exists( 'alafi_webhook_stock_low' ) ) {
	function alafi_webhook_stock_low( WC_Product $product ): void {
		alafi_dispatch_webhook( 'stock_low', array( 'product_id' => $product->get_id() ) );
	}
}
add_action( 'woocommerce_low_stock', 'alafi_webhook_stock_low' );

if ( ! function_exists( 'alafi_webhook_new_user' ) ) {
	function alafi_webhook_new_user( int $user_id ): void {
		alafi_dispatch_webhook( 'new_user', array( 'user_id' => $user_id ) );
	}
}
add_action( 'user_register', 'alafi_webhook_new_user' );
