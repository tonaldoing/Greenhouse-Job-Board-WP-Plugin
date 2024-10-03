<?php
/*
Plugin Name: Greenhouse Job Board Integration
Description: A simple integration with the Greenhouse Job Board API.
Version: 1.2
Author: Tomás Vilas
License: GPL2
*/

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-fetch.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/wpbakery-block.php';

// Enqueue plugin styles
function greenhouse_enqueue_styles() {
    wp_enqueue_style( 'greenhouse-jobs-style', plugin_dir_url( __FILE__ ) . 'css/greenhouse-styles.css' );
}
add_action( 'wp_enqueue_scripts', 'greenhouse_enqueue_styles' );
