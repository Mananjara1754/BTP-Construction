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
$route['default_controller'] = 'controller_user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['maj-data-btp'] = 'Controller_user/mettreAJour';

$route['admin'] = 'controller_user/admin';
$route['client'] = 'controller_user/index';
$route['login-client-btp'] = 'Controller_login/verifClient';
$route['accueil-client-btp'] = 'Controller_login/versAccueilClient';
$route['creation-devis-client-btp'] = 'Controller_devis/versCrudDevis';
$route['deconnexion-client-btp'] = 'Controller_login/deconnexion_client';
//$route['info-devis-client-btp-DSq7Ujidau(:any)589Tnv96AdsS.html'] = 'Controller_devis/infoDevis/$1';
$route['info-devis-client-btp-(:any).html'] = 'Controller_devis/infoDevis/$1';
$route['paiement-devis-client-btp-(:any).html'] = 'Controller_paiement/versPaiement/$1';

$route['accueil-admin-btp'] = 'Controller_login/versAccueilAdmin';
$route['login-admin-btp'] = 'Controller_login/verifLogin';
$route['liste-devis-admin-btp'] = 'Controller_Admin_devis/versListeDevis';
$route['travaux-btp'] = 'Controller_travaux/versCrudTravaux';
$route['travaux-btp/(:any)'] = 'Controller_travaux/versCrudTravaux/$1';
$route['modification-travaux-btp-(:any).html'] = 'Controller_travaux/vers_updateTravaux/$1';
$route['finition-btp'] = 'Controller_finition/versCrudFinition';
$route['modification-finition-btp-(:any).html'] = 'Controller_finition/versUpdateFinition/$1';
$route['info-devis-admin-btp-(:any).html'] = 'Controller_Admin_devis/infoDevis/$1';

$route['import-csv-btp'] = 'Controller_csv/versImportCsv';
$route['dashboard-btp'] = 'Controller_dashboard/versDashboard';