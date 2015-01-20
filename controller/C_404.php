<?php
include_once('controller/C_Base.php');

class C_404 extends C_Base
{
    public $main;

    function __construct()
    {
        parent::__construct();
        $this->main = true;
    }

    protected function Action_index()
    {
        parent::OnInput();
    }

    protected function OnOutput()
    {
        $this->content = $this->View('layout/tpl_404.php');
        parent::OnOutput();
    }
}