<?php
class BC_Login {
    public function __construct() {
        // Register the AJAX actions for non-logged-in users
        add_action('wp_ajax_nopriv_bc_connect_login', array($this, 'handle_wallet_login'));
    }

    public function handle_wallet_login() {
        $wallet_address = $_POST['wallet_address'] ?? '';
        if (empty($wallet_address)) {
            wp_send_json_error(['message' => 'Wallet address is required']);
            return;
        }

        // This is a placeholder for actual wallet login logic
        $user_id = $this->find_or_create_user($wallet_address);

        if (is_wp_error($user_id)) {
            wp_send_json_error(['message' => 'Login failed']);
            return;
        }

        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        wp_send_json_success(['message' => 'Login successful']);
    }

    private function find_or_create_user($wallet_address) {
        // Check if user exists
        $user = get_users(['meta_key' => 'wallet_address', 'meta_value' => $wallet_address]);
        if ($user) {
            return $user[0]->ID;
        }

        // User doesn't exist, so create one
        $user_data = [
            'user_login' => 'btc_' . wp_generate_password(12, false),
            'user_pass' => wp_generate_password(),
            'role' => 'subscriber', // or any other default role
        ];

        $user_id = wp_insert_user($user_data);

        if (!is_wp_error($user_id)) {
            update_user_meta($user_id, 'wallet_address', $wallet_address);
        }

        return $user_id;
    }
}
