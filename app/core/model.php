<?php
    class Model {
        public function __construct(){
            $this->db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->session = new Session();
        }
    }