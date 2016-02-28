<?php
require_once(INTERFACES_PATH . "ihandler.php");

class indexController implements iHandler {

    public function __construct(&$app) {
        //Nothing to do here
    }

    public function dispatchAction($action, &$app) {

        switch($action)
        {
            case 'add_comment':
                $this->actionAddComment($app);
                break;
            case 'test':
                $this->actionTest($app);
                break;
            case 'upload_image':
                $this->actionUploadImage($app);
                break;
            case 'check_email_availability':
                $this->actionCheckEmailAvailability($app);
                break;
            case 'remove_temp_preview':
                $this->actionRemoveTempPreview($app);
                break;
            default:
                $this->actionIndex($app);
                break;
        }
    }

    public function actionIndex(&$app) {
        $app->addScript("/plugins/jquery/jquery.html5uploader.js");
        $app->addScript("/assets/js/index/index.js");
        $app->addStyle("/assets/css/index/index.css");

        $comments = $app->db->getAll("SELECT * FROM comments WHERE active = 1");

        $this->render('index', $app, ['comments'=>$comments]);
    }

    public function actionAddComment(&$app) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $date = time();
        $sort = $app->db->getOne('SELECT MAX(sort) FROM comments') + 1;

        $query = "INSERT INTO comments (name, email, comment, date, sort) VALUES ('$name', '$email', \"$comment\", $date, $sort)";
        $app->db->query($query);

        $id = $app->db->getOne("SELECT id FROM comments WHERE email='$email'");

        if ( $_POST['image'] ) {
            $temp = $_POST['image'];
            $ext = substr($temp, strpos($temp, '.'));

            $from = APP_ROOT . $temp;
            $to = APP_ROOT . '/uploads/comments/' . $id . '/preview' . $ext;

            if ( !file_exists(APP_ROOT . '/uploads/comments/' . $id) ) {
                mkdir(APP_ROOT . '/uploads/comments/' . $id, 0777);
            }
            exec("mv $from $to");

            $new_image_name = 'preview' . $ext;
            $app->db->query("UPDATE comments SET image = '$new_image_name' WHERE id = $id");
        }

        echo 'done'; exit;
    }

    public function actionCheckEmailAvailability(&$app) {
        $email = $_GET['email'];
        $id = $app->db->getOne("SELECT id FROM comments WHERE email='$email'");

        if ( $id ) {
            echo 'taken';
        } else {
            echo 'available';
        }

        exit;
    }

    public function actionTest(&$app) {

    }

    public function actionUploadImage(&$app) {
        if ( is_array($_FILES) && $_FILES['img']['error'] != '4' ) {
            require_once(MODELS_PATH . "/commentModel.php");
            $commentModel = new commentModel();
            $path = APP_ROOT . '/uploads/temp/';

            preg_match('/\.(png|gif|jpe?g)$/ims', $_FILES['img']['name'], $m);

            if ( !isset($m[1]) ) {
                $result = ['done'=>'no', 'error'=>"wrong_extension"];
                echo json_encode($result);
                exit;
            }

            $ext = $m[1];
            $image_temp_name = $commentModel->generateRandomString(16);
            $src = $path . $image_temp_name . ".$ext";

            if ( !move_uploaded_file($_FILES['img']['tmp_name'], $src) ) {
                $result = ['done'=>'no', 'error'=>"save_error"];
                echo json_encode($result);
                exit;
            }

            include(APP_ROOT . '/assets/SimpleImage.php');
            $image = new SimpleImage();
            $image->load(APP_ROOT."/uploads/temp/" . $image_temp_name. ".$ext");
            $image->resize(320, 240);
            $image->save(APP_ROOT."/uploads/temp/" . $image_temp_name. ".$ext");

            $image_url = "/uploads/temp/" . $image_temp_name. ".$ext";
            $result = ['done'=>'yes', 'image_url'=>$image_url];

            if ( is_array($result) ) {
                echo json_encode($result);
            }
        }
        die;
    }

    public function actionRemoveTempPreview(&$app) {
        $url = $_GET['image_url'];
        $path = APP_ROOT . $url;

        unlink($path);
        exit;
    }

    public function render($view, &$app, $vars) {
        include(VIEWS_PATH . "layout.php");
    }
}