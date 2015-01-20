<?php
require_once('assets/classes/phpmailer/class.phpmailer.php');
require_once('assets/classes/phpmailer/class.smtp.php');

class M_User_Model {
    public $db;
    public $configData;

    public function __construct(){
        $this->db = M_PDO::Instance();

        $this->configData   = parse_ini_file('../config.ini',true);
    }

    public function getUsers()
    {
        $query = $this->db->select("SELECT * FROM users");
        if(!empty($query)) return $query;
        else return false;
    }

    public function auth($email, $password)
    {
        $auth = $this->db->selectOne("SELECT * FROM users WHERE admin = 1 AND email = '" . $email . "'");

        if(count($auth) == 0) return false;

        if($auth['password'] == $this->hash_password($password, $auth['salt']))
            return $auth;
        else
            return false;
    }

    public function getUserProfile($user_id)
    {
        $profile = $this->db->selectOne("SELECT * FROM user_profile WHERE user_id = " . $user_id);

        return $profile;
    }

    public function clearLocation($user_id)
    {
        $this->db->delete('users_location',$user_id,'user_id');
    }

    public function getUserLocation($user_id)
    {
        $location = $this->db->selectOne("SELECT * FROM users_location WHERE user_id = " . $user_id);

        if(empty($location))
            return false;
        else
            return $location;
    }

    public function setLastLogin($user_id)
    {
        $data['last_login'] = $this->db->mysqlDateNow();
        $this->db->update('users',$data,$user_id);
    }

    public function make_password($password)
    {
        $user['salt'] = $this->make_salt();

        $user['password'] = $this->hash_password($password, $user['salt']);

        return $user;
    }

    public function hash_password($password, $salt)
    {
        return sha1($password . $salt);
    }

    public function make_salt()
    {
        return sha1(time());
    }

    public function update($data, $id)
    {
        $this->db->update('users', $data, $id);
    }

}