<?php
include_once('controller/C_Base.php');

class C_Main extends C_Base 
{
    public $main;
    public $base_model;
    public $user_model;

    function __construct() 
    {
        parent::__construct();
        $this->base_model = new M_Base_Model();
        $this->user_model = new M_User_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();
        $this->main = true;
    }

    protected function OnOutput()
    {
        $countUsers = count($this->base_model->getUser());


        $vars = array('countUsers' => $countUsers);
        $this->content =  $this->View('main/tpl_main.php', $vars);
        parent::OnOutput();
    }

}