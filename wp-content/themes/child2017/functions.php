<?php

// Mix display all posts and reviews
function my_add_reviews( $query ) {    
    if( !is_admin() && $query->is_main_query() ) {
        if( $query->is_home() ) {
            $query->set( 'post_type', array( 'post', 'reviews') );
        }
    }
}

add_action( 'pre_get_posts', 'my_add_reviews' );