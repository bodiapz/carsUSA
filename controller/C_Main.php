<?php
include_once('controller/C_Base.php');

class C_Main extends C_Base 
{
    public $main;
    public $main_page;
    public $slides;
    public $slider_model;
    public $page_model;

    function __construct() 
    {
        parent::__construct();
        $this->slider_model = new M_Slider_Model();
        $this->spasge_model = new M_Page_Model();

        $this->addJs('slider.js');
    }

    protected function OnInput()
    {
        parent::OnInput();
    }
	
    protected function Action_index()
    {
		$this->main = true;
        $this->main_page = true;
        $this->slides = $this->slider_model->getSlides();

        foreach ($this->slides as $key => $slide) {
            $this->slides[$key]['labels'] = $this->slider_model->getTexts($slide['id']);
        }
    }

    protected function OnOutput()
    {

        //echo '<pre>';print_r($randomCars);echo '</pre>';
        $vars = array('slides' => $this->slides);
        $this->content = $this->View('main/tpl_main.php', $vars);
        parent::OnOutput(); 
    }
}