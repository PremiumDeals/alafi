# Alafi Developer Guide

## Architecture Overview
Alafi follows a hook-driven and pluggable architecture:
- `functions.php` only bootstraps modules.
- Every module function is wrapped in `if ( ! function_exists() )` for child-theme overrides.
- Business logic is distributed in `inc/` by domain (`api`, `commerce`, `security`, etc.).

## Hook Contract Highlights
- Header/Footer lifecycle: `alafi/header/*`, `alafi/footer/*`
- Product loop lifecycle: `alafi/product_loop/*`
- Wishlist lifecycle: `alafi/wishlist/updated`
- Email lifecycle: `alafi/email/header/*`
- Integration contract: `alafi/payments/register_gateway`

## REST API Endpoints
Namespace: `alafi/v1`
- `POST /wishlist`
  - Auth: WP nonce or JWT via filter `alafi/api/validate_jwt`
  - Body: `product_id`
- `GET /pincode-serviceability?pincode=XXXXXX`

## JWT Integration
Install a JWT plugin (e.g. JWT Auth). Then map validation:

```php
add_filter( 'alafi/api/validate_jwt', function( $is_valid, $token, $request ) {
    // Call your JWT provider and return true/false.
    return $is_valid;
}, 10, 3 );
```

## CSS Customization Strategy
1. Build Tailwind CSS into `assets/css/tailwind.css` using JIT.
2. Keep design tokens and overrides in `assets/css/theme.css`.
3. For safe changes, put brand-specific styles in child theme `style.css`.

## Deployment Path
1. Provision stack: Nginx + PHP 8.2 + MariaDB + Redis.
2. Install WordPress, WooCommerce, and recommended plugins.
3. Activate `alafi` parent theme, then `alafi-child`.
4. Configure page cache exclusions for cart/checkout/my-account.
5. Set webhook endpoint through filter `alafi/webhooks/endpoint`.
6. Configure SMTP and transactional email provider.
7. Run load tests and monitor slow queries before production release.
