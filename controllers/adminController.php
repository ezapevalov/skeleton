<?php
require_once(INTERFACES_PATH . "ihandler.php");

class adminController implements iHandler {

    public function __construct(&$app) {
        if ( isset($_SESSION['user_id']) && isset($_SESSION['user_hash']) ) {
            $user = $app->db->getRow("SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'");

            if ( ($user['hash'] !== $_SESSION['user_hash']) || ($user['id'] !== $_SESSION['user_id']) ) {
                header("Location: /auth"); exit();
            }
        } else {
            header("Location: /auth"); exit();
        }
    }

    public function dispatchAction($action, &$app) {
        switch($action)
        {
            case 'edit':
                $this->actionEdit($app);
                break;
            case 'update':
                $this->actionUpdate($app);
                break;
            case 'toggle_comment':
                $this->actionToggleComment($app);
                break;
            default:
                $this->actionIndex($app);
                break;
        }
    }

    public function actionIndex(&$app) {
        $app->addScript("/plugins/bootstrap-switch/bootstrap-switch.min.js");
        $app->addScript("/assets/js/admin/index.js");

        $app->addStyle("/plugins/bootstrap-switch/bootstrap-switch.min.css");
        $app->addStyle("/assets/css/admin/index.css");

        $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'date';
        $order_type = isset($_GET['order_type']) ? $_GET['order_type'] : 'ASC';

        $comments = $app->db->getAll("SELECT * FROM comments ORDER BY $order_by $order_type");

        $data['comments'] = $comments;
        $data['order_by'] = $order_by;
        $data['order_type'] = $order_type;

        $this->render('admin', $app, $data);
    }

    public function actionToggleComment(&$app) {
        $id = $_GET['id'];
        $status = $_GET['status'];

        $app->db->query("UPDATE comments SET active = $status WHERE id = $id");
        echo 'ok';exit;
    }

    public function actionEdit(&$app) {
        $id = $app->getId();
        $comment = $app->db->getRow("SELECT * FROM comments WHERE id = $id");

        $this->render('edit', $app, ['comment'=>$comment]);
    }

    public function actionUpdate(&$app) {
        $id = $_POST['comment_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        $query = "UPDATE comments SET id = $id, name = '$name', email = '$email', comment = '$comment', edited = 1 WHERE id = $id";
        $app->db->query($query);

        header("Location: /admin"); exit();
    }

    public function render($view, &$app, $vars) {
        include(VIEWS_PATH . "layout.php");
    }
}