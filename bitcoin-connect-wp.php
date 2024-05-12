<?php
/*
Plugin Name: Bitcoin Connect WP
Plugin URI:  https://yourwebsite.com/bitcoin-connect-wp
Description: Integrates Bitcoin Connect for user authentication and Zap functionality with Elementor widgets.
Version:     1.0
Author:      Your Name
Author URI:  https://yourwebsite.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: bitcoin-connect-wp
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Include the dependencies
require_once plugin_dir_path( __FILE__ ) . 'includes/class-bc-login.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-bc-zap.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-bc-elementor-widgets.php';

function bc_activate_plugin() {
    // Activation code here (e.g., setting up database tables or options)
}
register_activation_hook( __FILE__, 'bc_activate_plugin' );

function bc_deactivate_plugin() {
    // Deactivation code here (e.g., removing database tables or options)
}
register_deactivation_hook( __FILE__, 'bc_deactivate_plugin' );

// Initialize the plugin functionalities
new BC_Login();
new BC_Zap();
new BC_Elementor_Widgets();
