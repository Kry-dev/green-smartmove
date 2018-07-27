<?php
/**
 * The default template for displaying page content
 *
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	
	<!-- start Team -->
	<?php if( have_rows('team_repeater') ): ?>
	<div class="team-container">
		<?php while( have_rows('team_repeater') ): the_row();
			// Declare variables below
			$photo = get_sub_field('photo_default');
			$photo_hover = get_sub_field('photo_on_hover');
			$full_name = get_sub_field('full_name');
			$position = get_sub_field('position');
			$likes = get_sub_field('likes');
			$phone = get_sub_field('phone');
			$mail = get_sub_field('e_mail');
			$tw = get_sub_field('twitter');
			$fb = get_sub_field('facebook');
			$ln = get_sub_field('linkedin');
			$site = get_sub_field('website');
			$photo_size = 'team-photo'; ?>
			<?php if( !empty($photo) && !empty($full_name) ) : ?>
				<div class="associate-container">
					<div class="associate-wrap">
						<?php if( !empty($photo) || !empty($photo_hover) ) : ?>
							<div class="associate-photos">
								<?php if( !empty($photo) && !empty($photo_hover) ) : ?>
									<div class="photo-default" style="background-image: url('<?php echo $photo; ?>');"></div>
									<div class="photo-hover" style="background-image: url('<?php echo $photo_hover; ?>');"></div>
								<?php elseif( !empty($photo) && empty($photo_hover) ) : ?>
									<div class="photo-default no-hover" style="background-image: url('<?php echo $photo; ?>');"></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if( !empty($tw) || !empty($fb) || !empty($ln) || !empty($site) ) : ?>
							<?php if( !empty($tw) && !empty($fb) && !empty($ln) && !empty($site) ) : ?>
								<ul class="associate-socials all">
							<?php elseif( (empty($tw) && !empty($fb) && !empty($ln) && !empty($site)) || (!empty($tw) && empty($fb) && !empty($ln) && !empty($site)) || (!empty($tw) && !empty($fb) && empty($ln) && !empty($site)) || (!empty($tw) && !empty($fb) && !empty($ln) && empty($site)) ) : ?>
								<ul class="associate-socials all3">
							<?php else : ?>
								<ul class="associate-socials">
							<?php endif; ?>
								<?php if( !empty($tw) ) : ?>
									<li><a href="<?php echo $tw; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<?php endif; ?>
								<?php if( !empty($fb) ) : ?>
									<li><a href="<?php echo $fb; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<?php endif; ?>
								<?php if( !empty($ln) ) : ?>
									<li><a href="<?php echo $ln; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<?php endif; ?>
								<?php if( !empty($site) ) : ?>
									<li><a href="<?php echo $site; ?>"><i class="fa fa-globe" aria-hidden="true"></i></a></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="associate-content">
						<?php if( !empty($full_name) ) : ?>
							<h3 class="name"><?php echo $full_name; ?></h3>
						<?php endif; ?>
						<?php if( !empty($position) || !empty($likes)) : ?>
							<h4 class="position-wrap">
								<?php if( !empty($position) && !empty($likes) ) : ?>
									<span class="position"><?php echo $position; ?></span>
									<span class="likes"><?php echo $likes; ?></span>
								<?php elseif( !empty($position) && empty($likes) ) : ?>
									<span class="position no-likes"><?php echo $position; ?></span>
								<?php elseif( empty($position) && !empty($likes) ) : ?>
									<span class="likes no-position"><?php echo $position; ?></span>
								<?php endif; ?>
								
							</h4>
						<?php endif; ?>
						<?php if( !empty($phone) || !empty($mail) ) : ?>
							<ul class="associate-contacts">
								<?php if( !empty($phone) ) : ?>
									<li><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></li>
								<?php endif; ?>
								<?php if( !empty($mail) ) : ?>
									<li><a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
	<?php endif; ?><!-- end Team -->
	
</article>
