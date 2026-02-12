<?php
/**
 * Security hardening.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_disable_xmlrpc' ) ) {
	function alafi_disable_xmlrpc( bool $enabled ): bool {
		return false;
	}
}
add_filter( 'xmlrpc_enabled', 'alafi_disable_xmlrpc' );

if ( ! function_exists( 'alafi_login_rate_limit' ) ) {
	function alafi_login_rate_limit( $user, string $username ) {
		$key      = 'alafi_login_' . md5( strtolower( $username ) );
		$attempts = (int) get_transient( $key );

		if ( $attempts >= 5 ) {
			return new WP_Error( 'alafi_rate_limited', __( 'Too many login attempts. Please wait 15 minutes.', 'alafi' ) );
		}

		if ( is_wp_error( $user ) ) {
			set_transient( $key, $attempts + 1, 15 * MINUTE_IN_SECONDS );
		}

		return $user;
	}
}
add_filter( 'authenticate', 'alafi_login_rate_limit', 30, 2 );
