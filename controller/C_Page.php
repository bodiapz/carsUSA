<?php
include_once('controller/C_Base.php');

class C_Page extends C_Base 
{
    public $main;
    public $page_model;

    function __construct() 
    {
        parent::__construct();
        $this->page_model = new M_Page_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();
        $this->main = true;
        $this->main_page = false;
    }

    protected function OnOutput()
    {
        parent::OnOutput(); 
    }

    public function action_tariff_map()
    {
        $this->meta['title'] = $this->translate("Розрахунок вартості доставки", false);
        $countries = $this->page_model->get_countries();
        $ports     = $this->page_model->get_ports($this->configData['config']['defaultCountryId']);
        $prices    = $this->page_model->get_prices();

        $vars = array('countries' => $countries, 'ports' => $ports, 'prices' => $prices);
        $this->content = $this->View('page/tpl_tariff_map.php', $vars);
    }

    public function action_customs_calculator()
    {
        $vars = array();
        $this->content = $this->View('page/tpl_customs_calculator.php', $vars);
    }

    public function action_view($permalink)
    {
        $page = $this->page_model->getPage($permalink);
        $this->meta['title'] = $page[$this->prefix . 'title'];
        $vars = array('page' => $page);
        $this->content = $this->View('page/tpl_page.php', $vars);
    }

    public function action_thanks()
    {
        $this->meta['title'] = $this->translate("Дякуємо", false);
        $this->content = $this->View('page/tpl_thanks.php');
    }
}