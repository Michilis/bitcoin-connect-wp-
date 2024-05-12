<?php
class BC_Elementor_Widgets {
    public function __construct() {
        // Hook into Elementor widgets registered.
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }

    public function register_widgets() {
        require_once BC_WP_PATH . 'widgets/btc_connect_login_widget.php';
        require_once BC_WP_PATH . 'widgets/btc_zap_widget.php';

        \Elementor\Plugin::instance()->widgets_manager->register(new BTC_Connect_Login_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register(new BTC_Zap_Widget());
    }
}
