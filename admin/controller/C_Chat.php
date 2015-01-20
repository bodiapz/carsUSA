<?php
include_once('controller/C_Base.php');

class C_Chat extends C_Base
{
    public $main;
    public $chat_model;

    function __construct() 
    {
        parent::__construct();


        $this->chat_model = new M_Chat_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();
        $this->main = true;
    }

    protected function OnOutput()
    {
        parent::OnOutput();
    }

    protected function action_show_chat()
    {
        $chats = $this->chat_model->getNewChats();

        if(!empty($chats))
            foreach($chats as $key => $chat)
            {
                $chats[$key]['chat'] = $this->View('chat/chat.php',array('messages' => $chat['messages']));
            }

        //echo"<pre>";print_r($chats);echo"</pre>";
        $chats = $this->View('chat/support_chat.php',array('chats' => $chats));

        $this->content = $this->View('chat/all_chats.php',array('chats' => $chats));
    }

}