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

// ajax call
function random_post()
{
    $args = [
        'post_type' => 'post',
        'orderby' => 'rand'
        'posts_per_page' => 1,
    ];

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();

            echo $query->the_title();
        }
    } else {
        echo esc_html__( 'No post found', 'wp-random-post' )
    }
}
add_action( 'wp_ajax_random_post', 'random_post' );
add_action( 'wp_ajax_nopriv_random_post', 'random_post' );

function add_button()
{
    ?>
    <input type="button" id="clickMe" value="Click">
    <?php 
}

add_shortcode( 'button', 'add_button' );

