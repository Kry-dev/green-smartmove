<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */
 $show_cta = get_field('show_cta_footer');
 
?>



<footer class="footer">
	<?php if($show_cta == 'show') : ?>
		<?php get_template_part('template-parts/cta-block') ?>
	<?php endif; ?>
    <div class="footer-container">
        <div class="footer-grid">
            <?php dynamic_sidebar( 'footer-widgets' ); ?>
        </div>
	    <div class="footer-copyright">
		    <?php dynamic_sidebar( 'footer-copyright' ); ?>
	    </div>
    </div>
</footer>

<?php get_template_part('template-parts/cta-modal') ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
<!--<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>-->
</body>
</html>