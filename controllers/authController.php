<?php
require_once(INTERFACES_PATH . "ihandler.php");

class authController implements iHandler {

    public function __construct(&$app) {
        //Nothing to do here
    }

    public function dispatchAction($action, &$app) {

        switch($action)
        {
            case 'login':
                $this->actionLogin($app);
                break;
            case 'logout':
                $this->actionLogout($app);
                break;
            default:
                $this->actionIndex($app);
                break;
        }
    }

    public function actionIndex(&$app) {
        if ( $this->logged($app) ) {
            header("Location: /admin"); exit();
        }

        $app->addScript("/assets/js/auth/index.js");
        $app->addStyle("/assets/css/auth/index.css");

        $this->render('auth', $app, []);
    }

    public function actionLogin(&$app) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = $app->db->getRow("SELECT * FROM users WHERE login = '$login'");

        if ( md5($password) == $user['password'] ) {
            $hash = md5($this->generateCode(10));
            $app->db->query("UPDATE users SET hash = '$hash' WHERE id = {$user['id']}");

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_hash'] = $hash;

            header("Location: /admin"); exit();
        }

        header('Content-Type: text/html; charset=utf-8');
        echo "Ошибка авторизации. Да, вот так вот просто, без аякса, странички для ошибки и кнопочки назад"; exit;
    }

    public function logged(&$app) {
        if ( isset($_SESSION['user_id']) && isset($_SESSION['user_hash']) ) {
            $user = $app->db->getRow("SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'");

            if ( ($user['hash'] === $_SESSION['user_hash']) || ($user['id'] === $_SESSION['user_id']) ) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function actionLogout(&$app) {
        session_destroy();
        header("Location: /auth"); exit();
    }

    public function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

    public function render($view, &$app, $vars) {
        include(VIEWS_PATH . "layout.php");
    }
}