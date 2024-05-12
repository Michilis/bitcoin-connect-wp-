<?php
class BC_Zap {
    public function __construct() {
        add_action('wp_ajax_bc_send_sats', [$this, 'send_sats']);
    }

    public function send_sats() {
        $post_id = $_POST['post_id'] ?? '';
        $amount = $_POST['amount'] ?? 0;

        if (empty($post_id) || $amount <= 0) {
            wp_send_json_error(['message' => 'Invalid post ID or amount']);
        }

        // Logic to send sats to the specified post ID
        wp_send_json_success(['message' => 'Sats sent successfully']);
    }
}
