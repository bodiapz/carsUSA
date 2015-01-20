<?php
include_once('controller/C_Base.php');

class C_Ajax extends C_Base 
{
    public $main;
    public $pages_model;
    public $chat_model;

    function __construct() 
    {
        parent::__construct();


        $this->pages_model  = new M_Pages_Model();
        $this->slider_model = new M_Slider_Model();
        $this->chat_model   = new M_Chat_Model();
    }

    protected function action_change_status()
    {
        $table     = $_REQUEST['table'];
        $id        = (int)$_REQUEST['id'];
        $status    = (int)$_REQUEST['status'];
        $column    = $_REQUEST['column'];

        $this->pages_model->changeStatus($table, $status, $id, $column);
        die();
    }

    protected function action_addSlide()
    {
        $slide = $_REQUEST['fileName'];

        $id = $this->slider_model->createSlide(array('file' => $slide, 'status' => 1));
        include('view/slides/tpl_slide.php');
        die();
    }

    protected function action_deleteSlide()
    {
        $slideId = (int)$_REQUEST['slideId'];

        $this->slider_model->deleteSlide($slideId);
        die();
    }

    protected function action_deleteLabel()
    {
        $labelId = (int)$_REQUEST['labelId'];

        $this->slider_model->deleteSlideTexts($labelId);
        die();
    }

    protected function action_addLabel()
    {
        $slideId    = (int)$_REQUEST['slideId'];
        $startFrom  = explode('|', $_REQUEST['startFrom']);
        $moveTo     = explode('|', $_REQUEST['moveTo']);
        $labelText  = $_REQUEST['labelText'];
        $duration   = $_REQUEST['duration'];
        $class      = $_REQUEST['class'];

        $data = array ('text' => $labelText, 'start_from' => trim($startFrom[1]), 'move_to' => trim($moveTo[1]), 'duration' => $duration, 'slide_id' => $slideId, 'class' => $class);

        $id = $this->slider_model->createSlideTexts($data);
        include('view/slides/tpl_slide_label_edit.php');
        die();
    }

    protected function action_getNewChatTokens()
    {
        $tokens = $_POST['tokens'];

        $newTokens = $this->chat_model->getNewChatTokens($tokens);

        echo json_encode($newTokens);

        die();
    }

    protected function action_getNewChat()
    {
        $token = htmlspecialchars(trim($_POST['token']));

        $chat = $this->chat_model->getNewChats($token);

        if(!empty($chat))
        {
            $chat[0]['chat'] = $this->View('chat/chat.php',array('messages' => $chat[0]['messages']));
        }

        $chat = $this->View('chat/support_chat.php',array('chats' => $chat));

        echo $chat;
        die();
    }

    protected function action_refreshChat()
    {
        $token = htmlspecialchars(trim($_POST['token']));

        $chat = $this->chat_model->getNewChats($token);

        if(!empty($chat))
        {
            $chat[0]['chat'] = $this->View('chat/chat.php',array('messages' => $chat[0]['messages']));
        }

        $chat = $this->View('chat/support_chat.php',array('chats' => $chat));

        echo $chat;

        die();
    }

    protected function action_checkNewMessage()
    {
        $token      = htmlspecialchars(trim($_POST['token']));
        $id_from    = (int)$_POST['id_from'];
        $id_into    = (int)$_POST['id_into'];

        if($this->chat_model->checkNewMessages($token,$id_from,$id_into))
            echo '1';
        else
            echo '0';

        die();
    }

    protected function action_sendMessage()
    {
        $token      = htmlspecialchars(trim($_POST['token']));
        $message    = htmlspecialchars(trim($_POST['message']));

        $this->chat_model->sendMessage($token, $message);

    }

    protected function action_closeChat()
    {
        if(!empty($_POST['token']))
        {
            $token      = htmlspecialchars(trim($_POST['token']));
            $this->chat_model->closeChat($token);
        }
    }
}