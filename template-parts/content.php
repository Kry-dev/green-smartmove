<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

?>
<?php if ( has_post_thumbnail() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('article-container has-thumbnail'); ?>>
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('article-container'); ?>>
<?php  endif; ?>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-thumbnail">
			<?php the_post_thumbnail('blog-thumb', array('class' => 'image-responsive')); ?>
		</div>
		<div class="article-content">
			<header>
				<?php
				if ( is_single() ) {
					the_title( '<h1 class="article-title">', '</h1>' );
				} else {
					the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				}
				?>
				<?php foundationpress_entry_meta(); ?>
			</header>
			<div class="post-content">
				<?php echo wp_trim_words( get_the_content(), 80, '<a class="post-more" href="'. get_permalink() .'">'. __('Read More', 'foundationpress') .'</a>' ); ?>
			</div>
		</div>
	<?php else : ?>
		<header>
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="article-title">', '</h1>' );
			} else {
				the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			}
			?>
			<?php foundationpress_entry_meta(); ?>
		</header>
		<div class="post-content">
			<?php echo wp_trim_words( get_the_content(), 80, '<a class="post-more" href="'. get_permalink() .'">'. __('Read More', 'foundationpress') .'</a>' ); ?>
		</div>
	<?php  endif; ?>
	
</article>
