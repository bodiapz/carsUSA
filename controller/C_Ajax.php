<?php
include_once('controller/C_Base.php');

class C_Ajax extends C_Base
{
    public $main;

    public $page_model;
    public $user_model;

    function __construct() 
    {
        parent::__construct();

        $this->page_model = new M_Page_Model();
        $this->user_model = new M_User_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();
        $this->main = true;
    }

    protected function OnOutput()
    {        
        // parent::OnOutput(); 
    }

    protected function Action_getPorts()
    {
        $res_ports = null;
        $country_id = (int)$_POST['country'];

        $ports = $this->page_model->get_ports($country_id);
        include('view/widgets/ports.php');
    }

    protected function Action_getBrands()
    {
        $res_ports = null;
        $category_id = (int)$_POST['categories'];

        $barands = $this->page_model->get_brands($category_id);

        if(!empty($barands))
            foreach($barands as $barand)
            {
                $res_ports[$barand['id']] = $barand['name'];
            }
        
        echo json_encode($res_ports);
    }

    protected function Action_getModels()
    {
        $res_ports = null;
        $brand_id = (int)$_POST['brands'];

        $models = $this->page_model->get_models($brand_id);

        if(!empty($models))
            foreach($models as $model)
            {
                $res_ports[$model['id']] = $model['name'];
            }
        
        echo json_encode($res_ports);
    }

    protected function Action_generateToken()
    {
        if(empty($_SESSION['chat_token']))
        {
            if(empty($this->user['id']))
            {
                $token = $this->generateRandomString(50,1);
                $_SESSION['chat_token'] = $token;
            }
            else
            {
                $token = $this->user['id'];
                $_SESSION['chat_token'] = $token;
            }
        }
        else
            $token = $_SESSION['chat_token'];

        echo $token;
    }

    protected function Action_chat_send_message()
    {
        $message = $this->user_model->db->clearInput($_POST['message']);

        $token = $_SESSION['chat_token'];

        $this->user_model->sendMessage($token, $message, 1, 0);

        echo $token;
    }

    protected function Action_chat_refresh()
    {
        $token = $_SESSION['chat_token'];

        $data = $this->user_model->getUserMessages($token);

        $messages = $this->View('chat/chat.php', array('messages' => $data['messages'], 'last_id' => $data['last_id']));

        echo $messages;
    }

    protected function Action_addToFav()
    {
        $carId = $_REQUEST['carId'];

        $data = $this->page_model->saveFavCarUser($this->user['id'], $carId);

        $messages = $this->View('parse/tpl_fav.php', array('state' => true));

        echo $messages;
    }

    protected function Action_delFromFav()
    {
        $carId = $_REQUEST['carId'];

        $data = $this->page_model->delFavCarUser($this->user['id'], $carId);

        $messages = $this->View('parse/tpl_fav.php');

        echo $messages;
    }

    protected function Action_chat_isAdmin_refresh()
    {
        $token = $_SESSION['chat_token'];

        if(!empty($_POST['id_from']))
            $from = (int)$_POST['id_from'];
        else
            $from = 0;

        if(!empty($_POST['id_into']))
            $into = (int)$_POST['id_into'];
        else
            $into = 0;

        $check = $this->user_model->checkExistAdminMessages($token, $from, $into);

        if($check)
            echo "1";
        else
            echo "0";
    }

    protected function Action_ask_price()
    {
        if(!empty($_POST['lotId']) && !empty($_POST['fullname']) && !empty($_POST['user_cars_id']))
        {
            $id         = (int)$_POST['user_cars_id'];
            $lotId      = (int)$_POST['lotId'];
            $fullname   = $this->user_model->db->clearInput($_POST['fullname']);
            $this->user_model->sendMessage($this->user['id'], "Від " . $this->user['first_name'] . ". Прошу уточнити ціну на автомобіль " . $fullname . ". LotId: " . $lotId , 1, 0);

            $this->page_model->setAskPrice($id);

            $data = $this->user_model->getUserMessages($this->user['id']);

            $messages = $this->View('chat/messages.php', array('messages' => $data['messages']));

            echo $messages;
        }

        die();
    }
}