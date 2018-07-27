<?php

// Register Post Type
add_action( 'init', 'gsmtheme_post_type' );
function gsmtheme_post_type() {
	$labels = array(
		'name'               => _x( 'In Press', 'post type general name', 'gsmtheme' ),
		'singular_name'      => _x( 'In Press', 'post type singular name', 'gsmtheme' ),
		'menu_name'          => _x( 'In Press', 'admin menu', 'gsmtheme' ),
		'name_admin_bar'     => _x( 'In Press', 'add new on admin bar', 'gsmtheme' ),
		'add_new'            => _x( 'Add New', 'press', 'gsmtheme' ),
		'add_new_item'       => __( 'Add New Article', 'gsmtheme' ),
		'new_item'           => __( 'New Article', 'gsmtheme' ),
		'edit_item'          => __( 'Edit Article', 'gsmtheme' ),
		'view_item'          => __( 'View Article', 'gsmtheme' ),
		'all_items'          => __( 'All Articles', 'gsmtheme' ),
		'search_items'       => __( 'Search Articles', 'gsmtheme' ),
		'parent_item_colon'  => __( 'Parent Articles:', 'gsmtheme' ),
		'not_found'          => __( 'No Articles found.', 'gsmtheme' ),
		'not_found_in_trash' => __( 'No Articles found in Trash.', 'gsmtheme' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'In the Press', 'gsmtheme' ),
		'public'             => true,
		'publicly_queryable' => true,
		'menu_icon'		=> 'dashicons-media-document',
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'press' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'revisions')
	);
	register_post_type( 'in_press', $args );
	
	$labels = array(
		'name'               => _x( 'Partners and Clients', 'post type general name', 'gsmtheme' ),
		'singular_name'      => _x( 'Partners and Clients', 'post type singular name', 'gsmtheme' ),
		'menu_name'          => _x( 'Partners', 'admin menu', 'gsmtheme' ),
		'name_admin_bar'     => _x( 'Partners and Clients', 'add new on admin bar', 'gsmtheme' ),
		'add_new'            => _x( 'Add New', 'partners', 'gsmtheme' ),
		'add_new_item'       => __( 'Add New Partner', 'gsmtheme' ),
		'new_item'           => __( 'New Partner', 'gsmtheme' ),
		'edit_item'          => __( 'Edit Partner', 'gsmtheme' ),
		'view_item'          => __( 'View Partner', 'gsmtheme' ),
		'all_items'          => __( 'All Partners', 'gsmtheme' ),
		'search_items'       => __( 'Search Partners', 'gsmtheme' ),
		'parent_item_colon'  => __( 'Parent Partners:', 'gsmtheme' ),
		'not_found'          => __( 'No Partners found.', 'gsmtheme' ),
		'not_found_in_trash' => __( 'No Partners found in Trash.', 'gsmtheme' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Partners', 'gsmtheme' ),
		'public'             => true,
		'publicly_queryable' => true,
		'menu_icon'		     => 'dashicons-groups',
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'partners' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'revisions')
	);
	register_post_type( 'partners', $args );
}

// хук для регистрации
add_action('init', 'create_taxonomy');
function create_taxonomy(){
	$labels = array(
		'name' => _x( 'Category', 'taxonomy general name', 'gsmtheme' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'gsmtheme' ),
		'search_items' =>  __( 'Search Categories', 'gsmtheme' ),
		'all_items' => __( 'All Categories', 'gsmtheme' ),
		'parent_item' => __( 'Parent Category', 'gsmtheme' ),
		'parent_item_colon' => __( 'Parent Category:', 'gsmtheme' ),
		'edit_item' => __( 'Edit Category', 'gsmtheme' ),
		'update_item' => __( 'Update Category', 'gsmtheme' ),
		'add_new_item' => __( 'Add New Category', 'gsmtheme' ),
		'new_item_name' => __( 'New Category Name', 'gsmtheme' ),
		'menu_name' => __( 'Category', 'gsmtheme' ),
	);
	register_taxonomy('tax_partners', array('partners'), array(
		'label'                 => 'Category', // определяется параметром $labels->name
		'labels' => $labels,
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => false, // равен аргументу show_ui
		'hierarchical'          => true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true, // по умолчанию значение show_ui
	) );
}

