<?php
use Elementor\Plugin;

class BC_Elementor_Widgets {
    public function __construct() {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }

    public function register_widgets() {
        require_once __DIR__ . '/../widgets/btc_connect_login_widget.php';
        require_once __DIR__ . '/../widgets/btc_zap_widget.php';

        Plugin::instance()->widgets_manager->register_widget_type(new BTC_Connect_Login_Widget());
        Plugin::instance()->widgets_manager->register_widget_type(new BTC_Zap_Widget());
    }
}
