<?php
/**
 * Custom REST API endpoints.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alafi_register_rest_routes' ) ) {
	function alafi_register_rest_routes(): void {
		register_rest_route(
			'alafi/v1',
			'/wishlist',
			array(
				'methods'             => 'POST',
				'callback'            => 'alafi_rest_toggle_wishlist',
				'permission_callback' => 'alafi_rest_authenticate_request',
			)
		);

		register_rest_route(
			'alafi/v1',
			'/pincode-serviceability',
			array(
				'methods'             => 'GET',
				'callback'            => 'alafi_rest_check_pincode',
				'permission_callback' => '__return_true',
			)
		);
	}
}
add_action( 'rest_api_init', 'alafi_register_rest_routes' );

if ( ! function_exists( 'alafi_rest_authenticate_request' ) ) {
	function alafi_rest_authenticate_request( WP_REST_Request $request ): bool {
		$nonce_verified = wp_verify_nonce( $request->get_header( 'X-WP-Nonce' ), 'wp_rest' );
		if ( $nonce_verified ) {
			return true;
		}

		$jwt_token = $request->get_header( 'Authorization' );
		$jwt_token = is_string( $jwt_token ) ? trim( str_replace( 'Bearer', '', $jwt_token ) ) : '';

		/**
		 * Allow JWT plugins (e.g. JWT Auth for WP REST API) to validate token.
		 */
		return (bool) apply_filters( 'alafi/api/validate_jwt', false, $jwt_token, $request );
	}
}

if ( ! function_exists( 'alafi_rest_toggle_wishlist' ) ) {
	function alafi_rest_toggle_wishlist( WP_REST_Request $request ): WP_REST_Response {
		$user_id    = get_current_user_id();
		$product_id = absint( $request->get_param( 'product_id' ) );

		if ( ! $user_id || ! $product_id ) {
			return new WP_REST_Response( array( 'message' => __( 'Invalid wishlist payload.', 'alafi' ) ), 422 );
		}

		$wishlist = (array) get_user_meta( $user_id, '_alafi_wishlist', true );
		$exists   = in_array( $product_id, $wishlist, true );

		if ( $exists ) {
			$wishlist = array_values( array_diff( $wishlist, array( $product_id ) ) );
		} else {
			$wishlist[] = $product_id;
		}

		update_user_meta( $user_id, '_alafi_wishlist', array_unique( $wishlist ) );

		return new WP_REST_Response(
			array(
				'product_id' => $product_id,
				'in_list'    => ! $exists,
				'count'      => count( $wishlist ),
			),
			200
		);
	}
}

if ( ! function_exists( 'alafi_rest_check_pincode' ) ) {
	function alafi_rest_check_pincode( WP_REST_Request $request ): WP_REST_Response {
		$pincode = sanitize_text_field( (string) $request->get_param( 'pincode' ) );
		$allowed = (array) apply_filters( 'alafi/shipping/serviceable_pincodes', array( '560001', '110001', '400001' ) );

		return new WP_REST_Response(
			array(
				'pincode'     => $pincode,
				'serviceable' => in_array( $pincode, $allowed, true ),
			),
			200
		);
	}
}
