<?php
/**
 * Display 3 random Jobs
 */
$args = array(
    'post_type'         => 'jobs',
    'posts_per_page'    => 3,
    'orderby'           => 'rand'
);

 $jobs = new WP_Query( $args );

 echo '<aside id="jobs" class="clear">';
 while( $jobs->have_posts() ) : $jobs->the_post();
    echo '<div class="jobs">';
    echo '<figure class="jobs-thumb">';
    the_post_thumbnail( 'medium' );
    echo '</figure>';
    echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
    echo '<div class="entry-content">';
    the_content();
    echo '</div>';
    echo '</div>';
endwhile;
echo '</aside>';

 wp_reset_query();