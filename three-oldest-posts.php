<?php
/*
 * Plugins primary file
 *
 * Plugin Name: Three Oldest Posts
 * Description: Displays the content of the three oldest posts on any page with post type "page".
 * Author: Vova Yakovenko
 * Author URI: https://www.linkedin.com/in/boba-php/
 * Version: 1.0.0
*/

// Include the PHP class file
require_once plugin_dir_path( __FILE__ ) . 'classes/ThreeOldestPosts.php';
require_once plugin_dir_path( __FILE__ ) . 'classes/ThreeOldestPostsWidget.php';

// Instantiate the PHP class
$three_oldest_posts = new ThreeOldestPosts();
new ThreeOldestPostsWidget();

// Enqueue the encapsulated Javascript/jQuery method
function enqueue_three_oldest_posts_script() {
    if ( is_page() && get_option( 'three_oldest_posts_enabled' ) ) {
        wp_enqueue_script( 'three-oldest-posts', plugin_dir_url( __FILE__ ) . 'assets/custom-script.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_style( 'three-oldest-posts', plugin_dir_url( __FILE__ ) . 'assets/three-oldest-posts.css' );
        wp_localize_script( 'three-oldest-posts', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_three_oldest_posts_script' );
