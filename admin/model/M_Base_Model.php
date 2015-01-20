<?php

class M_Base_Model
{

    public $db;
    public $configData;

    public function __construct()
    {
        $this->db = M_PDO::Instance();
        $this->configData = parse_ini_file('../config.ini', true);
    }

    public function getUser()
    {
        $query = $this->db->select("SELECT id FROM users");
        if(!empty($query))
            return $query;
        else
            return false;
    }

}