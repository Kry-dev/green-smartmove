<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

?>

<header class="page-header nothing-found">
	<h1 class="page-title"><?php _e( 'Nothing Found', 'foundationpress' ); ?></h1>
</header>

<div class="page-content nothing-found">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p>
		<?php
			/* translators: %1$s: new post url */
			printf(
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'foundationpress' ),
				admin_url( 'post-new.php' )
			);
		?>
	</p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'foundationpress' ); ?></p>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'foundationpress' ); ?></p>

	<?php endif; ?>
</div>
