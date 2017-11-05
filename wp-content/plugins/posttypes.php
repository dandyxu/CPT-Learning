<?php
/**
 * Plugin Name: Dandy's Custom Post Type and Taxonomies
 * Description: A simple plugin to add Custom Post Type and Taxonomies
 * Version: 1.0
 * Author: Dandy Xu
 * License: GPL2
 *
 */

function my_custom_posttypes() {

	// CPT for Jobs
	$labels = array(
		'name'              => 'Jobs',
		'singular_name'     => 'Jobs',
		'menu_name'         => 'Jobs',
		'name_admin_bar'    => 'Jobs',
		'add_new'           => 'Add New',
		'add_new_item'      => 'Add New Job',
		'new_item'          => 'New Job',
		'edit_item'         => 'Edit Job',
		'view_item'         => 'View Job',
		'all_items'         => 'All Jobs',
		'search_items'      => 'Search Jobs',
		'parent_item_colon' => 'Parent Jobs:',
		'not_found'         => 'No jobs found.',
		'not_found_in_trash'=> 'No jobs found in Trash.',
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'jobs' ),
		'capability_type'       => 'post',
		'has_archive'           => true,
		'hierarchical'          => false,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'			=> true,
		'rest_base' 			=> 'jobs-api'
	);
	 register_post_type( 'jobs', $args );
	 
	// CPT for Reviews
	 $labels = array(
		'name'              => 'Reviews',
		'singular_name'     => 'Review',
		'menu_name'         => 'Reviews',
		'name_admin_bar'    => 'Reviews',
		'add_new'           => 'Add New',
		'add_new_item'      => 'Add New Review',
		'new_item'          => 'New Review',
		'edit_item'         => 'Edit Review',
		'view_item'         => 'View Review',
		'all_items'         => 'All Reviews',
		'search_items'      => 'Search Reviews',
		'parent_item_colon' => 'Parent Reviews:',
		'not_found'         => 'No reviews found.',
		'not_found_in_trash'=> 'No reviews found in Trash.',
	);

	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-universal-access-alt',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'reviews' ),
		'capability_type'       => 'post',
		'has_archive'           => true,
		'hierarchical'          => false,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments' ),
		'show_in_rest'			=> true,
		'taxonomies'			=> array ( 'category', 'post_tag')
	);
 	register_post_type( 'reviews', $args );
}
add_action( 'init', 'my_custom_posttypes' );


function my_rewrite_flush() {
	// First, we "add" the custom post type via the above written function.
	// Note: "add" is written with quotes, as CPTs don't get added to the DB,
	// They are only referenced in the post_type column with a post entry,
	// when you add a post of this CPT.
	my_custom_posttypes();

	// ATTENTION: This is *only* done during plugin activation hook in this example!
	// You should *NEVER EVER* do this on every page load!!
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );
