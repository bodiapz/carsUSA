<?php
include_once('controller/C_Base.php');

class C_Slider extends C_Base
{
    public $main;
    public $slider_model;
    public $slider;

    function __construct() 
    {
        parent::__construct();

        if(empty($this->user))
        {
            $this->baseSitePath = trim($this->configData['config']['baseSitePath']);
            $this->redirect('user/login');
        }

        $this->slider_model = new M_Slider_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();

    }

    protected function Action_slides()
    {
        $this->main = true;

        $slides = $this->slider_model->getSlides();
        $this->content =  $this->View('slides/tpl_slides.php', array('slides' => $slides));
    }

    protected function Action_slide($slideId)
    {
		$this->slider = true;
        parent::OnInput();
        $this->main = true;

        $slides = $this->slider_model->getSlideById($slideId);

        foreach ($slides as $key => $slide) {
            $slides[$key]['labels'] = $this->slider_model->getTexts($slide['id']);
        }

        $texts = $this->slider_model->getTexts($slideId);

        $this->content =  $this->View('slides/tpl_slide_editor.php', array('slides' => $slides, 'texts' => $texts));

    }

    protected function OnOutput()
    {
        parent::OnOutput();
    }
}