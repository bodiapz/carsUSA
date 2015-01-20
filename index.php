<?php

session_start();
//print_r($_SESSION);session_destroy();
header('Content-type: text/html; charset=utf-8');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function __autoload($className){
    $type = explode('_', $className);

    switch($type[0]){
        case 'C':
            $type[1] = ucfirst($type[1]);
            $className = implode('_', $type);
            include_once('controller/' . $className . '.php');	break;
        case 'M':
            include_once('model/'. $className . '.php');		break;
    }
}

$config = parse_ini_file('config.ini',true);

/*
print_r($_REQUEST);die();
$link = $_SERVER['REQUEST_URI'];


$cleanDomain = preg_replace("/(http:\/\/)/i", '', $config['config']['basePath']);
$subdomain = substr($cleanDomain, strpos($cleanDomain, '/'));

$link = str_replace($subdomain, '', $link);

$url = explode('/', $link);
*/


if(!empty($_REQUEST['page']))
    $url = explode('/', $_REQUEST['page']);

	//print_r($_REQUEST);
	//echo "<pre>";print_r($_SERVER);echo "</pre>";
	//die('end');
	
	
if(empty($url[0])) {
    $controller = new C_Main();
    $url = "";
}
else
{
    $class = 'C_' . ucfirst($url[0]);

    if(file_exists('controller/' . ucfirst($class) . '.php'))
        $controller = new $class;
    else {
        $controller = new C_404();
    }
}

$controller->Request($url);