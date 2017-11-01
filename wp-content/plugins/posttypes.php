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
	$args = array(
		'public' => true,
		'label' => 'Jobs'
	);
	register_post_type( 'jobs', $args );
}
add_action ( 'init', 'my_custom_posttypes');
