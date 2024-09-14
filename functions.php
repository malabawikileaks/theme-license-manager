<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

namespace ThemeLicenseManager;

/**
 * Helper function to retrieve the license key.
 *
 * @return string
 */
function get_license_key() {
    $license_manager = new License_Manager();
    return $license_manager->get_license_key();
}

/**
 * Helper function to update the license key.
 *
 * @param string $license_key
 */
function update_license_key( $license_key ) {
    $license_manager = new License_Manager();
    $license_manager->update_license_key( $license_key );
}

/**
 * Register activation hook to create the custom table if it does not exist.
 */
function theme_license_manager_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'theme_licenses';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        theme_name varchar(255) NOT NULL,
        license_key text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// Hook into plugin activation
register_activation_hook( __FILE__, __NAMESPACE__ . '\\theme_license_manager_activate' );
