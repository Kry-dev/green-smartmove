<?php
/*
Template Name: In Press Page
*/
get_header(); ?>

<div class="main-grid">
	<main class="main-blog in-press">
		<?php query_posts('post_type=in_press&post_status=publish&posts_per_page=8&paged='. get_query_var('paged')); ?>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?><!-- BEGIN of Post -->
				<?php get_template_part( 'template-parts/content', 'press'); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; // End have_posts() check. ?>
	
		<?php if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination(); endif; ?>
		
		
	</main>
	
</div>

<?php get_footer();
