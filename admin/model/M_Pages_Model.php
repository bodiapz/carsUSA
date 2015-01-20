<?php

class M_Pages_Model {

    public $db;
    public $configData;

    public function __construct(){
        $this->db = M_PDO::Instance();
        $this->configData = parse_ini_file('../config.ini',true);
    }

    public function getPages()
    {
    	$query = $this->db->select("SELECT * FROM pages");
        if(!empty($query)) return $query;
        else return false;
    }

    public function getPageById($id)
    {
    	$query = $this->db->selectOne("SELECT * FROM pages WHERE id = " . $id);
        if(!empty($query)) return $query;
        else return false;
    }

    public function update($data, $id)
    {
        $this->db->update('pages', $data, $id);
    }

    public function createPage($data)
    {
        $this->db->insert('pages', $data);
    }

    public function changeStatus($table, $newStatus, $id, $column = 'status')
    {
        $this->db->update($table, array($column => $newStatus), $id);
        if($this->db->affected_rows > 0) return true;
        else return false;
    }

    public function getZonePrices()
    {
        $query = $this->db->select("SELECT * FROM prices");

        if(!empty($query)) return $query;
        else return false;
    }

    public function getZonePricesById($id = '')
    {
        $price = $this->db->selectOne("SELECT * FROM prices WHERE id = " . $id);
        return $price;
    }

    public function updatePriceZone($data, $id)
    {
        $this->db->update('prices', $data, $id);
    }
}
