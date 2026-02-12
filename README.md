# Alafi Marketplace Theme Stack

Production-grade WooCommerce architecture for multi-category marketplace UX.

## Deliverables Included
- `wp-content/themes/alafi` (parent theme)
- `wp-content/themes/alafi-child` (child theme)
- `wp-content/docs/plugin-recommendations.md`
- `wp-content/docs/developer-guide.md`

## Parent Theme Structure

```text
wp-content/themes/alafi
├── assets/
│   ├── css/
│   └── js/
├── inc/
│   ├── api/
│   ├── commerce/
│   ├── core/
│   ├── integrations/
│   ├── performance/
│   ├── security/
│   └── ui/
├── template-parts/
│   ├── components/
│   ├── footer/
│   └── header/
├── functions.php
├── header.php
├── footer.php
├── index.php
└── style.css
```

## Key Implementation Notes
- Uses WordPress enqueue APIs and nonce validation for AJAX/REST.
- Hook-driven lifecycle and filter contracts for plugin compatibility.
- API-first surface with JWT-ready validation adapter.
- WooCommerce-compatible account UI, wishlist, schema, GA4 data layer, webhooks, and pincode checker.
