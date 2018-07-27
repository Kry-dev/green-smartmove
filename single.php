<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

get_header(); ?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-article">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php foundationpress_entry_meta(); ?>
				<?php get_template_part( 'template-parts/content', 'single' ); ?>
				<?php /*the_post_navigation(); */?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php get_footer();
