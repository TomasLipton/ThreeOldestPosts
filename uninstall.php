<?php
/**
 * Perform plugin installation routines.
 */


// Make sure the uninstall file can't be accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Remove options introduced by the plugin.
delete_option( 'three_oldest_posts_enabled' );
