<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$method = (isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET');

if ($method == 'OPTIONS')
{
    header('Access-Control-Allow-Origin: ' . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*'));
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");        
    header('Access-Control-Allow-Credentials: true');  
    die();
}

if ($method == 'GET') {
    
    /** content routes: **/
    $route['content/(:num)'] = 'Content_controller/get/$1';
    $route['content/list'] = 'Content_controller/get';
    
    /** menu routes: **/
    $route['menu/list'] = 'Menu_controller/get';
    
    /** news routes: **/
    $route['news/(:num)'] = 'News_controller/get/$1';
    $route['news/list'] = 'News_controller/get';
    
    /** banner routes: **/
    $route['banner/list'] = 'Banner_controller/get';
    
    /** gallery routes: **/
    $route['gallery/list'] = 'Gallery_controller/get';
    
}

if ($method == 'POST') {
    
}

if ($method == 'PUT') { 
    
}