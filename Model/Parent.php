<?php

class Model_Parent {
    protected $db;

    public function __construct() {
        $db_config = app::factory()->config['database'];
        $this->db = new SafeMySQL($db_config);
    }
}