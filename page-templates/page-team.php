<?php
/*
Template Name: Team Page
*/
get_header(); ?>

<div class="main-container">
	<div class="main-grid">
		<main >
			<?php
			while ( have_posts() ) :
				the_post();
?>
				<?php get_template_part( 'template-parts/content', 'team' ); ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php
get_footer();
