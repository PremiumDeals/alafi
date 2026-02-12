<?php
/**
 * Main template file.
 *
 * @package Alafi
 */

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/components/content', get_post_type() );
	}
} else {
	echo '<p>' . esc_html__( 'No content found.', 'alafi' ) . '</p>';
}

get_footer();
