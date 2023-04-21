<?php

class ThreeOldestPosts
{
    /**
     * Registration of AJAX endpoints for both authorized and anonymous users
     *
     * @return void
     */
    public function __construct()
    {
        add_action( 'wp_ajax_get_three_oldest_posts', array( $this, 'my_action_callback' ) );
        add_action( 'wp_ajax_nopriv_get_three_oldest_posts', array( $this, 'my_action_callback' ) );
    }

    /**
     *  Returns json for the endpoints registered in construct with html content of 3 oldest posts.
     *
     * @return void
     */
    public function my_action_callback()
    {
        $postsPerPage = absint(apply_filters( 'three_oldest_posts_posts_per_page', 3));
        // Let's get back to the default value if the number is not natural
        $postsPerPageValidated = $postsPerPage === 0 ? 3 : $postsPerPage;

        $args = array(
            'post_type'      => 'post',
            'orderby'        => 'post_date',
            'order'          => 'ASC',
            'posts_per_page' => $postsPerPageValidated
        );

        $query = new WP_Query( $args );
        $content = array();

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $content[] = get_the_content();
            }

            wp_reset_postdata();
        }

        wp_send_json( $content );
    }
}
