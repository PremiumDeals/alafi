<?php
/**
 * Theme header.
 *
 * @package Alafi
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-gray-50 text-gray-900' ); ?>>
<?php wp_body_open(); ?>
<?php alafi_render_header(); ?>
<main id="primary" class="site-main mx-auto max-w-7xl px-4 py-8">
