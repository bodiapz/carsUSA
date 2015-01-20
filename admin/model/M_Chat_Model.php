<?php

class M_Chat_Model {

    public $db;
    public $configData;

    public function __construct(){
        $this->db = M_PDO::Instance();
        $this->configData = parse_ini_file('../config.ini',true);
    }

    public function getNewChats($token = "")
    {
        $where = "(1=1)";
        if($token != "")
            $where = " token = '" . $token . "'";
        $chats = null;
        $tokens = $this->db->select("SELECT token, MAX(id) as id FROM chat WHERE status = 1 AND " . $where . " GROUP BY token");

        if(!empty($tokens))
            foreach($tokens as $token)
            {
                $chat['messages']   = $this->db->select("SELECT * FROM chat WHERE token = '" . $token['token'] . "'");
                $chat['token']      = $token['token'];
                $chat['last_id']    = $token['id'];
                //$data['status'] = 0;
                //$this->db->update('chat',$data,$token['token'],'token');
                $chats[] = $chat;
            }

        return $chats;
    }

    public function getNewChatTokens($existsTokens = null)
    {
        $tokens = $this->db->select("SELECT DISTINCT(token) as token FROM chat WHERE `status` = 1");

        if(!empty($existsTokens) && !empty($tokens))
        {
            //print_r($tokens);
            foreach($tokens as $key => $token)
            {
                foreach($existsTokens as $e_token)
                {
                    if($token['token'] == $e_token)
                        unset($tokens[$key]);
                }
            }
        }

        return $tokens;
    }

    public function checkNewMessages($token, $id_from = 0, $id_into = 0)
    {
        $query = $this->db->select("SELECT 1 FROM chat WHERE token = '" . $token . "' AND id > " . $id_from . " AND id <= " . $id_into);

        if(empty($query))
            return false;
        else
            return true;
    }

    public function sendMessage($token, $message)
    {
        $data['status']     = 1;
        $data['type']       = 1;
        $data['token']      = $token;
        $data['message']    = $message;

        $this->db->insert('chat',$data);

    }

    public function closeChat($token)
    {
        $this->db->update('chat', array('status' => 0), $token, 'token');
    }
}
