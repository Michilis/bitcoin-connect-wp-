<?php
class BC_Login {
    public function __construct() {
        add_action('wp_ajax_nopriv_bc_wallet_login', [$this, 'handle_wallet_login']);
    }

    public function handle_wallet_login() {
        $wallet_address = $_POST['wallet_address'] ?? '';

        if (empty($wallet_address)) {
            wp_send_json_error(['message' => 'No wallet address provided']);
        }

        // Attempt to find or create a user linked to this wallet address
        $user_id = $this->find_or_create_user($wallet_address);

        if (is_wp_error($user_id)) {
            wp_send_json_error(['message' => 'User creation or login failed']);
        }

        // Log the user in
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        wp_send_json_success(['message' => 'User logged in successfully']);
    }

    private function find_or_create_user($wallet_address) {
        // Logic to find or create a WordPress user based on the wallet address
    }
}
