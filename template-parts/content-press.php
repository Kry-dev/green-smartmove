<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */
$cta_btn = get_field('press_cta_btn', get_the_ID());
$cta_btn_link = get_field('press_cta_btn_link', get_the_ID());

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
			</header>
			<div class="post-content">
				<?php echo wp_trim_words( get_the_content(), 30, '... ' ); ?>
				
				
				<?php if( !empty($cta_btn) || !empty($cta_btn_link) ) : ?>
					<a class="post-more press"
					   href="<?php if( !empty($cta_btn_link) ) :  echo $cta_btn_link['url'];
					   else : echo get_permalink(); endif; ?>">
						<?php if( !empty($cta_btn) ) :  echo $cta_btn; else : echo __('Read more', 'foundationpress'); endif; ?></a>
				<?php else : ?>
					<a class="post-more press" href="<?php echo get_permalink(); ?>"><?php echo __('Read more', 'foundationpress'); ?></a>
				<?php endif; ?>
				
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
		</header>
		<div class="post-content">
			<?php echo wp_trim_words( get_the_content(), 30, '... '.'<a class="post-more" href="'. get_permalink() .'">'. __('Read more', 'foundationpress') .'</a>' ); ?>
		</div>
	<?php  endif; ?>
	
</article>
