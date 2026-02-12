<?php
/**
 * Cache and performance policies.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_cache_exclusions' ) ) {
	function alafi_cache_exclusions( array $pages ): array {
		$pages[] = 'cart';
		$pages[] = 'checkout';
		$pages[] = 'my-account';
		return array_unique( $pages );
	}
}
add_filter( 'alafi/performance/cache_exclusions', 'alafi_cache_exclusions' );

if ( ! function_exists( 'alafi_object_cache_hint' ) ) {
	function alafi_object_cache_hint(): void {
		if ( wp_using_ext_object_cache() ) {
			do_action( 'alafi/performance/redis_ready' );
		}
	}
}
add_action( 'init', 'alafi_object_cache_hint' );
