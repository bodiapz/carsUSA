<?php

class M_Slider_Model {

    public $db;
    public $configData;

    public function __construct(){
        $this->db = M_PDO::Instance();
        $this->configData = parse_ini_file('config.ini',true);
    }

    public function getSlides()
    {
    	$query = $this->db->select("SELECT * FROM slides where `status` = 1");
        if(!empty($query)) return $query;
        else return false;
    }

    public function getSlideById($id)
    {
    	$query = $this->db->selectOne("SELECT * FROM slides WHERE id = " . $id);
        if(!empty($query)) return $query;
        else return false;
    }

    public function getTexts($id)
    {
    	$query = $this->db->select("SELECT * FROM slides_texts WHERE status = 1 AND slide_id = " . $id);
        if(!empty($query)) return $query;
        else return false;
    }

    public function updateSlide($data, $id)
    {
        $this->db->update('slides', $data, $id);
    }

    public function createSlide($data)
    {
        $this->db->insert('slides', $data);
        return $this->db->lastInsertId();
    }

    public function deleteSlide($id)
    {
        $this->db->query("UPDATE `slides_texts` SET `status` = 0 WHERE id = " . $id);
    }

    public function updateSlideTexts($data, $id)
    {
        $this->db->update('slides_texts', $data, $id);
    }

    public function createSlideTexts($data)
    {
        $this->db->insert('slides_texts', $data);
        return $this->db->lastInsertId();
    }

    public function deleteSlideTexts($id)
    {
        $this->db->query("UPDATE `slides_texts` SET `status` = 0 WHERE id = " . $id);
    }
}
