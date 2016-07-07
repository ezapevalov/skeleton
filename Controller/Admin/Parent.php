<?php

class Controller_Admin_Parent {
    public $db;

    public function __construct() {
        $db_config = [
            'db' => app::factory()->config['database']['name'],
            'user' => app::factory()->config['database']['user'],
            'pass' => app::factory()->config['database']['pass'],
        ];

        $this->db = new SafeMySQL($db_config);

        $this->checkout_auth();
    }

    public function checkout_auth() {
        if ( !isset($_SESSION['user']['id']) ) {
            $token_cookie_name = ini_get('session.name') . 't';

            if ( isset($_COOKIE[$token_cookie_name]) ) {
                $user = $this->db->getRow("SELECT id, name, login, email FROM users WHERE token = ?s", $_COOKIE[$token_cookie_name]);
                if ( $user ) {
                    $_SESSION['user']['id'] = $user['id'];
                    $_SESSION['user']['name'] = $user['name'];
                    $_SESSION['user']['email'] = $user['email'];
                    $_SESSION['user']['login'] = $user['login'];
                } else {
                    header("Location: /auth");
                }
            } else {
                header("Location: /auth");
            }
        }
    }
}