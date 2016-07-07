<?php

class Controller_Admin_Index extends Controller_Admin_Parent {
    public function __construct() {
        parent::__construct();
    }

    public function action_index() {
        print_r($_SESSION);
        unset($_SESSION['user']);
        echo 'unset done! session:';
        print_r($_SESSION);
    }
}