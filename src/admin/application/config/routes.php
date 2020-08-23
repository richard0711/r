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
    $route['content/del/(:num)'] = 'Content_controller/delContent/$1';
    
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
    
    /** banner routes: **/
    $route['banner/list'] = 'Banner_controller/bannerList';
    $route['banner/new'] = 'Banner_controller/newBanner';
    $route['banner/edit/(:num)'] = 'Banner_controller/editBanner/$1';
    $route['banner/del/(:num)'] = 'Banner_controller/delBanner/$1';
    
    /** gallery routes: **/
    $route['gallery/list'] = 'Gallery_controller/galleryList';
    $route['gallery/new'] = 'Gallery_controller/newGallery';
    $route['gallery/edit/(:num)'] = 'Gallery_controller/editGallery/$1';
    $route['gallery/del/(:num)'] = 'Gallery_controller/delGallery/$1';
}

if ($method == 'POST') {
    
}

if ($method == 'PUT') {
    
}