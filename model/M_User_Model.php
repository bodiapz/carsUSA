<?php
require_once('assets/classes/phpmailer/class.phpmailer.php');
require_once('assets/classes/phpmailer/class.smtp.php');

class M_User_Model {
    public $db;
    public $configData;

    public function __construct(){
        $this->db = M_PDO::Instance();

        $this->configData   = parse_ini_file('config.ini',true);
    }

    public function existEmail($email)
    {
        $email = $this->db->selectOne("SELECT * FROM users WHERE email = '" . $email . "'");

        if(empty($email))
            return false;
        else
            return $email;
    }

    public function auth($email, $password)
    {
        $auth = $this->db->selectOne("SELECT * FROM users WHERE email = '" . $email . "'");

        if(count($auth) == 0) return false;

        if($auth['password'] == $this->hash_password($password, $auth['salt']))
             return $auth;
        else
            return false;
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

    public function access($basePath = '')
    {
        if(!isset($_SESSION['admin']) || $_SESSION['admin'] != true)
            header('Location:' . $basePath . '/login');
    }

    // insert user
    public function setUser($data, $id = 0)
    {
        if($id != 0)
            $this->db->update('users', $data, $id);
        else
        {
            $data['created_at'] = date('c');
            $this->db->insert('users', $data);
            return $this->db->lastInsertId();
        }
    }

    public function getUserProfile($user_id)
    {
        $profile = $this->db->selectOne("SELECT * FROM user_profile WHERE user_id = " . $user_id);

        return $profile;
    }

    public function getUser($user_id)
    {
        return $this->db->selectOne("SELECT * FROM users WHERE id = " . $user_id);
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

    public function saveUserProfile($data, $user_id)
    {
        $this->db->update('user_profile',$data,$user_id,'user_id');
    }

    public function sendMessage($token, $message, $status, $type)
    {
        $data['token']      = $token;
        $data['message']    = $message;
        $data['status']     = $status;
        $data['type']       = $type;

        $this->db->insert('chat',$data);
    }

    public function getUserMessages($token, $mark_as_read = false)
    {
        $messages = $this->db->select("SELECT * FROM chat WHERE token = '" . $token . "'");

        $last_id = $this->db->selectOne("SELECT ifnull(max(id),0) as id FROM chat WHERE token = '" . $token . "'");

        $result['messages'] = $messages;
        $result['last_id']  = $last_id;

        $new = $this->db->selectOne("SELECT count(1) as count FROM chat WHERE token = '" . $token . "' AND type = 1 AND read_as_message = 1");

        $result['new_count'] = $new['count'];

        if($mark_as_read)
            $this->db->update('chat', array('read_as_message' => 0), $token, 'token');

        return $result;
    }

    public function checkExistAdminMessages($token, $from, $into)
    {
        $query = $this->db->select("SELECT id FROM chat WHERE id > " . $from . " AND id <= " . $into . " AND token = '" . $token . "' AND type = 1");

        if(!empty($query))
            return true;
        else
            return false;
    }

    public function set_verify_code($id, $phone, $code)
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>
                        <package key="bf809299403bccd2e3b00d94e51094a9ad7e8cb2">
                        <message>
                        <msg recipient= "+38' . $phone . '"  sender="Call2bid" type="0">"Parol: ' . $code . '"</msg>
                        </message>
                        </package>';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://alphasms.com.ua/api/xml.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        $out = curl_exec($curl);
        curl_close($curl);

        $this->db->update('users', array('code' => $code, 'changed_at' => $this->db->mysqlDateNow()), $id);
    }

    public function checkVerify($user)
    {
        if($user['verify'] == 0) return false;
        else return true;
    }

    public function checkLastResend($userId)
    {
        $count = $this->db->selectOne("SELECT * FROM users WHERE id = " . $userId . " AND changed_at < NOW() - INTERVAL 30 MINUTE");
        if(!empty($count)) return true;
        else return false;
    }

    public function verify($userId, $code)
    {
        $count = $this->db->selectOne("SELECT * FROM users WHERE id = " . $userId . " AND code = '" . $code . "'");

        //print_r($count); die();
        if(!empty($count)) {
            $this->db->update('users', array('verify' => 1, 'changed_at' => $this->db->mysqlDateNow()), $userId);
            return true;
        }
        else return false;
    }

    public function setToken($email, $token)
    {
        $user = $this->db->selectOne("SELECT * FROM users WHERE email = '" . $email . "'");

        $data['token']      = $token;
        $data['user_id']    = $user['id'];

        $this->db->query("DELETE FROM tokens WHERE user_id = " . $user['id']);
        $this->db->insert('tokens',$data);
    }

    public function getToken($token)
    {
        $info = $this->db->selectOne("SELECT * FROM tokens WHERE token = '" . $token . "'");

        if(empty($info))
            return false;
        else
            return $info;
    }

}