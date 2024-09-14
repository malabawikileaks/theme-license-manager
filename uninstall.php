<?php
// If uninstall.php is not called by WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Remove the custom license table from the database
global $wpdb;
$table_name = $wpdb->prefix . 'theme_licenses';
$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
