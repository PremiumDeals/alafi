<?php
/**
 * Authentication related extensions.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_render_recaptcha_field' ) ) {
	function alafi_render_recaptcha_field(): void {
		$site_key = apply_filters( 'alafi/security/recaptcha_site_key', '' );
		if ( empty( $site_key ) ) {
			return;
		}
		echo '<input type="hidden" name="alafi_recaptcha_token" id="alafi-recaptcha-token" data-sitekey="' . esc_attr( $site_key ) . '" />';
	}
}
add_action( 'woocommerce_login_form_end', 'alafi_render_recaptcha_field' );
add_action( 'woocommerce_register_form_end', 'alafi_render_recaptcha_field' );
