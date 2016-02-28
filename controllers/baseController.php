<?php
require_once(INTERFACES_PATH . "ihandler.php");

class baseController implements iHandler {
    public function __construct(&$app) {
        //Nothing to do here
    }

    public function dispatchAction($action, &$app) {
        $this->actionIndex($app);
    }

    public function actionIndex(&$app) {
        $app->addScript("/plugins/jquery/jquery.js");
        $app->addScript("/plugins/jquery-ui/jquery-ui.min.js");
        $app->addScript("/plugins/bootstrap/js/bootstrap.min.js");

        $app->addStyle("/plugins/jquery-ui/jquery-ui.min.css");
        $app->addStyle("/plugins/bootstrap/css/bootstrap.min.css");
        $app->addStyle("/assets/css/common.css");

        $app->handle($app->getController(), $app->getAction());
    }
}