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

    wp_localize_script( 'random-ajax', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')] );
}
add_action( 'wp_enqueue_scripts', 'file_enquetion' );

// ajax call
function random_post()
{
    $args = [
        'post_type' => 'post',
        'orderby' => 'rand',
        'posts_per_page' => 1,
    ];

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();

           

            $response = [
                'title'   => get_the_title(),
                'content' => get_the_excerpt(),
                'link'    => get_permalink(),
            ];

            wp_send_json_success( $response );
        }
    } else {
        wp_send_json_error( [
            'message' => 'No post found',
        ] );
    }
}
add_action( 'wp_ajax_random_post', 'random_post' );
add_action( 'wp_ajax_nopriv_random_post', 'random_post' );



function test()
{
    function add_button()
{
    ob_start();
    ?>
    <input type="button" id="clickMe" value="Click">
    <div id="random-post-result"></div>
    <?php 
    return ob_get_clean();
}

add_shortcode( 'button', 'add_button' );
}
add_action( 'init', 'test' );

