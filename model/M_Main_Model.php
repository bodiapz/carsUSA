<?php

class M_Main_Model {
    
    public $db;
    public $user_id;

    public function __construct(){
        $this->db = M_PDO::Instance();
    }

}