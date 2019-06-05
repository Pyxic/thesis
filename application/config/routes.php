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
$route['default_controller'] = 'registration';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['/projects/createProject/(:id)'] = "projects/createProject/$1";
$route['/registration/addUser'] = "/registration/addUser";
$route['/projects/createTask/(:id)/(:id)'] = "projects/createTask/$1/$2";
$route['/projects/structure/(:id)'] = "projects/structure/$1";
$route['/gant/index/(:id)'] = "/gant/index/$1";
$route['/gant/updateGant/(:id)/(:projectId)'] = "/gant/updateGant/$1/$2";
$route['/reports/index/(:id)'] = "/reports/index/$1";
$route['/projects/updateActualEnd/(:id)/(:projectId)'] = "/projects/updateActualEnd/$1/$2";
$route['/projects/myTasks/(:id)'] = "/projects/myTasks/$1";
$route['/projects/upload/(:id)'] = "/projects/upload/$1";
$route['/projects//downloadFile'] = "/projects//downloadFile";
$route['/participants/inviteUser'] = "/participants/inviteUser";
$route['/registration/addEmployee/(:$email)/(:id)/(:any)'] = "/registration/addEmployee/$1/$2/$3";
$route['/projects/changeStatus/(:num)/(:any)/(:idProject)/(:num)'] = "/projects/changeStatus/$1/$2/$3/$4";
$route['/projects/reject'] = "/projects/reject";
$route['/projects/read/(:num)/(:id)'] ="/projects/read/$1/$2";
$route['/projects/done/(:id)/(:num)'] = "/projects/done/$1/$2";
$route['/projects/addProjectPart'] = "/projects/addProjectPart";
$route['/participants/createDepart'] = "/participants/createDepart";
$route['/participants/addToDepart'] = "/participants/addToDepart";
$route['/participants/addInDepart'] = "/participants/addInDepart";
$route['/participants/changeDepart/(:id)/(:id)'] = "/participants/changeDepart/$1/$2";
$route['/documents/index/(:id)'] = "/documents/index/$1";
$route['/documents/downloadFile/(:id)'] = "/documents/downloadFile/$1";
$route['/documents/deleteFile'] = "/documents/deleteFile";
$route['/documents/changeAccessFile'] = "/documents/changeAccessFile";
$route['/projects/changeEndProjectDate'] = "/projects/changeEndProjectDate()";
$route['/projects/addToArchive/(:id)'] = "/projects/addToArchive/$1";
$route['/projects/addToActive/(:id)'] = "/projects/addToActive/$1";
$route['/projects/deleteMember'] = "/projects/deleteMember";
$route['/projects/searchUser'] = "/projects/searchUser";
