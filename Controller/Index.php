<?php

class Controller_Index extends Controller_Parent {
    public function __construct() {
        parent::__construct();
    }

    public function action_index() {
        $this->render('index/index');
    }
}