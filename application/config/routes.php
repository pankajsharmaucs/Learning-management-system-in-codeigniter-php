<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

// ========Course=====
$route['/'] = 'home';
$route['courses'] = 'lms/Courses/index';
$route['course/(:any)'] = 'lms/Courses/getCourseDetail/$1';



$route['login'] = 'lms/Courses/login';
$route['register'] = 'lms/Courses/register';
$route['reset-account'] = 'lms/Courses/resetAccount';


$route['student'] = 'lms/Student/index';
$route['student-dashboard'] = 'lms/Student/index';
$route['student/my_course'] = 'lms/Student/getMyCourse';
$route['student/player/(:any)'] = 'lms/Student/player/$1';
$route['student/logout'] = 'lms/Student/logout';


$route['teacher-dashboard'] = 'lms/Teacher/index';
$route['teacher/createFirstCourse'] = 'lms/Teacher/createFirstCourse';
$route['teacher/openPendingCourse/(:any)'] = 'lms/Teacher/openPendingCourse/$1';


$route['teacher/create_course'] = 'lms/Teacher/createMyCourse';
$route['teacher/create_announce'] = 'lms/Teacher/create_announce';
$route['teacher/create_course_dashboard'] = 'lms/Teacher/createMyCourseDashboard';
$route['teacher/create_course_dashboard_media'] = 'lms/Teacher/createMyCourseDashboardMedia';
$route['teacher/create_course_dashboard_desc'] = 'lms/Teacher/createMyCourseDashboardDesc';
$route['teacher/create_course_dashboard_cont'] = 'lms/Teacher/createMyCourseDashboardCont';
$route['teacher/create_course_coupon'] = 'lms/Teacher/create_course_coupon';
$route['teacher/sendCourseToAdmin'] = 'lms/Teacher/sendCourseToAdmin';
$route['teacher/My-Earning'] = 'lms/Teacher/myearning';
$route['teacher/my_course'] = 'lms/Teacher/getMyCourse';
$route['teacher/logout'] = 'lms/Teacher/logout';



$route['category'] = 'lms/Courses/category';
$route['categorydetail'] = 'lms/Courses/categorydetail';



// =============Buy==course==
$route['buyCourse/(:any)'] = 'lms/Courses/buyCourse/$1';
$route['payment'] = 'lms/Courses/payment';
$route['paymentControll'] = 'lms/Courses/paymentControll';





// =================master=============

$route['master-dashboard'] = 'lms/Master/index';


$route['404_override'] = 'home/NotExist'; 












// ==============Get==country==dropdown===
$route['search_country'] = 'Search_e/countrySearch';
$route['open_all_country'] = 'Search_e/all_country';

// =========Get==auto===search==dropdown=
$route['search_home'] = 'Search_e/autoCompleteSearch';
$route['Company_info/(:any)'] = 'Company_info/index/$1';

// =============Advance===search======
// $route['Advance_search/(:any)'] = 'Advance_search/index/$1';
// $route['Advance_search/(:any)'] = 'AdvanceSearch_e/index/$1';

$route['Advance_search/(:any)'] = 'AdvanceSearch_e/index/$1';

// ==============Director_search===============
$route['Director_info/(:any)'] = 'Director_info/index/$1';

// ==================Signup==========
$route['Register'] = 'Register/index';

// ===============Contact=====
$route['Support'] = 'Contact/index';
// =======================Privacy==policy=====
$route['Privacy'] = 'Contact/privacy';

// ================FAQs===================
$route['faq'] = 'Contact/faq';




// ==============Add===to==cart==pankaj=

$route['addToCart/(:any)'] = 'Company_info/add/$1';
$route['removeCart/(:any)'] = 'Company_info/remove/$1';

// ===============pankaj==================================


// ==============Add to cart Aquib===================
$route['addToCartAjax'] = 'Company_info/addToCartAjax';
$route['cart'] = 'Cart_e/addToCartUrl';
$route['updateComInfo'] = 'Company_info/updateComInfoFunc';
$route['CheckOutAll'] = 'Cart_e/checkOutAllItem';
// ===============pankaj==================================
// $route['Checkout/(:any)'] = 'Company_info/Checkout/$1';
// ===================reset Password=================
$route['changePassword'] = 'user_dashboard_e/Dashboard_e/changePassword';
$route['sendMoneyRequest'] = 'user_dashboard_e/Dashboard_e/requestMoney';
$route['removeFromCart'] = 'user_dashboard_e/Dashboard_e/removeFromOrders';
$route['buyNow'] = 'user_dashboard_e/Dashboard_e/buyNowFromCart';
$route['buyAll'] = 'user_dashboard_e/Dashboard_e/buyAllItemFromCart';


// =================User==dashboard=====
$route['User_Dashboard'] = 'user_dashboard_e/Dashboard_e/index';
$route['UpdateProfile']='user_dashboard_e/Dashboard_e/UpdateProfile';

// =============User==ticket=====
$route['createTicket'] = 'user_dashboard_e/Dashboard_e/createTicket';
$route['CloseTicket/(:any)'] = 'user_dashboard_e/Dashboard_e/CloseTicket/$1';
$route['OpenTicket/(:any)'] = 'user_dashboard_e/Dashboard_e/OpenTicket/$1';





$route['Logout']='user_dashboard_e/Dashboard_e/logout';




// ==================admin dashboard====================
$route['Admin_Dashboard'] = 'admin_dashboard_e/ADashboard_e/index';

// ===============Admin===routes====
$route['CreateProUser'] = 'admin_dashboard_e/ADashboard_e/CreateProUser';






// $route['faq'] = 'home/faq';
// $route['register'] = 'home/register';
// $route['reset_password'] = 'home/reset_password';
// $route['user/(:any)'] = 'admin/$1';
// $route['user/(:any)/(:any)'] = 'admin/$1/$2';
// $route['info'] = 'home/info';
// $route['about'] = 'home/about';
// $route['product_support'] = 'home/product_support';
// $route['contact'] = 'home/contact';
// $route['blogs'] = 'home/blogs';
// $route['charges_search'] = 'home/charges_search';
// $route['blog/(:any)'] = 'home/blog/$1';
// $route['director'] = 'home/director';
// $route['how_it_works'] = 'home/how_it_works';
// $route['charges'] = 'home/charges';
// $route['companies'] = 'home/companies';
// $route['directors'] = 'home/directors';
// $route['certificate'] = 'home/cert_and_docs';
// $route['company_network'] = 'home/company_network';
// $route['companynetwork/(:any)'] = 'home/companynetwork/$1';

// $route['trademarks'] = 'home/trademarks';
// $route['detail_company_report'] = 'home/detail_company_report';
// $route['track_a_company'] = 'home/track_a_company';
// $route['new-company-incorporation'] = 'home/new_incorporations';
// $route['recent_incorporations'] = 'home/recent_incorporations';
// $route['company/(:any)'] = 'home/company/$1';
// $route['director/(:any)'] = 'home/director/$1';
// $routes['User_Dashboard'] = 'Dashbaord/';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;


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
