<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard_controller';
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
    
    /** auth routes: **/
    $route['login'] = 'Login_controller/index';
    
    /** content routes: **/
    $route['content/list'] = 'Content_controller/contentList';
    $route['content/new'] = 'Content_controller/newContent';
    $route['content/edit/(:num)'] = 'Content_controller/editContent/$1';
    
    /** menu routes: **/
    $route['menu/list'] = 'Menu_controller/menuList';
    $route['menu/new'] = 'Menu_controller/newMenu';
    $route['menu/edit/(:num)'] = 'Menu_controller/editMenu/$1';
    $route['menu/del/(:num)'] = 'Menu_controller/delMenu/$1';
    
    /** news routes: **/
    $route['news/list'] = 'News_controller/newsList';
    $route['news/new'] = 'News_controller/newNews';
    $route['news/edit/(:num)'] = 'News_controller/editNews/$1';
    $route['news/del/(:num)'] = 'News_controller/delNews/$1';
    
}

if ($method == 'POST') {
    
}

if ($method == 'PUT') {
    
}