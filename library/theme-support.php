<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

if ( ! function_exists( 'foundationpress_theme_support' ) ) :
	function foundationpress_theme_support() {
		// Add language support
		load_theme_textdomain( 'foundationpress', get_template_directory() . '/languages' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5
		add_theme_support(
			'html5', array(
				'search-form',
			//	'comment-form',
		//		'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add menu support
		add_theme_support( 'menus' );

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		// Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
		add_theme_support( 'post-thumbnails' );
		//add_theme_support( 'custom-logo' );
		// RSS thingy
		add_theme_support( 'automatic-feed-links' );

		// Additional theme support for woocommerce 3.0.+
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add foundation.css as editor style https://codex.wordpress.org/Editor_Style
		add_editor_style( 'dist/assets/css/' . foundationpress_asset_path( 'app.css' ) );
		
		$defaults = array(
			'height'      => 70,
			'width'       => 170,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );
		
		add_theme_support( 'custom-header', apply_filters( 'gsmtheme_custom_header_args', array(
			'default-image'      => get_parent_theme_file_uri( 'dist/assets/images/header.jpg' ),
			'width'              => 2000,
			'height'             => 1200,
			'flex-height'        => true,
		) ) );
		register_default_headers( array(
			'default-image' => array(
				'url'           => '%s/dist/assets/images/header.jpg',
				'thumbnail_url' => '%s/dist/assets/images/header.jpg',
				'description'   => __( 'Default Header Image', 'gsmtheme' ),
			),
		) );
		
	}
	add_action( 'after_setup_theme', 'foundationpress_theme_support' );
endif;
