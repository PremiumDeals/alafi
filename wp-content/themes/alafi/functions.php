<?php
/**
 * Alafi theme bootstrap.
 *
 * @package Alafi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ALAFI_VERSION', '1.0.0' );
define( 'ALAFI_PATH', get_template_directory() );
define( 'ALAFI_URI', get_template_directory_uri() );

$alafi_includes = array(
	'/inc/core/theme-setup.php',
	'/inc/core/enqueue.php',
	'/inc/core/hooks.php',
	'/inc/api/rest.php',
	'/inc/performance/cache.php',
	'/inc/performance/search.php',
	'/inc/commerce/woocommerce.php',
	'/inc/commerce/wishlist.php',
	'/inc/commerce/shipping.php',
	'/inc/integrations/payments.php',
	'/inc/integrations/webhooks.php',
	'/inc/integrations/analytics.php',
	'/inc/security/hardening.php',
	'/inc/security/auth.php',
	'/inc/ui/account.php',
	'/inc/ui/emails.php',
	'/inc/ui/schema.php',
);

foreach ( $alafi_includes as $alafi_include ) {
	require_once ALAFI_PATH . $alafi_include;
}
