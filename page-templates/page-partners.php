<?php
/*
Template Name:  Page for Partners
*/
get_header(); ?>

<div class="main-grid">
	<main class="main-blog partners-blog">
		<?php echo do_shortcode('[ajax_filter_posts per_page="5"]'); ?>
	</main>
</div>

<?php get_footer();
