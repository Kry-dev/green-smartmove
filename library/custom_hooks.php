<?php

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/* Логи ошибок в виджете админ-панели, в консоли
--------------------------------------------------------------------- */
function slt_PHPErrorsWidget() {
	$logfile = $_SERVER['DOCUMENT_ROOT'] . '/../error_log'; // Полный пусть до лог файла
	$displayErrorsLimit = 100; // Максимальное количество ошибок, показываемых в виджете
	$errorLengthLimit = 300; // Максимальное число символов для описания каждой ошибки
	$fileCleared = false;
	$userCanClearLog = current_user_can( 'manage_options' );
	
	// Очистить файл?
	if( $userCanClearLog && isset( $_GET["slt-php-errors"] ) && $_GET["slt-php-errors"]=="clear" ){
		$handle = fopen( $logfile, "w" );
		fclose( $handle );
		$fileCleared = true;
	}
	// Читаем файл
	if( file_exists( $logfile ) ){
		$errors = file( $logfile );
		$errors = array_reverse( $errors );
		if ( $fileCleared ) echo '<p><em>'. _('The file is cleared.') .'</em></p>';
		if ( $errors ) {
			echo '<p>'. _('Errors:') . count( $errors ) . '.';
			if ( $userCanClearLog )
				echo ' [ <b><a href="'. admin_url() .'?slt-php-errors=clear" onclick="return confirm(\'Вы уверенны?\');">
				'. _('Clear log file') .'
				</a></b> ]';
			echo '</p>';
			echo '<div id="slt-php-errors" style="max-height:500px; overflow:auto; padding:5px; background-color:#FAFAFA;">';
			echo '<ol style="padding:0; margin:0;">';
			$i = 0;
			foreach( $errors as $error ){
				echo '<li style="padding:2px 4px 6px; border-bottom:1px solid #ececec;">';
				$errorOutput = preg_replace( '/\[([^\]]+)\]/', '<b>[$1]</b>', $error, 1 );
				if( strlen( $errorOutput ) > $errorLengthLimit ){
					echo substr( $errorOutput, 0, $errorLengthLimit ).' [...]';
				}
				else
					echo $errorOutput;
				echo '</li>';
				$i++;
				if( $i > $displayErrorsLimit ){
					echo '<p><em>'.  _('There were more than') . $displayErrorsLimit . _('errors in the file ...').'</em></p>';
					break;
				}
			}
			echo '</ol></div>';
		}
		else
			echo '<p>'._('There are no mistakes!').'</p>';
	}
	else
		echo '<p><em>'._('An error occurred while reading the log file.').'</em></p>';
}
// Добавляем виджет
function slt_dashboardWidgets(){
	wp_add_dashboard_widget( 'slt-php-errors', 'PHP errors', 'slt_PHPErrorsWidget' );
}
add_action( 'wp_dashboard_setup', 'slt_dashboardWidgets' );

## Встраивания (oEmbed) в виджете «Текст»
global $wp_embed;
add_filter( 'widget_text', array( & $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( & $wp_embed, 'autoembed'), 8 );

## заменим слово "записи" на "посты" для типа записей 'post'
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	// заменять автоматически нельзя: Запись = Статья, а в тексте получим "Просмотреть статья"
	
	$new = array(
		'name'                  => 'Blog',
		'singular_name'         => 'Post',
		'add_new'               => 'Add post',
		'add_new_item'          => 'Add post',
		'edit_item'             => 'Edit post',
		'new_item'              => 'New post',
		'view_item'             => 'View post',
		'search_items'          => 'Search for posts',
		'not_found'             => 'No posts found.',
		'not_found_in_trash'    => 'No posts found in the cart.',
		'parent_item_colon'     => '',
		'all_items'             => 'All posts',
		'archives'              => 'Archives of Posts',
		'insert_into_item'      => 'Paste into post',
		'uploaded_to_this_item' => 'Uploaded for this post',
		'featured_image'        => 'The post miniature',
		'filter_items_list'     => 'Filter the list of posts',
		'items_list_navigation' => 'Navigating the list of posts',
		'items_list'            => 'List of posts',
		'menu_name'             => 'Blog',
		'name_admin_bar'        => 'Post', // the item "add"
	
	);
	
	return (object) array_merge( (array) $labels, $new );
}

