<?php 
/**
 * Plugin Name: WP Random Post
 * Author Name: Shahadat Hossain
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// file enquetion
function file_enquetion()
{
    wp_enqueue_script( 'random-ajax', plugin_dir_url( __FILE__ ) . 'ajax.js', ['jquery'], null, true );
}
add_action( 'wp_enqueue_scripts', 'file_enquetion' );

