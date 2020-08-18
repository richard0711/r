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
    $route['content/edit'] = 'Content_controller/editContent';
    
    /** menu routes: **/
    $route['menu/list'] = 'Menu_controller/menuList';
    $route['menu/new'] = 'Menu_controller/newMenu';
    $route['menu/edit'] = 'Menu_controller/editMenu';
    
    /** news routes: **/
    $route['news/list'] = 'News_controller/newsList';
    $route['news/new'] = 'News_controller/newNews';
    $route['news/edit'] = 'News_controller/editNews';
    
}

if ($method == 'POST') {
    
}

if ($method == 'PUT') {
    
}