<?php

class Model_User extends Model_Parent {
    public function __construct() {
        parent::__construct();
    }

    public function get_list() {
        return $this->db->getAll("SELECT * FROM users");
    }
}