<?php
include_once('controller/C_Base.php');

class C_Category extends C_Base 
{

    function __construct() 
    {
        parent::__construct();
    }

    protected function OnInput()
    {
        parent::OnInput();
    }

    protected function OnOutput()
    {        
        parent::OnOutput(); 
    }

    public function action_view($permalink)
    {
        $category = $this->category_model->get_category_by_id($permalink);
        $categories = $this->category_model->get_categories();

        $vars = array('category' => $category, 'categories' => $categories);
        $this->content = $this->View('categories/tpl_view.php', $vars);
    }
}