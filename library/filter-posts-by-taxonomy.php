<?php
/**
 * AJAC filter posts by taxonomy term
 */
function vb_filter_posts() {
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'bobz' ) )
		die('Permission denied');
	/**
	 * Default response
	 */
	$response = [
		'status'  => 500,
		'message' => __('Something is wrong, please try again later ...', 'gsmtheme'),
		'content' => false,
		'found'   => 0
	];
	$tax  = sanitize_text_field($_POST['params']['tax']);
	$term = sanitize_text_field($_POST['params']['term']);
	$page = intval($_POST['params']['page']);
	$qty  = intval($_POST['params']['qty']);
	/**
	 * Check if term exists
	 */
	if (!term_exists( $term, $tax) && $term != 'all-terms') :
		$response = [
			'status'  => 501,
			'message' => __('Term doesn\'t exist', 'gsmtheme'),
			'content' => 0
		];
		die(json_encode($response));
	endif;
	if ($term == 'all-terms') :
		$tax_qry[] = [
			'taxonomy' => $tax,
			'field'    => 'slug',
			'terms'    => $term,
			'operator' => 'NOT IN'
		];
	else :
		$tax_qry[] = [
			'taxonomy' => $tax,
			'field'    => 'slug',
			'terms'    => $term,
		];
	endif;
	/**
	 * Setup query
	 */
	$args = [
		'paged'          => $page,
		'post_type'      => 'partners',
		'post_status'    => 'publish',
		'posts_per_page' => $qty,
		'tax_query'      => $tax_qry
	];
	$qry = new WP_Query($args);
	ob_start();
	if ($qry->have_posts()) :
		// Start loop
		while ($qry->have_posts()) : $qry->the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'partners'); ?>
		<?php endwhile; // End loop
		/**
		 * Pagination
		 */
		vb_ajax_pager($qry,$page);
		$response = [
			'status'=> 200,
			'found' => $qry->found_posts
		];

	else :
		 get_template_part( 'template-parts/content', 'none' );
	endif;
	$response['content'] = ob_get_clean();
	die(json_encode($response));
}
add_action('wp_ajax_do_filter_posts', 'vb_filter_posts');
add_action('wp_ajax_nopriv_do_filter_posts', 'vb_filter_posts');

/**
 * Shortocde for displaying terms filter and results on page
 */
function vb_filter_posts_sc($atts) {
	$a = shortcode_atts( array(
		'tax'      => 'tax_partners', // Taxonomy
		'terms'    => false, // Get specific taxonomy terms only
		'active'   => false, // Set active term by ID
		'per_page' => 5 // How many posts per page
	), $atts );
	$result = NULL;
	$terms  = get_terms($a['tax']);
	if (count($terms)) :
		ob_start(); ?>
		<div id="container-async" data-paged="<?php echo $a['per_page']; ?>" class="sc-ajax-filter">
			
			<ul class="nav navbar-nav partner-filter">
				<li class="active">
					<a class="filter-item" href="#" data-filter="<?= $terms[0]->taxonomy; ?>" data-term="all-terms" data-page="1">
						<?php echo __('All', 'gsmtheme'); ?>
					</a>
				</li>
				<?php foreach($terms as $term) : ?>
					
					<li <?php if ($term->term_id == $a['active']) :?> class="active"<?php endif; ?>>
						<a class="filter-item" href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy; ?>" data-term="<?php echo $term->slug; ?>" data-page="1">
							<?php echo $term->name; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<!--<div class="status"></div>-->
			<div class="ajax-content">
				<?php query_posts('post_type=partners&post_status=publish&posts_per_page=5&paged='. get_query_var('paged')); ?>
				<?php if ( have_posts() ) : ?>
					<div class="partners-container">
						<?php while ( have_posts() ) : the_post(); ?><!-- BEGIN of Post -->
						<?php get_template_part( 'template-parts/content', 'partners'); ?>
						<?php endwhile; ?>
					</div>
				<?php endif; // End have_posts() check. ?>
			</div>
			
		</div>
		
		<?php $result = ob_get_clean();
	endif;
	return $result;
}
add_shortcode( 'ajax_filter_posts', 'vb_filter_posts_sc');

/**
 * Pagination
 */
function vb_ajax_pager( $query = null, $paged = 1 ) {
	if (!$query)
		return;
	$paginate = paginate_links([
		'base'      => '%_%',
		'type'      => 'array',
		'total'     => $query->max_num_pages,
		'format'    => '#page=%#%',
		'current'   => max( 1, $paged ),
		'prev_text' => '<',
		'next_text' => '>'
	]);
	if ($query->max_num_pages > 1) : ?>
		<ul class="pagination">
			<?php foreach ( $paginate as $page ) :?>
				<li><?php echo $page; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif;
}