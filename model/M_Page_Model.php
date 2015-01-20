<?php

class M_Page_Model {
    
    public $db;
    public $user_id;

    public function __construct(){
        $this->db = M_PDO::Instance();
    }

    public function get_countries()
    {
        $query = $this->db->select("SELECT * FROM countries");
        if(!empty($query)) return $query;
        else return false;
    }

    public function get_ports($country_id = 18)
    {
        $query = $this->db->select("SELECT ports.*, shipment.container_price, shipment.single_price, days_from, days_to  FROM ports JOIN shipment ON shipment.port_id = ports.id WHERE ports.country_id = " . $country_id);
        if(!empty($query)) return $query;
        else return false;
    }

    public function get_brands($category_id = 0)
    {
        $query = $this->db->select("SELECT * FROM brands WHERE brands.category_id = " . $category_id);
        if(!empty($query)) return $query;
        else return false;
    }

    public function get_models($brand_id = 0)
    {
        $query = $this->db->select("SELECT * FROM models WHERE models.brand_id = " . $brand_id);
        if(!empty($query)) return $query;
        else return false;
    }

    public function get_prices()
    {
        $query = $this->db->select("SELECT * FROM prices");
        if(!empty($query)) return $query;
        else return false;
    }

    public function saveCar($data)
    {
        $lotId = $this->db->selectOne("SELECT id FROM cars WHERE lotId = '" . $data['lotId'] . "'");

        $data['created_at'] = $this->db->mysqlDateNow();

        if(empty($lotId) && is_numeric($data['lotId'])) {
            $this->db->insert("cars", $data);
            return $this->db->lastInsertId();
        }
        return $lotId['id'];
    }

    public function deleteCar($data)
    {
        @$this->db->selectOne("DELETE FROM cars WHERE lotId = '" . $data['lotId'] . "'");
    }

    public function getRandomCars()
    {
        $query = $this->db->select('SELECT * FROM cars WHERE ends > NOW() ORDER BY ends LIMIT 12 ');
        if(!empty($query))
            return $query;
        else
            return false;
    }

    public function getUserCars($user_id)
    {
        $query = $this->db->select("SELECT cars.* FROM user_cars JOIN cars ON user_cars.car_id = cars.id WHERE user_cars.user_id = '" . $user_id . "'");
        if(!empty($query))
            return $query;
        else
            return false;
    }

    public function getFavUserCars($user_id)
    {
        $query = $this->db->select("SELECT c.*, u.ask_price, u.id as user_cars_id FROM user_cars u JOIN cars c ON u.car_id = c.id WHERE u.user_id = '" . $user_id . "' AND u.is_fav = 1");
        if(!empty($query))
            return $query;
        else
            return false;
    }

    public function getPages()
    {
        $query = $this->db->select("SELECT * FROM pages WHERE status = 1");
        if(!empty($query))
            return $query;
        else
            return false;

    }

    public function getPage($permalink)
    {
        $query = $this->db->selectOne("SELECT * FROM pages WHERE permalink = '" . $permalink . "'");
        if(!empty($query))
            return $query;
        else
            return false;
    }

    public function saveFavCarUser($userId, $carId){
        $car = $this->db->selectOne("SELECT * FROM user_cars WHERE user_id = $userId AND car_id = $carId");
        if(empty($car))
            $this->db->insert('user_cars', array('car_id' => $carId, 'user_id' => $userId, 'is_fav' => 1));
        else
            $this->db->update('user_cars', array('is_fav' => 1), $car['id']);
    }

    public function delFavCarUser($userId, $carId){
        $car = $this->db->selectOne("SELECT * FROM user_cars WHERE user_id = $userId AND car_id = $carId");
        if(!empty($car))
            $this->db->update('user_cars', array('is_fav' => 0), $car['id']);
    }

    public function checkFavState($userId, $carId){
        $car = $this->db->selectOne("SELECT * FROM user_cars WHERE user_id = $userId AND car_id = $carId AND is_fav = 1");
        if(!empty($car)) return true; else return false;
    }

    public function setAskPrice($id)
    {
        $this->db->update('user_cars', array('ask_price' => 1), $id);
    }
}