<?php
/**
 * Payment gateway extension points.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_register_gateway_hooks' ) ) {
	function alafi_register_gateway_hooks(): void {
		do_action( 'alafi/payments/register_gateway', 'cashfree' );
		do_action( 'alafi/payments/register_gateway', 'razorpay' );
		do_action( 'alafi/payments/register_gateway', 'stripe' );
		do_action( 'alafi/payments/register_gateway', 'upi_intent' );
	}
}
add_action( 'plugins_loaded', 'alafi_register_gateway_hooks' );
