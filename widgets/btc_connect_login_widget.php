<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class BTC_Connect_Login_Widget extends Widget_Base {

    public function get_name() {
        return 'btc_connect_login';
    }

    public function get_title() {
        return __('Bitcoin Connect Login', 'bitcoin-connect-wp');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'bitcoin-connect-wp'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'bitcoin-connect-wp'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Connect with Bitcoin Wallet', 'bitcoin-connect-wp'),
                'placeholder' => __('Enter button text here', 'bitcoin-connect-wp'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<button onclick="btcConnectLogin();">' . esc_html($settings['button_text']) . '</button>';
    }

    public function _content_template() {
        ?>
        <button onclick="btcConnectLogin();">{{{ settings.button_text }}}</button>
        <?php
    }

    public function btcConnectLogin() {
        // Add JavaScript to handle Bitcoin wallet connection
        ?>
        <script>
        function btcConnectLogin() {
            // Example of invoking Bitcoin Connect
            console.log('Initiating Bitcoin Wallet Connection...');
        }
        </script>
        <?php
    }
}
