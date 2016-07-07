<?php

class Controller_Parent {
    public $db;
    public $view_vars;
    public $styles;
    public $scripts;

    public function __construct() {
        $db_config = [
            'db' => app::factory()->config['database']['name'],
            'user' => app::factory()->config['database']['user'],
            'pass' => app::factory()->config['database']['pass'],
        ];

        $this->db = new SafeMySQL($db_config);

        $this->styles = [
            '/vendor/components/jqueryui/themes/redmond/jquery-ui.min.css',
            '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css',
            '/vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css',
            '/Assets/css/common.css',
        ];
        $this->scripts = [
            '/vendor/components/jquery/jquery.min.js',
            '/vendor/components/jqueryui/jquery-ui.min.js',
            '/vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
        ];
    }

    public function render($view_name, &$view_vars=[], $layout='layout') {
        foreach ( $view_vars as $var_name => $var_value ) {
            $$var_name = $var_value;
        }

        $view = APP_ROOT . '/View/' . $view_name . '.php';

        include APP_ROOT . '/View/' . $layout . '.php';
    }
}