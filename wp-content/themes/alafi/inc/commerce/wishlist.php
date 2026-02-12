<?php
/**
 * AJAX wishlist handlers.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_ajax_wishlist_toggle' ) ) {
	function alafi_ajax_wishlist_toggle(): void {
		check_ajax_referer( 'alafi_ajax_nonce', 'nonce' );

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'Login required.', 'alafi' ) ), 401 );
		}

		$product_id = absint( $_POST['product_id'] ?? 0 );
		if ( ! $product_id ) {
			wp_send_json_error( array( 'message' => __( 'Missing product ID.', 'alafi' ) ), 422 );
		}

		$user_id  = get_current_user_id();
		$wishlist = (array) get_user_meta( $user_id, '_alafi_wishlist', true );
		$exists   = in_array( $product_id, $wishlist, true );
		$wishlist = $exists ? array_values( array_diff( $wishlist, array( $product_id ) ) ) : array_merge( $wishlist, array( $product_id ) );
		update_user_meta( $user_id, '_alafi_wishlist', array_unique( $wishlist ) );

		do_action( 'alafi/wishlist/updated', $user_id, $wishlist );
		wp_send_json_success( array( 'count' => count( $wishlist ), 'in_list' => ! $exists ) );
	}
}
add_action( 'wp_ajax_alafi_wishlist_toggle', 'alafi_ajax_wishlist_toggle' );
