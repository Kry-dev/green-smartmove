<?php $quote = get_field('quote'); ?>
<?php $partners_cta = get_field('partners_cta_btn_link'); ?>
<?php if ( has_post_thumbnail() ) : ?>
	<article id="post-<?php the_ID(); ?>" class="article-container partners-art has-thumbnail loop-item">
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" class="article-container partners-art loop-item">
<?php  endif; ?>
		<a href="<?php if( !empty($partners_cta ) ) :  echo $partners_cta['url'];
		else : echo get_permalink(); endif; ?>" title="<?php if( !empty($partners_cta ) ) :  echo $partners_cta['title'];
		else : echo get_the_title(); endif; ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-thumbnail">
			<?php the_post_thumbnail('partners-thumb', array('class' => 'image-responsive')); ?>
		</div>
		<div class="article-content">
			<header>
				<?php
				if ( is_single() ) {
					the_title( '<h1 class="article-title">', '</h1>' );
				} else {
					the_title( '<h3 class="post-title">', '</h3>' );
				}
				?>
			</header>
			<div class="post-content">
				<?php echo wp_trim_words( get_the_content(), 80); ?>
			</div>
			 <?php if( !empty($quote) ) : ?>
				 <div class="quote">
					 <?php echo $quote; ?>
				 </div>
			 <?php endif; ?>
		</div>
	<?php else : ?>
		<header>
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="article-title">', '</h1>' );
			} else {
				the_title( '<h3 class="post-title">', '</h3>' );
			}
			?>
		</header>
		<div class="post-content">
			<?php echo wp_trim_words( get_the_content(), 80 ); ?>
		</div>
		<?php if( !empty($quote) ) : ?>
			<div class="quote">
				<?php echo $quote; ?>
			</div>
		<?php endif; ?>
	<?php  endif; ?>
		</a>
</article>
