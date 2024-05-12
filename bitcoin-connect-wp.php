<?php
/*
Plugin Name: Bitcoin Connect WP
Plugin URI: https://yourwebsite.com/bitcoin-connect-wp
Description: Integrates Bitcoin Connect for user authentication and Zap functionality with Elementor widgets.
Version: 1.0
Author: Michilis
Author URI: https://yourwebsite.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: bitcoin-connect-wp
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin paths and URLs for easy access.
define( 'BC_WP_PATH', plugin_dir_path( __FILE__ ) );
define( 'BC_WP_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load the necessary files.
 */
require_once BC_WP_PATH . 'includes/class-bc-login.php';
require_once BC_WP_PATH . 'includes/class-bc-zap.php';
require_once BC_WP_PATH . 'includes/class-bc-elementor-widgets.php';

/**
 * Register activation and deactivation hooks.
 */
function bc_activate_plugin() {
    // Handle tasks to run during plugin activation, like setting up default options.
    update_option( 'bc_wp_active', true );
}
register_activation_hook( __FILE__, 'bc_activate_plugin' );

function bc_deactivate_plugin() {
    // Clean up tasks when the plugin is deactivated, if necessary.
    delete_option( 'bc_wp_active' );
}
register_deactivation_hook( __FILE__, 'bc_deactivate_plugin' );

/**
 * Initialization function to set up the plugin functionality.
 */
function bc_wp_init() {
    new BC_Login();
    new BC_Zap();
    new BC_Elementor_Widgets();
}
add_action( 'plugins_loaded', 'bc_wp_init' );

/**
 * Enqueue scripts and styles.
 */
function bc_wp_enqueue_scripts() {
    // Enqueue JavaScript and CSS files here
    wp_enqueue_style( 'bc-wp-style', BC_WP_URL . 'assets/css/btc-connect-style.css', array(), '1.0' );
    wp_enqueue_script( 'bc-wp-script', BC_WP_URL . 'assets/js/btc-connect-init.js', array(), '1.0', true );

    // Localize the script with new data
    $translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'bc_wp_nonce' )
    );
    wp_localize_script( 'bc-wp-script', 'bc_wp', $translation_array );
}
add_action( 'wp_enqueue_scripts', 'bc_wp_enqueue_scripts' );

/**
 * Optionally handle AJAX requests here if needed for login or Zap actions.
 */

/**
 * This function could handle AJAX requests for user login via Bitcoin Connect.
 */
function bc_wp_ajax_handle_login() {
    check_ajax_referer( 'bc_wp_nonce', 'security' );

    // The actual login handling logic would be here.
    // You would typically check the provided data and respond accordingly.
    wp_send_json_success(array('message' => 'Login successful'));
}
add_action( 'wp_ajax_nopriv_bc_wp_handle_login', 'bc_wp_ajax_handle_login' );

/**
 * This function could handle AJAX requests for sending sats (Zap functionality).
 */
function bc_wp_ajax_handle_zap() {
    check_ajax_referer( 'bc_wp_nonce', 'security' );

    // The actual Zap handling logic would be here.
    // You would typically check the provided data and respond accordingly.
    wp_send_json_success(array('message' => 'Zap successful'));
}
add_action( 'wp_ajax_bc_wp_handle_zap', 'bc_wp_ajax_handle_zap' );

