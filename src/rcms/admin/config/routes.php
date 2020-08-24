<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
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

if ($method == "POST") {
    $route["content"] = "Content_controller/save";
    $route["content_item"] = "ContentItems_controller/save";
    
    $route["news"] = "News_controller/save";
    $route["news_item"] = "NewsItem_controller/save";
    
    $route["menu"] = "Menu_controller/save";
    $route["menu_item"] = "MenuItem_controller/save";
    
    $route["banner"] = "Banner_controller/save";
    $route["banner_item"] = "BannerItem_controller/save";
    
    $route["gallery"] = "Gallery_controller/save";
    
    $route["image/upload"] = "Image_controller/upload";
    
}
if ($method == "GET") {
    $route["contents"] = "Content_controller/get";
    $route["content/(:num)"] = "Content_controller/get/$1";
    
    $route["news"] = "News_controller/get";
    $route["news/(:num)"] = "News_controller/get/$1";
    
    $route["menu"] = "Menu_controller/get";
    $route["menu/(:num)"] = "Menu_controller/get/$1";
    
    $route["positions"] = "Position_controller/get";
    
    $route["banners"] = "Banner_controller/get";
    $route["banner/(:num)"] = "Banner_controller/get/$1";
    
    $route["gallery"] = "Gallery_controller/get";
    $route["gallery/(:num)"] = "Gallery_controller/get/$1";
}