## Удаление файлов license.txt и readme.html для защиты
if( is_admin() && ! defined('DOING_AJAX') ){
	$license_file = ABSPATH .'/license.txt';
	$readme_file = ABSPATH .'/readme.html';
	
	if( file_exists($license_file) && current_user_can('manage_options') ){
		$deleted = unlink($license_file) && unlink($readme_file);
		
		if( ! $deleted  )
			$GLOBALS['readmedel'] = _('Failed to delete files: license.txt and readme.html from the folder'). ABSPATH ._('Remove them manually!');
		else
			$GLOBALS['readmedel'] = _('Files: license.txt and readme.html are removed from the folder') . ABSPATH .'`.';
		
		add_action( 'admin_notices', function(){  echo '<div class="error is-dismissible"><p>'. $GLOBALS['readmedel'] .'</p></div>'; } );
	}
}


add_action('acf/init', 'my_acf_init');

function my_acf_init() {
	
	if( function_exists('acf_add_options_page') ) {
		
		// add parent
		$parent = acf_add_options_page(array(
			'page_title' 	=> __('General Content', 'gsmtheme'),
			'menu_title' 	=> __('Theme Content', 'gsmtheme'),
			//'redirect'      => true,
			'menu_slug'     => 'theme_elements',
			'position'      => 5,
		));
		// add sub page
//		acf_add_options_sub_page(array(
//			'page_title' 	=>  __('Front Page', 'gsmtheme'),
//			'menu_title' 	=> __('Front Page', 'gsmtheme'),
//			'parent_slug' 	=> $parent['menu_slug'],
//		));
		
		
	}
	
}
// для фронта
require_once ABSPATH .'wp-admin/includes/template.php';
// подключим иконки
add_action('wp_enqueue_scripts', function(){    wp_enqueue_style('dashicons');    });

// Скрываем пункты меню в админ панели
add_action( 'admin_menu', 'remove_menu_items' );
function remove_menu_items() {
	// тут мы укахываем ярлык пункты который удаляем.
    remove_menu_page( 'edit-comments.php' );                 // Комментарии
   // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
   // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
}


/**
 * Removes tags and categories from blog posts
 */
add_action( 'init', 'gsmtheme_unregister_tags' );
function gsmtheme_unregister_tags() {
	unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	unregister_taxonomy_for_object_type( 'category', 'post' );
}

function general_admin_notice(){
	global $pagenow;
	if ( $pagenow == 'nav-menus.php' ) {
		echo '<div class="notice notice-warning is-dismissible">
		<p><b>In order to open a modal window by clicking on the Custom Links button with the form\'s contact, you need to:</b></p>
		<ol>
		<li>Create Custom Links.</li>
		<li>Add a URL in the URL field -> #cta_modal</li>
		<li>Add in the CSS Classes field -> menu-contact</li>
		<li>Save</li>
		</ol>
		</div>';
	}
}
add_action('admin_notices', 'general_admin_notice');

function get_custom_the_archive_title() {
	if ( is_category() ) {
		/* translators: Category archive title. 1: Category name */
		$title = sprintf( __( '%s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		/* translators: Tag archive title. 1: Tag name */
		$title = sprintf( __( '%s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		/* translators: Author archive title. 1: Author name */
		$title = sprintf( __( '%s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. 1: Year */
		$title = sprintf( __( '%s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. 1: Month name and year */
		$title = sprintf( __( '%s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
	} elseif ( is_day() ) {
		/* translators: Daily archive title. 1: Date */
		$title = sprintf( __( '%s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title' );
		}
	} elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
		$title = sprintf( __( '%s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives' );
	}
	
	/**
	 * Filters the archive title.
	 *
	 * @since 4.1.0
	 *
	 * @param string $title Archive title to be displayed.
	 */
	return apply_filters( 'get_custom_the_archive_title', $title );
}