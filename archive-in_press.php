<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

get_header(); ?>

<div class="main-container">
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
