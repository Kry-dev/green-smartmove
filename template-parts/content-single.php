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
<?php $quote = get_field('quote'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="article-title">', '</h1>' );
		} else {
			the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		}
		?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="single-thumbnail">
				<?php the_post_thumbnail('full', array('class' => 'image-responsive')); ?>
			</div>
		<?php  endif; ?>
		<?php if( !empty($quote) ) : ?>
			<div class="quote">
				<?php echo $quote; ?>
			</div>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
</article>