<?php
include_once('controller/C_Base.php');

class C_Pages extends C_Base 
{
    public $main;
    public $pages_model;

    function __construct() 
    {
        parent::__construct();
        $this->pages_model = new M_Pages_Model();
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

    public function action_list_pages()
    {
        $pages = $this->pages_model->getPages();

        $vars = array('pages' => $pages);
        $this->content = $this->View('pages/tpl_list_pages.php', $vars);
    }

    public function action_edit($id)
    {
        if($this->isPost()) 
        {            
            if(!empty($id)) {
                $this->pages_model->update($_POST, $id);
            }
            else $this->redirect('pages/list_pages');
        }
        
        $page = $this->pages_model->getPageById($id);

        $vars = array('page' => $page);
        $this->content = $this->View('pages/tpl_edit.php', $vars);
    }

    public function action_create()
    {
        if($this->isPost()){
            $this->pages_model->createPage($_POST);
            $this->redirect('pages/list_pages');
        }

        $pages = $this->pages_model->getPages();
        $this->content = $this->View('pages/tpl_create.php', array('pages' => $pages));
    }

    public function action_tariff_map($id)
    {
        $price = $this->pages_model->getZonePricesById($id);

        if($this->isPost())
        {
            if(!empty($id)) {
                $this->pages_model->updatePriceZone($_POST, $id);
                $this->redirect('pages/zones');
            }
        }

        $vars = array('price' => $price);
        $this->content = $this->View('pages/tpl_tariff_map.php', $vars);
    }

    public function action_zones()
    {
        $zones = $this->pages_model->getZonePrices();

        if($this->isPost())
        {
            $id = (int) $_POST['id'];

            if(!empty($id)) {
                $this->pages_model->updatePriceZone($_POST, $id);
                $this->redirect('pages/zones');
            }
        }

        $vars = array('zones' => $zones);
        $this->content = $this->View('pages/tpl_zones.php', $vars);
    }

}