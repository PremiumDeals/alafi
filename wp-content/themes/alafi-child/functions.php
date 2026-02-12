<?php
/**
 * Alafi child theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_child_enqueue_assets' ) ) {
	function alafi_child_enqueue_assets(): void {
		wp_enqueue_style( 'alafi-child-style', get_stylesheet_uri(), array( 'alafi-theme' ), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'alafi_child_enqueue_assets', 20 );
