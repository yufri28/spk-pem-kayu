<?php

namespace Spw;

require './config.php';

class Model {
    private $db;

    public function __construct() {
        $this->db = connectDatabase();
    }

    public function getDbValue() {
        return $this->db;
    }
}