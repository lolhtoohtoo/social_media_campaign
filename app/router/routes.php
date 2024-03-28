<?php

require __DIR__."/../core/controllers/WaitingRoomController.php";
require __DIR__."/../controllers/HomeController.php";
require __DIR__."/../controllers/AdminController.php";
require __DIR__."/../controllers/CampaignTypeController.php";
require __DIR__."/../controllers/MediaAppController.php";
require __DIR__."/../controllers/CampaignController.php";
require __DIR__."/../controllers/ParticipationController.php";
require __DIR__."/../controllers/CustomerController.php";
require __DIR__."/../controllers/SearchController.php";
require __DIR__."/../controllers/ContactUsAndSupportController.php";

use controllers\WaitingRoomController;
use controllers\HomeController;
use controllers\CustomerController;
use controllers\AdminController;
use controllers\CampaignTypeController;
use controllers\MediaAppController;
use controllers\CampaignController;
use controllers\ParticipationController;
use controllers\SearchController;
use controllers\ContactUsAndSupportController;


$AdminController = new AdminController();
$CampaignTypeController = new CampaignTypeController();
$MediaAppController = new MediaAppController();
$CampaignController = new CampaignController();
$WaitingRoomController = new WaitingRoomController();
$HomeController = new HomeController();
$CustomerController = new CustomerController();
$ParticipationController = new ParticipationController();
$SearchController = new SearchController();
$ContactUsAndSupportController = new ContactUsAndSupportController();


$AdminController->__construct();
$CampaignTypeController->__construct();
$MediaAppController->__construct();
$CampaignController->__construct();
$HomeController->__construct();
$CustomerController->__construct();
$ParticipationController->__construct();
$SearchController->__construct();
$ContactUsAndSupportController->__construct();


$routes = [
    "" => ["controller" => $HomeController, "action" =>"index"],
    "/parentHelp" =>["controller" => $HomeController, "action" => "parentHelpPage"],
    "/liveStream" => ["controller" => $HomeController, "action" => "liveStreamPage"],
    "/legislationAndGuidance" =>["controller" => $HomeController, "action" => "legislationAndGuidancePage"],
    "/waitingRoom" =>["controller" => $WaitingRoomController, "action" => "index"],
    "/info" => ["controller" => $HomeController, "action" =>"infoPage"],
    "/search" => ["controller" => $SearchController, "action" =>"index"],
    "/adminRegister" => ["controller" => $AdminController, "action" => "index"],
    "/adminLogin" => ["controller" => $AdminController, "action" => "getLoginPage"],
    "/adminDashboard" => ["controller" => $AdminController, "action" => "getAdminDashboard"],
    "/adminLogout" => ["controller" => $AdminController, "action" => "getLogoutPage"],
    "/addCampaignType" =>["controller" => $CampaignTypeController, "action" => "index"],
    "/addMediaApp" => ["controller" => $MediaAppController, "action" => "index"],
    "/addCampaign" => ["controller" => $CampaignController, "action" => "index"],
    "/campaignDetail" => ["controller" =>$CampaignController, "action" =>"campaignDetail"],
    "/participationForm" => ["controller" => $ParticipationController, "action" =>"index"],
    "/customerLogin" => ["controller" => $CustomerController, "action" =>"customerLogin"],
    "/customerRegister" => ["controller" => $CustomerController, "action" =>"customerRegister"],
    "/privacyPolicy" => ["controller" =>$ContactUsAndSupportController, "action"=> "index"],
    "/contactUs" => ["controller" => $ContactUsAndSupportController, "action" => "contactUs"],
    "/adminCustomerSupport" =>["controller" => $ContactUsAndSupportController, "action" =>"checkCustomerSupportMessage"],
    "/adminReplySupport" => ["controller" => $ContactUsAndSupportController, "action" =>"replyCustomerSupportMessage"],
];

function getRouteStringFromURL() : string{
    $getUri = $_SERVER["REQUEST_URI"];
    $route = strtok($getUri, "?"); 
    $data = rtrim($route, "/");
    
    return $data;
}

function changeRoute(string $routeName, array $arrayRoutes ) : void{
    if(isset($arrayRoutes[$routeName])){
        // $controllerName = $arrayRoutes[$routeName]["controller"];
        // $action = $arrayRoutes[$routeName]["action"];

        // require_once __DIR__."/../../app/controllers/$controllerName.php";
        // // use controllers\$controllerName;
     
        // $dynamicController = new $controllerName;

        // $dynamicController->$action();
        
        // get dynamic controller depend on routename
        $viewController = $arrayRoutes[$routeName]["controller"];
        $action = $arrayRoutes[$routeName]["action"];

        $viewController->$action();
    }else{
        echo "404 : Page not found";
    }
}


