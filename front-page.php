<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	
	<!-- start description -->
	<?php if( have_rows('header_company_description') ): ?>
		<div class="header-description">
			<?php while( have_rows('header_company_description') ): the_row();
				// Declare variables below
				$icon = get_sub_field('icon');
				$title = get_sub_field('title');
				$text = get_sub_field('text');
				$link = get_sub_field('link');  ?>
				
				<a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>">
					<img src="<?php echo $icon; ?>" alt="">
					<h3><?php echo $title; ?></h3>
					<p><?php echo $text; ?></p>
				
				</a>
			
			<?php endwhile; ?>
		</div>
	<?php endif; ?><!-- end description -->
	
	<?php get_template_part('template-parts/cta-block') ?>
	
	<!-- start showroom -->
	<?php $title_show = get_field('title_block_show');
	$txt_show = get_field('showroom_description');
	$room_show = get_field('show_room');
	$image_for_show = get_field('image_for_showroom');
	?>
	<?php if($room_show == 'show') : ?>
		<div class="showroom-wrap ">
			<div class="intro ">
				<?php if($title_show != '') : ?>
					<h2 class="block-title "><?php echo $title_show; ?></h2>
				<?php endif; ?>
				
			</div>
			<?php if( !empty($image_for_show ) ) : ?>
				<div id="showroom" class="showroom-container">
					<div class="show-tablet">
						<div class="tablet-wrap">
							<img class="showroom-image" src="<?php echo get_template_directory_uri() . '/dist/assets/images/tablet.png'; ?>" alt="tablet">
							<div class="tablet-slides show-sliders ">
								<!-- start tablet -->
								<?php if( have_rows('showroom_tablet') ):  ?>
									<div class="slides-wrap count-<?php echo $count = count(get_field('showroom_tablet')); ?>">
										<?php $i = 1; while( have_rows('showroom_tablet') ): the_row();
											$screenshot_t = get_sub_field('screenshot');
											$size = 'showroom-tablet'; ?>
											<?php if( $screenshot_t ) { ?>
												<div class="slide item-<?php echo  $i; ?>">
													<?php echo wp_get_attachment_image( $screenshot_t, $size ); ?>
												</div>
											<?php } ?>
										<?php $i++; endwhile; ?>
									</div>
								<?php endif; ?><!-- end tablet -->
							</div>
						</div><div class="phone-wrap">
							<img class="showroom-image" src="<?php echo get_template_directory_uri() . '/dist/assets/images/phone.png'; ?>" alt="phone">
							<div class="phone-slides show-sliders">
								<!-- start mobile -->
								<?php if( have_rows('showroom_mobile') ): ?>
								<div class="slides-wrap count-<?php echo $count = count(get_field('showroom_mobile')); ?>">
									<?php $i = 1; while( have_rows('showroom_mobile') ): the_row();
										$screenshot_m = get_sub_field('screenshot');
										$size = 'showroom-mobile'; ?>
										<?php if( $screenshot_m ) { ?>
											<div class="slide item-<?php echo  $i; ?>">
												<?php echo wp_get_attachment_image( $screenshot_m, $size ); ?>
											</div>
										<?php } ?>
										<?php $i++; endwhile; ?>
								</div>
								<?php endif; ?><!-- end mobile -->
							</div>
						</div>
					</div>
					<div class="show-desctop">
						<div class="desctop-wrap">
							<img class="showroom-image" src="<?php echo get_template_directory_uri() . '/dist/assets/images/Desctop.png'; ?>" alt="Desctop">
							<div class="desctop-slides show-sliders">
								<!-- start desctop -->
								<?php if( have_rows('showroom_desctop') ): ?>
								<div class="slides-wrap count-<?php echo $count = count(get_field('showroom_desctop')); ?>">
									<?php $i = 1; while( have_rows('showroom_desctop') ): the_row();
										$screenshot_d = get_sub_field('screenshot');
										$size = 'showroom-desctop'; ?>
										<?php if( $screenshot_d ) { ?>
											<div class="slide item-<?php echo  $i; ?>">
												<?php echo wp_get_attachment_image( $screenshot_d, $size ); ?>
											</div>
										<?php } ?>
										<?php $i++; endwhile; ?>
								</div>
								<?php endif; ?><!-- end desctop -->
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="showroom-description">
				<div class="intro">
					<?php if($txt_show != '') : ?>
						<p class="show-desc"><?php echo $txt_show; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<!-- end showroom -->
	
	<!-- start Testimonials -->
	<?php if( have_rows('testimonials') ): ?>
		<div class="testimonial-container">
			<?php while( have_rows('testimonials') ): the_row();
				// Declare variables below
				$photo = get_sub_field('photo_test');
				$testim_name = get_sub_field('name_test');
				$testim_rate = get_sub_field('rate_test');
				$testim_txt = get_sub_field('text_test');
				?>
				
				<div class="testimonial-item">
					<?php if( !empty($photo ) ) : ?>
						<div class="photo">
							<img src="<?php echo $photo; ?>" alt="<?php echo $testim_name; ?>">
						</div>
					<?php endif; ?>
					   <div class="testimonial-desc">
						   <?php if( !empty($testim_name ) ) : ?>
							  <h4 class="testim-name"><?php echo $testim_name; ?></h4>
						   <?php endif; ?>
						   <?php if( !empty($testim_rate ) ) : ?>
							   <div class="testim-rate">
								   <?php wp_star_rating( array( 'rating'=>$testim_rate, 'type'=>'percent', 'number'=>0) ); ?>
							   </div>
						   <?php endif; ?>
						   <?php if( !empty($testim_txt ) ) : ?>
							   <p class="testim-txt"><?php echo $testim_txt; ?></p>
						   <?php endif; ?>
					   </div>
				</div>
			
			<?php endwhile; ?>
		</div>
	<?php endif; ?><!-- end Testimonials -->
	
	<!-- start about -->
	<?php if( have_rows('description_about') ): ?>
		<div class="aboutus-container">
			<?php $title_about = get_field('title_block_about'); ?>
			<?php if($title_about != '') : ?>
				<h2 class="block-title"><?php echo $title_about; ?></h2>
			<?php endif; ?>
			<div class="about-wrap" id="counter">
				<?php while( have_rows('description_about') ): the_row();
					// Declare variables below
					$about_icon = get_sub_field('icon_about');
					$about_numb = get_sub_field('num_about');
					$about_txt = get_sub_field('title_about');
					?>
					
				     <div class="about-item">
					     <?php if( !empty($about_icon ) ) : ?>
						     <img class="about-icon" src="<?php echo $about_icon; ?>" alt="<?php echo $about_txt; ?>">
					     <?php endif; ?>
					     <?php if( !empty($about_numb ) ) : ?>
						     <p data-count="<?php echo $about_numb; ?>" class="about-number">0</p>
					     <?php endif; ?>
					     <?php if( !empty($about_txt ) ) : ?>
						     <p class="about-txt"><?php echo $about_txt; ?></p>
					     <?php endif; ?>
				     </div>
					
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?><!-- end about -->
	
	<!-- Start CTA -->
	<?php get_template_part('template-parts/cta-block') ?>
	<!-- End CTA -->
	
	<!-- start gallery -->
	<?php if( have_rows('gallery_front') ): ?>
		<div class="gallery-contauner">
			<?php $title_gall = get_field('title_block_gallery'); ?>
			<?php if($title_gall != '') : ?>
				<h2 class="block-title"><?php echo $title_gall; ?></h2>
			<?php endif; ?>
			<div class="gallery-wrap intro">
				<?php while( have_rows('gallery_front') ): the_row();
					// Declare variables below
					$gallery_image = get_sub_field('image_gallery');
					$size = 'gallery-size'; // (thumbnail, medium, large, full or custom size)
					
					if( $gallery_image ) {   ?>
						<div class="gallery-item">
							<?php echo wp_get_attachment_image( $gallery_image, $size ); ?>
						</div>
					<?php } ?>
				
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?><!-- end gallery -->
	
	
	
	<div <?php post_class('home-content'); ?> id="post-<?php the_ID(); ?>">
		<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
		<div class="intro entry-content">
			<?php the_content(); ?>
		</div>
	</div>
<?php endwhile; ?>
<?php do_action( 'foundationpress_after_content' ); ?>


<?php get_footer();
