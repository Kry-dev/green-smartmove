<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */
global $post;
global $wp_query;
$blog_thumbnail_id = get_option('page_for_posts');
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$custom_title = get_field('custom_title_page', $post->ID);
$custom_title_blog = get_field('custom_title_page', $blog_thumbnail_id);
$custom_sub_title = get_field('custom_sub_title_page', $post->ID);
$custom_sub_title_blog = get_field('custom_sub_title_page', $blog_thumbnail_id);
$page_title = get_the_title($post->ID);

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>
	<?php
	// If a featured image is set, insert into layout and use Interchange
	// to select the optimal image size per named media query.
	
	
	 if ( has_post_thumbnail( $post->ID ) ) : ?>
		<?php if (is_front_page()): ?>
			<header class="site-header featured-hero" role="banner" data-interchange="
			[<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, xlarge],
			[<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, large],
			[<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, medium],
			[<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, small]">
		<?php elseif ( is_single() ) : ?>
			<header class="single-page">
		<?php elseif ( isset( $wp_query ) && (bool) $wp_query->is_posts_page ) : ?>
			<header class="site-header page featured-hero blog" role="banner" data-interchange="
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, xlarge],
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, large],
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, medium],
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, small]">
		<?php elseif (  is_archive() ) : ?>
			<header class="site-header page featured-hero archive" role="banner" data-interchange="
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, xlarge],
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, large],
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, medium],
			[<?php echo get_the_post_thumbnail_url( $blog_thumbnail_id, 'featured-large' ); ?>, small]">
		<?php else : ?>
			<header class="site-header page featured-hero" role="banner" data-interchange="
			[<?php the_post_thumbnail_url( 'featured-large' ); ?>, xlarge],
			[<?php the_post_thumbnail_url( 'featured-large' ); ?>, large],
			[<?php the_post_thumbnail_url( 'featured-large' ); ?>, medium],
			[<?php the_post_thumbnail_url( 'featured-large' ); ?>, small]">
		<?php endif; ?>
							
	<?php else :
		if (is_front_page()): ?>
			<header class="featured-hero site-header only-title" role="banner" data-interchange="
			[<?php header_image(); ?>, xlarge],
			[<?php header_image(); ?>, large],
			[<?php header_image(); ?>, medium],
			[<?php header_image(); ?>, small]">
		<?php elseif ( is_single() ) : ?>
			<header class="single-page">
		<?php else : ?>
			<header class="featured-hero site-header page only-title" role="banner" data-interchange="
			[<?php header_image(); ?>, xlarge],
			[<?php header_image(); ?>, large],
			[<?php header_image(); ?>, medium],
			[<?php header_image(); ?>, small]">
		<?php endif; ?>
				
	<?php endif; ?>
					
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
				<div class="site-mobile-title top-bar-title">
					<?php if ( has_custom_logo() ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"></a>
					<?php } else { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php } ?>
				</div>
				<?php if( have_rows('social_links', 'option') ): ?>
					<ul class="top-bar-social">
						<?php while( have_rows('social_links', 'option') ): the_row();
							// Declare variables below
							$icon = get_sub_field('soc_icon');
							$more_link = get_sub_field('soc_link');  ?>
							<?php if( !empty($more_link) ) : ?>
								<li><a class="more" href="<?php echo $more_link; ?>"><?php echo $icon; ?></a></li>
							<?php endif; ?>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<nav class="site-navigation top-bar" role="navigation">
			<div class="container">
				<div class="site-desktop-title top-bar-title">
					<?php if ( has_custom_logo() ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"></a>
					<?php } else { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php } ?>
				</div>
				<div class="top-bar-menu">
					<?php foundationpress_top_bar_r(); ?>
					
					<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
						<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
					<?php endif; ?>
				</div>
				
				<?php if( have_rows('social_links', 'option') ): ?>
					<ul class="top-bar-social">
						<?php while( have_rows('social_links', 'option') ): the_row();
							// Declare variables below
							$icon = get_sub_field('soc_icon');
							$more_link = get_sub_field('soc_link');  ?>
							 <?php if( !empty($more_link) ) : ?>
								<li><a class="more" href="<?php echo $more_link; ?>"><?php echo $icon; ?></a></li>
							 <?php endif; ?>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
			
		</nav>
		<div class="featured-hero-home">
			<?php if ( !is_single() ) : ?>
				<?php if( isset( $wp_query ) && (bool) $wp_query->is_posts_page ) : ?>
					<?php if(!empty($custom_title_blog)) : ?>
						<h1 class="acf-title-blog"><?php echo $custom_title_blog; ?></h1>
					<?php endif; ?>
					<?php if(!empty($custom_sub_title_blog)) : ?>
						<h2><?php echo $custom_sub_title_blog; ?></h2>
					<?php endif; ?>
				<?php elseif (  is_archive() ) : ?>
					<h1 class="page-title"><?php echo get_custom_the_archive_title( ); ?></h1>
				<?php else : ?>
					<?php if(!empty($custom_title)) : ?>
						<h1 class="acf_title"><?php echo $custom_title; ?></h1>
					<?php else : ?>
						<h1 class="page-title"><?php echo $page_title; ?></h1>
					<?php endif; ?>
					<?php if(!empty($custom_sub_title)) : ?>
						<h2><?php echo $custom_sub_title; ?></h2>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			<?php if( is_404() ) : ?>
				<h1 class="entry-title"><?php _e( 'File Not Found', 'foundationpress' ); ?></h1>
			<?php endif; ?>
			
		</div>
		
	</header>
