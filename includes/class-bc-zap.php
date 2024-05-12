<?php
class BC_Zap {
    public function __construct() {
        add_action('wp_ajax_bc_send_sats', [$this, 'send_sats_to_post']);
    }

    public function send_sats_to_post() {
        check_ajax_referer('bc_secure_nonce', 'security');

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        $amount = isset($_POST['amount']) ? intval($_POST['amount']) : 0;

        if (!$post_id || !$amount) {
            wp_send_json_error(['message' => 'Invalid post ID or amount']);
            return;
        }

        // Here you would integrate with a real payment processing system
        // Placeholder for demonstration
        update_post_meta($post_id, 'sats_received', get_post_meta($post_id, 'sats_received', true) + $amount);

        wp_send_json_success(['message' => 'Sats sent successfully']);
    }
}
