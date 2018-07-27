<?php
/**
 * Created by PhpStorm.
 * User: Daria
 * Date: 11.03.2018
 * Time: 16:43
 */
$modal_title = get_field('modal_title', 'options');
$comm_image = get_field('commune_image', 'options');
$comm_title = get_field('commune_title', 'options');
$comm_link = get_field('commune_link', 'options');
$cit_image = get_field('citoyen_image', 'options');
$cit_title = get_field('citoyen_title', 'options');
$cit_link = get_field('citoyen_link', 'options');
?>
<div class="cta-modal-window">
	<div id="cta_overlay"></div>
	<div id="cta_modal">
		<div class="cta-close"></div>
		<?php if( !empty($modal_title) ) : ?>
			<h3 class="modal_title"><?php echo $modal_title; ?></h3>
		<?php endif; ?>
		<div class="links-wrap">
			<?php if( !empty($comm_link) ) : ?>
				<a class="links-item" href="<?php echo $comm_link; ?>">
						<span class="modal-img">
							<img src="<?php echo $comm_image; ?>" alt="<?php echo $comm_title; ?>"
						</span>
					<span class="modal-title"><?php echo $comm_title; ?></span>
				</a>
			<?php endif; ?>
			<?php if( !empty($cit_link) ) : ?>
				<a class="links-item" href="<?php echo $cit_link; ?>">
						<span class="modal-img">
							<img src="<?php echo $cit_image; ?>" alt="<?php echo $cit_title; ?>">
						</span>
					<span class="modal-title"><?php echo $cit_title; ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>