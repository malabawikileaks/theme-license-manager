<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

namespace ThemeLicenseManager;

/**
 * Class License_Manager
 * Handles the license key management for the theme.
 */
class License_Manager {

    private $table_name;
    private $theme_name;
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'theme_licenses';
        $this->theme_name = 'your_theme_name'; // You can make this dynamic if needed.
    }

    /**
     * Retrieve the stored license key.
     *
     * @return string License key
     */
    public function get_license_key() {
        $license_key = $this->wpdb->get_var(
            $this->wpdb->prepare(
                "SELECT license_key FROM $this->table_name WHERE theme_name = %s", 
                $this->theme_name
            )
        );
        return esc_attr($license_key);
    }

    /**
     * Update the license key in the database.
     *
     * @param string $license_key The new license key
     */
    public function update_license_key($license_key) {
        $this->wpdb->replace(
            $this->table_name,
            array(
                'theme_name'  => $this->theme_name,
                'license_key' => sanitize_text_field($license_key)
            ),
            array('%s', '%s')
        );
    }

    /**
     * Delete the license key.
     */
    public function delete_license_key() {
        $this->wpdb->delete(
            $this->table_name,
            array('theme_name' => $this->theme_name),
            array('%s')
        );
    }
}
