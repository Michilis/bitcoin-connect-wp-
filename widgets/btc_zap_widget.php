<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class BTC_Zap_Widget extends Widget_Base {

    public function get_name() {
        return 'btc_zap';
    }

    public function get_title() {
        return __('Zap to Post', 'bitcoin-connect-wp');
    }

    public function get_icon() {
        return 'eicon-send';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'zap_section',
            [
                'label' => __('Settings', 'bitcoin-connect-wp'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'bitcoin-connect-wp'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Send Sats', 'bitcoin-connect-wp'),
                'placeholder' => __('Enter button text here', 'bitcoin-connect-wp'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<button onclick="btcZap();">' . esc_html($settings['button_text']) . '</button>';
    }

    public function _content_template() {
        ?>
        <button onclick="btcZap();">{{{ settings.button_text }}}</button>
        <?php
    }

    public function btcZap() {
        // Add JavaScript for Zap functionality
        ?>
        <script>
        function btcZap() {
            // Example of sending sats to a post
            console.log('Sending sats...');
        }
        </script>
        <?php
    }
}
