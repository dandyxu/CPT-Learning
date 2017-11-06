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

// Custom Taxonomy
function my_custom_taxonomy() {
	/* Type of Product / Service */
	$labels = array(
		'name' 			=> 'Type of Product / Services',
		'singular_name' => 'Type of Product / Service',
		'search_items'  => 'Search Types of Products/Services',
		'all_items'     => 'All Types of Products / Services',
		'parent_item'   => 'Parent Type of Product / Service',
		'parent_item_colon' => 'Parent Type of Product / Service',
		'edit_item'     => 'Edit Type of Product / Service',
		'update_item'   => 'Update Type of Product / Service',
		'add_new_item'  => 'Add New Type of Product / Service',
		'new_item_name' => 'New Type of Product / Service Name',
		'menu_name'     => 'Type of Product / Service',
	);

	$args = array (
		'labels' 		=> $labels,
		'rewrite' 		=> array ( 'slug' => 'product-type' ),
		'hierarchical' 	=> true,
		'show_ui'		=> true,
		'show_admin_column' => true,
		'query_var' 	=> true,
	);
	register_taxonomy ( 'product-type', array( 'reviews' ), $args );

	/* Mood taxonomy (non-hierarchical) */
	$labels = array( 
		'name' 			=> 'Moods',
		'singular_name' => 'Mood',
		'search_items'  => 'Search Moods',
		'popular_items' => 'Popular Moods',
		'all_items'     => 'All Moods',
		'parent_item'   => null,
		'parent_item_colon' => null,
		'edit_item'   	=> 'Edit Mood',
		'update_item'	=> 'Update Mood',
		'add_new_item'	=> 'Add New Mood',
		'new_item_name'	=> 'New Mood Name',
		'separate_items_with_commas' => 'Separate moods with commas',
		'add_or_remove_items' => 'Add or remove moods',
		'choose_from_most_used' => 'Choose from the most used moods',
		'not_found'				=> 'No moods found.',
		'menu_name'				=> 'Moods'
	);

	$args = array (
		'hierarchical' 	=> false,
		'labels' 		=> $labels,
		'rewrite' 		=> array ( 'slug' => 'moods' ),
		'show_ui'		=> true,
		'show_admin_column'	=> true,
		'update_count_callback' => '_update_post_term_count', // to see which tag is most popular
		'query_var'			=> true,

	);
	register_taxonomy ( 'mood', array( 'reviews', 'post' ), $args );
}

add_action ( 'init' , 'my_custom_taxonomy' );
