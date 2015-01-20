<?php

class M_Category_Model {

    public $db;
    public $user_id;

    public function __construct(){
        $this->db = M_PDO::Instance();
    }

    public function get_categories()
    {
        $categories = $this->db->select("SELECT * FROM categories");
        if(!empty($categories)) return $categories;
        else return false;
    }

    public function get_category_by_id($permalink)
    {
        $query = $this->db->selectOne("SELECT * FROM `categories` WHERE `permalink` = '" . $permalink . "'");
        if(!empty($query)) return $query;
        else return false;
    }

}