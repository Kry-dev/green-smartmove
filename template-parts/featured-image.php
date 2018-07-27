<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
  $custom_title = get_field('custom_title_page', $post->ID);
  $custom_sub_title = get_field('custom_sub_title_page', $post->ID);
  

if ( has_post_thumbnail( $post->ID ) ) : ?>
	<header class="featured-hero" role="banner" data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, xlarge]">
		
		
		<?php if(!empty($custom_title)) : ?>
			<h1><?php echo $custom_title; ?></h1>
		<?php else : ?>
			<h1><?php echo get_the_title($post->ID); ?></h1>
		<?php endif; ?>
		<?php if(!empty($custom_sub_title)) : ?>
			<h2><?php echo $custom_sub_title; ?></h2>
		<?php endif; ?>
	</header>
<?php else : ?>
	<header class="featured-hero only-title" role="banner" data-interchange="[<?php header_image(); ?>, xlarge]">
		<?php if(!empty($custom_title)) : ?>
			<h1><?php echo $custom_title; ?></h1>
		<?php else : ?>
			<h1><?php echo get_the_title($post->ID); ?></h1>
		<?php endif; ?>
		<?php if(!empty($custom_sub_title)) : ?>
			<h2><?php echo $custom_sub_title; ?></h2>
		<?php endif; ?>
	</header>
<?php endif;
