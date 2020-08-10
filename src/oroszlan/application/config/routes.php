<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'front_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$method = (isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET');

if ($method == 'OPTIONS')
{
    header('Access-Control-Allow-Origin: ' . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*'));
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Client-key, Datasheet-client-key");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");        
    header('Access-Control-Allow-Credentials: true');  
    die();
}

if ($method == 'GET') {
    /** HOMEPAGE routes: **/
    $route['fooldal'] = 'Front_controller/index';
    $route['index'] = 'Front_controller/index';
    $route['home'] = 'Front_controller/index';
    
    /** OTHER routes: **/
    $route['p/(:any)/(:any)/(:any)'] = 'Front_controller/page/$1/$2/$3';
}

if ($method == 'POST') {
    
}

if ($method == 'PUT') {
    
}