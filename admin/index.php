<?php

session_name('chatMarket');
session_start();
header('Content-type: text/html; charset=utf-8');

ini_set('display_errors', 1);
error_reporting(1);

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

$link = $_SERVER['REQUEST_URI'];
$config = parse_ini_file('../config.ini',true);

$cleanDomain = preg_replace("/(http:\/\/)/i", '', $config['config']['basePath'] . 'admin/');
$subdomain = substr($cleanDomain, strpos($cleanDomain, '/'));

$link = str_replace($subdomain, '', $link);

$url = explode('/', $link);

/*
if(!empty($_REQUEST['page']))
    $url = explode('/', $_REQUEST['page']);*/

if(empty($url[0])) {
    $controller = new C_Main();
    $url = "";
}
else
{
    $class = 'C_' . $url[0];
    $controller = new $class;

}

$controller->Request($url);