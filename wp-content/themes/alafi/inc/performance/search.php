<?php
/**
 * Search optimization compatibility.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_search_weighting' ) ) {
	function alafi_search_weighting( array $weights ): array {
		$weights['product_title'] = 10;
		$weights['sku']           = 8;
		$weights['taxonomy']      = 5;
		return $weights;
	}
}
add_filter( 'alafi/search/weights', 'alafi_search_weighting' );

if ( ! function_exists( 'alafi_relevanssi_compat' ) ) {
	function alafi_relevanssi_compat( $hits ) {
		return apply_filters( 'alafi/search/relevanssi_hits', $hits );
	}
}
add_filter( 'relevanssi_hits_filter', 'alafi_relevanssi_compat' );
