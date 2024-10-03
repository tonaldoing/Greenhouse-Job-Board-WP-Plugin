<?php

// Shortcode function
function greenhouse_job_board_shortcode() {
    return greenhouse_get_jobs_list();
}
add_shortcode( 'greenhouse_jobs', 'greenhouse_job_board_shortcode' );
