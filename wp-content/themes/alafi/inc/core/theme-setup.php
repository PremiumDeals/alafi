<?php
/**
 * Theme setup.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_theme_setup' ) ) {
	function alafi_theme_setup(): void {
		do_action( 'alafi/before_theme_setup' );

		load_theme_textdomain( 'alafi', ALAFI_PATH . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'alafi' ),
				'footer'  => __( 'Footer Menu', 'alafi' ),
				'mobile'  => __( 'Mobile Bottom Navigation', 'alafi' ),
			)
		);

		do_action( 'alafi/after_theme_setup' );
	}
}
add_action( 'after_setup_theme', 'alafi_theme_setup' );
