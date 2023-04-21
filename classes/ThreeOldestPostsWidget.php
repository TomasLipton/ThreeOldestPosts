<?php

class ThreeOldestPostsWidget
{
    public function __construct()
    {
        // Add the widget to the WordPress admin dashboard
        add_action( 'wp_dashboard_setup', array( $this, 'three_oldest_posts_dashboard_widget' ) );

        // Save the checkbox value when the dashboard widget form is submitted
        add_action( 'admin_post_save_three_oldest_posts_enabled', array( $this, 'save_three_oldest_posts_enabled' ) );

        // Delete the option value when the plugin is uninstalled
        register_uninstall_hook( __FILE__, array('ThreeOldestPosts', 'uninstall' ) );
    }

    public static function uninstall() {
        delete_option( 'three_oldest_posts_enabled' );
    }

    public function three_oldest_posts_dashboard_widget() {
        wp_add_dashboard_widget(
            'three_oldest_posts_widget',
            'Three Oldest Posts',
            array( $this, 'three_oldest_posts_widget_callback' )
        );
    }

    public function three_oldest_posts_widget_callback() {
        $options = get_option( 'three_oldest_posts_enabled' );
        ?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="save_three_oldest_posts_enabled">
            <input type="checkbox" id="three_oldest_posts_enabled" name="three_oldest_posts_enabled" <?php checked( $options, 1 ); ?> value="1" />
            <label for="three_oldest_posts_enabled">Enable Three Oldest Posts</label>
            <br />
            <button type="submit" class="button button-primary">Save</button>
        </form>
        <?php
    }

    public function save_three_oldest_posts_enabled() {
        if ( isset( $_POST['three_oldest_posts_enabled'] ) ) {
            update_option( 'three_oldest_posts_enabled', 1 );
        } else {
            update_option( 'three_oldest_posts_enabled', 0 );
        }
        wp_redirect( $_SERVER['HTTP_REFERER'] );
        exit;
    }
}
