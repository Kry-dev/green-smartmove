<?php

/*Customizer Code HERE*/
add_action('customize_register', 'theme_opengraph_customizer');
function theme_opengraph_customizer($wp_customize) {
	//adding section in wordpress customizer
	$wp_customize->add_section( 'opengraph_settings_section', array(
		'title' => 'Facebook Open Graph Meta Tags'
	) );
	
	//settings
	$wp_customize->add_setting( 'opengraph_fb_id', array(
		'default' => '',
	) );
	$wp_customize->add_setting( 'opengraph_image', array(
		'default-image' => '',
	) );
	$wp_customize->add_setting( 'opengraph_tw_summary', array(
		'default' => '',
	) );
	$wp_customize->add_setting( 'opengraph_tw_user_site', array(
		'default' => '',
	) );
	$wp_customize->add_setting( 'opengraph_tw_username', array(
		'default' => '',
	) );
	
	//controls
	$wp_customize->add_control( 'opengraph_fb_id', array(
		'label'   => __( 'Your Facebook profile Id', 'understrap' ),
		'section' => 'opengraph_settings_section',
		'type'    => 'text',
	) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'opengraph_image',
			array(
				'label'       => __( 'Featured image for meta tags', 'understrap' ),
				'type' 		  => 'image',
				'section'     => 'opengraph_settings_section',
			)
		)
	);
	$wp_customize->add_control( 'opengraph_tw_summary', array(
		'label'   => __( 'Twitter Summary', 'understrap' ),
		'section' => 'opengraph_settings_section',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'opengraph_tw_user_site', array(
		'label'   => __( 'Twitter user site', 'understrap' ),
		'section' => 'opengraph_settings_section',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'opengraph_tw_username', array(
		'label'   => __( 'Twitter user name', 'understrap' ),
		'section' => 'opengraph_settings_section',
		'type'    => 'text',
	) );
	
}


function add_opengraph_doctype($output) {
	return $output . '
    xmlns="https://www.w3.org/1999/xhtml"
    xmlns:og="https://ogp.me/ns#" 
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Add Open Graph Meta Info from the actual article data, or customize as necessary
function facebook_open_graph() {
	$fb_id  = get_theme_mod( 'opengraph_fb_id' );
	$opengraph_image  = get_theme_mod( 'opengraph_image' );
	$tw_summary  = get_theme_mod( 'opengraph_tw_summary' );
	$tw_user_site  = get_theme_mod( 'opengraph_tw_user_site' );
	$tw_username  = get_theme_mod( 'opengraph_tw_username' );
	
	global $post;
	if($excerpt = $post->post_excerpt)
	{
		$excerpt = strip_tags($post->post_excerpt);
		$excerpt = str_replace("", "'", $excerpt);
	}
	else
	{
		$excerpt = get_bloginfo('description');
	}

	//You'll need to find you Facebook profile Id and add it as the admin
	echo '<meta property="fb:admins" content="'. $fb_id .'-fb-admin-id"/>';
	echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	echo '<meta property="og:description" content="' . $excerpt . '"/>';
	echo '<meta property="og:type" content="article"/>';
	echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	//Let's also add some Twitter related meta data
	echo '<meta name="twitter:card" content="'. $tw_summary .'" />';
	//This is the site Twitter @username to be used at the footer of the card
	echo '<meta name="twitter:site" content="'. $tw_user_site .'" />';
	//This the Twitter @username which is the creator / author of the article
	echo '<meta name="twitter:creator" content="'. $tw_username .'" />';
	
	// Customize the below with the name of your site
	echo '<meta property="og:site_name" content="'. get_bloginfo( 'name' ) .'"/>';
	echo '<meta property="og:image" content="' . $opengraph_image . '"/>';
	
	echo "
	";
}
add_action( 'wp_head', 'facebook_open_graph', 5 );