<?php
/**
 * Functions for custom post types
 *
 * @link https://developer.wordpress.org/themes/basics/post-types/
 *
 * @package Allervie
 * @since 1.0.0
 */

function register_cpt_testimonials() {
	// CPT Labels
	$cpt_singular_capital   = 'Testimonial'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'Testimonials';
	$cpt_singular_lowercase = 'testimonial';
	$cpt_plural_lowercase   = 'testimonials';

	// CPT Slug & Name
	$cpt_register_key = 'testimonial';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'testimonial';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/testimonial/single-testimonial-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-groups', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}

add_action( 'init', 'register_cpt_testimonials' );
function register_cpt_news() {
	// CPT Labels
	$cpt_singular_capital   = 'News'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'News';
	$cpt_singular_lowercase = 'News';
	$cpt_plural_lowercase   = 'news';

	// CPT Slug & Name
	$cpt_register_key = 'news';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'news';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/testimonial/single-testimonial-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-welcome-write-blog', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}

add_action( 'init', 'register_cpt_news' );

/**
 * Register custom tags for Experiments cpt
 */
function news_taxonomy() {

	// CPT Slug & Name
	$tax_parent       = 'news'; // This is registering name of respective CPT.
	$tax_register_key = 'news-cat';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'news-cat'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/news/single-testimonial-category

	$labels = array(
		'name'                       => _x( 'Category', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Categories', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'news_taxonomy', 0 );

/**
 * Register custom tags for Experiments cpt
 */
function testimonials_taxonomy() {

	// CPT Slug & Name
	$tax_parent       = 'testimonial'; // This is registering name of respective CPT.
	$tax_register_key = 'testimonials';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'testimonials'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/testimonials/single-testimonial-category

	$labels = array(
		'name'                       => _x( 'Category', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Categories', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'testimonials_taxonomy', 0 );



function register_cpt_conditions() {
	// CPT Labels
	$cpt_singular_capital   = 'Condition'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'Conditions';
	$cpt_singular_lowercase = 'condition';
	$cpt_plural_lowercase   = 'conditions';

	// CPT Slug & Name
	$cpt_register_key = 'condition';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'condition';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/condition/single-condition-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-welcome-view-site', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}
add_action( 'init', 'register_cpt_conditions' );


/**
 * Register custom tags for Experiments cpt
 */
function conditions_taxonomy_category() {

	// CPT Slug & Name
	$tax_parent       = 'condition'; // This is registering name of respective CPT.
	$tax_register_key = 'conditions';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'conditions'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/conditions/single-testimonial-category

	$labels = array(
		'name'                       => _x( 'Category', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Categories', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'conditions_taxonomy_category', 0 );


function register_cpt_providers() {
	// CPT Labels
	$cpt_singular_capital   = 'Provider'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'Providers';
	$cpt_singular_lowercase = 'provider';
	$cpt_plural_lowercase   = 'providers';

	// CPT Slug & Name
	$cpt_register_key = 'provider';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'provider';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/provider/single-provider-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-networking', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}
add_action( 'init', 'register_cpt_providers' );


/**
 * Register custom tags for Experiments cpt
 */
function providers_taxonomy_category() {

	// CPT Slug & Name
	$tax_parent       = 'provider'; // This is registering name of respective CPT.
	$tax_register_key = 'providers-type';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'providers-type'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/providers-type/single-testimonial-category

	$labels = array(
		'name'                       => _x( 'Type', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Types', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'providers_taxonomy_category', 0 );

function provider_brand_taxonomy() {

	// CPT Slug & Name
	$tax_parent       = 'provider'; 
	$tax_register_key = 'providers-brand';  
	$tax_slug         = 'providers-brand'; 

	$labels = array(
		'name'                       => _x( 'Brand', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Brand', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Brands', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'provider_brand_taxonomy', 0 );

function register_cpt_services() {
	// CPT Labels
	$cpt_singular_capital   = 'Service'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'Services';
	$cpt_singular_lowercase = 'service';
	$cpt_plural_lowercase   = 'services';

	// CPT Slug & Name
	$cpt_register_key = 'service';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'service';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/service/single-service-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-image-filter', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}
add_action( 'init', 'register_cpt_services' );


function register_cpt_event() {
	// CPT Labels
	$cpt_singular_capital   = 'Event'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'Events';
	$cpt_singular_lowercase = 'event';
	$cpt_plural_lowercase   = 'events';

	// CPT Slug & Name
	$cpt_register_key = 'event';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'event';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/event/single-event-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-calendar-alt', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}
add_action( 'init', 'register_cpt_event' );


/**
 * Register custom tags for Experiments cpt
 */
function services_taxonomy_category() {

	// CPT Slug & Name
	$tax_parent       = 'service'; // This is registering name of respective CPT.
	$tax_register_key = 'services';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'services'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/services/single-testimonial-category

	$labels = array(
		'name'                       => _x( 'Category', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Categories', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'services_taxonomy_category', 0 );



function register_cpt_location() {
	// CPT Labels
	$cpt_singular_capital   = 'Location'; // Name of the post type shown in the menu
	$cpt_plural_capital     = 'Locations';
	$cpt_singular_lowercase = 'location';
	$cpt_plural_lowercase   = 'locations';

	// CPT Slug & Name
	$cpt_register_key = 'location';  // This is the registering name of the single CPT post. (Try to keep it singular).
	$cpt_slug         = 'locations';  // This is the permalink slug of single CPT post. (Try to keep it singular).
	// The slug will become - www.website.com/location/single-location-name

	$labels = array(
		'name'                  => _x( $cpt_plural_capital, 'Post type general name', 'alrv_td' ),
		'singular_name'         => _x( $cpt_singular_capital, 'Post type singular name', 'alrv_td' ),
		'menu_name'             => _x( $cpt_plural_capital, 'Admin Menu text', 'alrv_td' ),
		'name_admin_bar'        => _x( $cpt_singular_capital, 'Add New on Toolbar', 'alrv_td' ),
		'add_new'               => __( 'Add New ', 'alrv_td' ),
		'add_new_item'          => __( 'Add New ' . $cpt_singular_capital, 'alrv_td' ),
		'new_item'              => __( 'New ' . $cpt_singular_capital, 'alrv_td' ),
		'edit_item'             => __( 'Edit ' . $cpt_singular_capital, 'alrv_td' ),
		'update_item'           => __( 'Update ' . $cpt_singular_capital, 'alrv_td' ),
		'view_item'             => __( 'View  ' . $cpt_singular_capital, 'alrv_td' ),
		'view_items'            => __( 'View  ' . $cpt_plural_capital, 'alrv_td' ),
		'all_items'             => __( 'All ' . $cpt_plural_capital, 'alrv_td' ),
		'search_items'          => __( 'Search ' . $cpt_plural_capital, 'alrv_td' ),
		'parent_item_colon'     => __( 'Parent: ' . $cpt_singular_capital, 'alrv_td' ),
		'not_found'             => __( 'No ' . $cpt_plural_lowercase . ' found.', 'alrv_td' ),
		'not_found_in_trash'    => __( 'No ' . $cpt_plural_lowercase . ' found in Trash.', 'alrv_td' ),
		'featured_image'        => _x( $cpt_singular_capital . ' Featured Image', 'Overrides the “Featured Image” phrase.', 'alrv_td' ),
		'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase.', 'alrv_td' ),
		'remove_featured_image' => _x( 'Remove ' . $cpt_singular_lowercase . ' image', 'Overrides the “Remove featured image” phrase.', 'alrv_td' ),
		'use_featured_image'    => _x( 'Use as ' . $cpt_singular_lowercase . ' image', 'Overrides the “Use as featured image” phrase.', 'alrv_td' ),
		'archives'              => _x( $cpt_singular_capital . ' archives', 'The post type archive label used in nav menus.', 'alrv_td' ),
		'attributes'            => _x( $cpt_singular_capital . ' attributes', 'The post type attributes label.', 'alrv_td' ),
		'insert_into_item'      => _x( 'Insert into ' . $cpt_singular_lowercase, 'Overrides the “Insert into post” phrase.', 'alrv_td' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this ' . $cpt_singular_lowercase, 'Overrides the “Uploaded to this post” phrase.', 'alrv_td' ),
		'filter_items_list'     => _x( 'Filter ' . $cpt_plural_lowercase . ' list', 'Screen reader text for the filter links.', 'alrv_td' ),
		'items_list_navigation' => _x( $cpt_plural_capital . ' list navigation', 'Screen reader text for the pagination.', 'alrv_td' ),
		'items_list'            => _x( $cpt_plural_capital . ' list', 'Screen reader text for the items list.', 'alrv_td' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
		'capability_type'    => 'page', // Set this value for each CPT.
		'has_archive'        => false, // Set this value for each CPT.
		'hierarchical'       => true, // Set this value for each CPT.
		'menu_icon'          => 'dashicons-location', // Set this value for each CPT.
		'rewrite'            => array(
			'slug'       => $cpt_slug,
			'with_front' => true, // If required only then set this value for each CPT.
		),
	);
	register_post_type( $cpt_register_key, $args );
}
add_action( 'init', 'register_cpt_location' );


/**
 * Register custom tags for Experiments cpt
 */
function services_taxonomy_type() {

	// CPT Slug & Name
	$tax_parent       = 'location'; // This is registering name of respective CPT.
	$tax_register_key = 'location-type';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'type'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/types/single-testimonial-type

	$labels = array(
		'name'                       => _x( 'Type', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Types', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'services_taxonomy_type', 0 );



/**
 * Register custom tags for Experiments cpt
 */
function services_taxonomy_brand() {

	// CPT Slug & Name
	$tax_parent       = 'location'; // This is registering name of respective CPT.
	$tax_register_key = 'location-brand';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'brand'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/brands/single-testimonial-brand

	$labels = array(
		'name'                       => _x( 'Brand', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'Brand', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Brands', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

}

add_action( 'init', 'services_taxonomy_brand', 0 );

/**
 * Register custom tags for Experiments cpt
 */
function services_taxonomy_states() {

	// CPT Slug & Name
	$tax_parent       = 'location'; // This is registering name of respective CPT.
	$tax_register_key = 'location-state';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'state'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/states/single-testimonial-state

	$labels = array(
		'name'                       => _x( 'State', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'State', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'States', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent,'provider' ), $args );

}

add_action( 'init', 'services_taxonomy_states', 0 );
/**
 * Register custom tags for Experiments cpt
 */
function providers_taxonomy_location() {

	// CPT Slug & Name
	$tax_parent       = 'location'; // This is registering name of respective CPT.
	$tax_register_key = 'location-city';  // This is the registering name of the taxonomy (Try to keep it plural).
	$tax_slug         = 'location-city'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
	// The slug will become - www.website.com/providers-location/single-testimonial-category

	$labels = array(
		'name'                       => _x( 'City', 'Taxonomy General Name', 'alrv_td' ),
		'singular_name'              => _x( 'City', 'Taxonomy Singular Name', 'alrv_td' ),
		'menu_name'                  => __( 'Cities', 'alrv_td' ),
		'all_items'                  => __( 'All Items', 'alrv_td' ),
		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
		'update_item'                => __( 'Update Item', 'alrv_td' ),
		'view_item'                  => __( 'View Item', 'alrv_td' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
		'search_items'               => __( 'Search Items', 'alrv_td' ),
		'not_found'                  => __( 'Not Found', 'alrv_td' ),
		'no_terms'                   => __( 'No items', 'alrv_td' ),
		'items_list'                 => __( 'Items list', 'alrv_td' ),
		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => $tax_slug,
			'with_front' => false, // If required only then set this for each taxonomy.
		),
	);
	register_taxonomy( $tax_register_key, array( $tax_parent,'provider' ), $args );

}

add_action( 'init', 'providers_taxonomy_location', 0 );


/**
 * Register custom tags for Experiments cpt
 */
// function location_taxonomy_zipcode() {

// 	// CPT Slug & Name
// 	$tax_parent       = 'location'; // This is registering name of respective CPT.
// 	$tax_register_key = 'location-zipcode';  // This is the registering name of the taxonomy (Try to keep it plural).
// 	$tax_slug         = 'location-zipcode'; // This is the permalink slug of taxonomy archive (Try to keep it plural).
// 	// The slug will become - www.website.com/location-location/single-testimonial-category

// 	$labels = array(
// 		'name'                       => _x( 'Zipcode', 'Taxonomy General Name', 'alrv_td' ),
// 		'singular_name'              => _x( 'Zipcode', 'Taxonomy Singular Name', 'alrv_td' ),
// 		'menu_name'                  => __( 'Zipcodes', 'alrv_td' ),
// 		'all_items'                  => __( 'All Items', 'alrv_td' ),
// 		'parent_item'                => __( 'Parent Item', 'alrv_td' ),
// 		'parent_item_colon'          => __( 'Parent Item:', 'alrv_td' ),
// 		'new_item_name'              => __( 'New Item Name', 'alrv_td' ),
// 		'add_new_item'               => __( 'Add New Item', 'alrv_td' ),
// 		'edit_item'                  => __( 'Edit Item', 'alrv_td' ),
// 		'update_item'                => __( 'Update Item', 'alrv_td' ),
// 		'view_item'                  => __( 'View Item', 'alrv_td' ),
// 		'separate_items_with_commas' => __( 'Separate items with commas', 'alrv_td' ),
// 		'add_or_remove_items'        => __( 'Add or remove items', 'alrv_td' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used', 'alrv_td' ),
// 		'popular_items'              => __( 'Popular Items', 'alrv_td' ),
// 		'search_items'               => __( 'Search Items', 'alrv_td' ),
// 		'not_found'                  => __( 'Not Found', 'alrv_td' ),
// 		'no_terms'                   => __( 'No items', 'alrv_td' ),
// 		'items_list'                 => __( 'Items list', 'alrv_td' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'alrv_td' ),
// 	);
// 	$args   = array(
// 		'labels'            => $labels,
// 		'hierarchical'      => true,
// 		'public'            => true,
// 		'show_ui'           => true,
// 		'show_in_rest'      => true,
// 		'show_admin_column' => true,
// 		'show_in_nav_menus' => true,
// 		'query_var'         => true,
// 		'rewrite'           => array(
// 			'slug'       => $tax_slug,
// 			'with_front' => false, // If required only then set this for each taxonomy.
// 		),
// 	);
// 	register_taxonomy( $tax_register_key, array( $tax_parent ), $args );

// }

// add_action( 'init', 'location_taxonomy_zipcode', 0 );
