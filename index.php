<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APP_ROOT', __DIR__);
define('CONTROLLERS_PATH', APP_ROOT . '/controllers/');
define('MODELS_PATH', APP_ROOT . '/models/');
define('VIEWS_PATH', APP_ROOT . '/views/');
define('PLUGINS_PATH', APP_ROOT . '/plugins/');
define('INTERFACES_PATH', APP_ROOT . '/interfaces/');

class webApplication {
    protected $dataBuf;
    protected static $_classInstance;
    protected $current_url;
    protected $defaultController;
    protected $controller;
    protected $action;
    protected $id;
    protected $scripts; // js-files
    protected $styles; // css-files
    public $db;

    private function __construct() {
        session_start();

        $this->dataBuf = "";
        $this->defaultController = "base";

        $parsed_url = parse_url($_SERVER['REQUEST_URI']);
        $this->current_url = explode("/", $parsed_url['path']);

//        print_r($this->current_url);exit;

        $this->controller = ( isset($this->current_url[1]) && $this->current_url[1]) ? $this->current_url[1] : 'index';
        $this->action = ( isset($this->current_url[2]) && $this->current_url[2] ) ? $this->current_url[2] : 'index';
        $this->id = ( isset($this->current_url[3]) && $this->current_url[3] ) ? $this->current_url[3] : '';

        $this->scripts = array();
        $this->styles = array();

        require_once(APP_ROOT . "/assets/safemysql.class.php");
        $this->db = new SafeMySQL(['user'=>'root', 'pass'=>'12345', 'db'=>'skeleton']);
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getId() {
        return $this->id;
    }

    public function getStyles() {
        return $this->styles;
    }

    public function getScripts() {
        return $this->scripts;
    }

    public function addStyle($style) {
         array_push($this->styles, $style);
    }

    public function addScript($script) {
        array_push($this->scripts, $script);
    }

    public static function getApp() {
        if ( null === self::$_classInstance ) {
            self::$_classInstance = new self();
        }

        return self::$_classInstance;
    }

    public function handle($controller=NULL, $action=NULL) {
        if ( $controller == NULL ) {
            $controller = $this->defaultController;
        }

        $controller .= 'Controller';

        $val = CONTROLLERS_PATH . $controller . '.php';
        $res = require_once($val);

        if ( $res != 1 ) {
            echo("requested controller not found!");
            return 0;
        }

        $controlClass = new $controller($this);
        if ( $controlClass == NULL ) {
            echo("Controller initialization error!");
            return 0;
        }

        ob_start();
        $controlClass->dispatchAction($action, $this);
        $this->dataBuf = ob_get_contents();
        ob_end_clean();

        echo $this->dataBuf;
        return 1;
    }
}

$app = webApplication::getApp();
$app->handle();
