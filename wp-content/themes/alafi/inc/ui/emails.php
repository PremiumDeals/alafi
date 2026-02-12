<?php
/**
 * Email styling hooks.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_email_header' ) ) {
	function alafi_email_header( $email_heading, $email ): void {
		do_action( 'alafi/email/header/before', $email_heading, $email );
		echo '<div style="padding:20px;background:#ffffff;font-family:Arial,sans-serif">';
		echo '<img src="' . esc_url( apply_filters( 'alafi/email/logo_url', ALAFI_URI . '/assets/img/logo.png' ) ) . '" alt="logo" style="max-height:42px" />';
		echo '<h2 style="margin-top:16px">' . esc_html( $email_heading ) . '</h2>';
		echo '</div>';
		do_action( 'alafi/email/header/after', $email_heading, $email );
	}
}
add_action( 'woocommerce_email_header', 'alafi_email_header', 5, 2 );
