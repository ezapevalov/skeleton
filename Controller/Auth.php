<?php

class Controller_Auth extends Controller_Parent {
    public function __construct() {
        parent::__construct();
    }

    public function action_index() {
        $this->styles[] = '/Assets/css/auth/index.css';

        $this->render('/auth/index');
    }

    public function action_login() {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $salt = app::factory()->config['auth']['salt'];
        $expire = app::factory()->config['auth']['expire'];

        $user = $this->db->getRow("SELECT id, name, login, email, password  FROM users WHERE login = ?s OR password = ?s", $login, $login);

        if ( !$user || crypt($password, $salt) != $user['password'] ) {
            Header('Location: /auth');
        }

        if ( isset($_POST['remember']) ) {
            $token = crypt($this->generateCode(12), $salt);

            $this->db->query("UPDATE users SET token = ?s WHERE id = ?i", $token, $user['id']);
            setcookie(ini_get('session.name').'t', $token, time()+$expire, '/');
        }

        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['name'] = $user['name'];
        $_SESSION['user']['login'] = $user['login'];
        $_SESSION['user']['email'] = $user['email'];

        header("Location: /admin"); exit();
    }

    public function action_logout() {
        if ( isset($_SESSION['user']) ) {
            unset($_SESSION['user']);
        }

        setcookie(ini_get('session.name'), '', time()-3600, '/');
        setcookie(ini_get('session.name').'t', '', time()-3600, '/');
        header("Location: /auth");
    }

    public function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
}