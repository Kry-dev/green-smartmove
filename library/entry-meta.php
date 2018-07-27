<?php
/**
 * Entry meta information for posts
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		/* translators: %1$s: current date, %2$s: current time */
		echo '<div class="post-meta">';
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . sprintf( __( '%1$s', 'foundationpress'
			), get_the_date('d.m.Y') ) . '</time><span class="separator">|</span>';
		echo '<span class="byline author">' . __( 'by', 'foundationpress' ) .  ' ' . get_the_author() . '</span>';
		echo '</div>';
	}
endif;
