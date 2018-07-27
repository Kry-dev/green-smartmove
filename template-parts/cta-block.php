<?php
/**
 * Created by PhpStorm.
 * User: Daria
 * Date: 11.03.2018
 * Time: 16:43
 */
// start CTA -->
	$cta_bg = get_field('cta_background', 'options');
	$cta_btn_name = get_field('cta_button_name', 'options');
	$cta_txt = get_field('cta_description', 'options');
	?>
<?php if( !empty($cta_btn_name) ) : ?>
	<div class="cta-wrap" style="background-image: url('<?php if( !empty( $cta_bg) ) : echo$cta_bg; endif; ?>')">
		<div class="intro">
			<a class="btn-cta" href="#cta_modal"><?php echo $cta_btn_name; ?></a>
			<?php if( !empty($cta_txt) ) : ?>
				<p><?php echo $cta_txt; ?></p>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
 <!-- end CTA -->