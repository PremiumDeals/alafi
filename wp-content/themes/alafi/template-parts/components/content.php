<?php
/**
 * Generic content template.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-8 rounded-xl bg-white p-6 shadow-sm' ); ?>>
	<h1 class="mb-4 text-2xl font-semibold"><?php the_title(); ?></h1>
	<div class="prose max-w-none"><?php the_content(); ?></div>
</article>
