<?php
/*
Template Name: Contact
*/
get_header(); ?>
	
	
	<script>
		
	</script>

<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'template-parts/content', 'contact' ); ?>
<?php endwhile; ?>

<?php get_footer();
