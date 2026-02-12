<?php
/**
 * Core theme hooks.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_render_header' ) ) {
	function alafi_render_header(): void {
		do_action( 'alafi/header/before' );
		get_template_part( 'template-parts/header/site', 'header' );
		do_action( 'alafi/header/after' );
	}
}

if ( ! function_exists( 'alafi_render_footer' ) ) {
	function alafi_render_footer(): void {
		do_action( 'alafi/footer/before' );
		get_template_part( 'template-parts/footer/site', 'footer' );
		do_action( 'alafi/footer/after' );
	}
}
