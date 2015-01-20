<?php

abstract class Controller
{

	function __construct()
	{		
	}

	public function Request($url)
	{
        if(isset($url[1])){
		    if(empty($url[1])) $url[1] = 'index';
            $method = 'Action_' . $url[1];
            $functionArguments = array();
            $count = 0;

            $r = new ReflectionMethod('C_' . $url[0], 'Action_' . $url[1]);
            $params = $r->getParameters();

            foreach($params as $par) $count++;

            if($count > 0)
                for($i = 0; $i < $count; $i++)
                    $functionArguments[] = $url[$i + 2];

            if (method_exists($this, $method))
                call_user_func_array(array($this, $method), $functionArguments);
            else
                return null;

            $this->OnInput();
            $this->OnOutput();
        }
        else{
            $this->OnInput();
            $this->OnOutput();
        }
	}

	protected function OnInput()
	{
	}

	protected function OnOutput()
	{
	}

	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	protected function View($fileName, $vars = array())
	{
		foreach ($vars as $k => $v) 
		$$k = $v;

		ob_start(); 
		include "view/$fileName";
		return ob_get_clean(); 	
	}
}
