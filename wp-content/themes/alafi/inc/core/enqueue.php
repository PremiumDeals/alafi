<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_enqueue_assets' ) ) {
	function alafi_enqueue_assets(): void {
		$tailwind_url = apply_filters( 'alafi/tailwind_url', ALAFI_URI . '/assets/css/tailwind.css' );
		$theme_css    = apply_filters( 'alafi/theme_css_url', ALAFI_URI . '/assets/css/theme.css' );

		wp_enqueue_style( 'alafi-tailwind', $tailwind_url, array(), ALAFI_VERSION );
		wp_enqueue_style( 'alafi-theme', $theme_css, array( 'alafi-tailwind' ), ALAFI_VERSION );

		wp_enqueue_script( 'alpinejs', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), ALAFI_VERSION, true );
		wp_enqueue_script( 'alafi-app', ALAFI_URI . '/assets/js/app.js', array( 'jquery' ), ALAFI_VERSION, true );

		$checkout_id = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'checkout' ) : 0;

		wp_localize_script(
			'alafi-app',
			'alafiConfig',
			array(
				'nonce'      => wp_create_nonce( 'wp_rest' ),
				'ajaxNonce'  => wp_create_nonce( 'alafi_ajax_nonce' ),
				'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
				'restUrl'    => esc_url_raw( rest_url( 'alafi/v1' ) ),
				'checkoutId' => $checkout_id,
			)
		);

		do_action( 'alafi/after_assets_enqueued' );
	}
}
add_action( 'wp_enqueue_scripts', 'alafi_enqueue_assets' );
