<?php
namespace controllers; 



use core\BaseController;
use DateTime;
use Service\CampaignService;
use Service\CustomerService;

class HomeController extends BaseController{
    private $campaignService;
    private $customerService;

    public function __construct(){
        $this->campaignService = new CampaignService();
        $this->customerService = new CustomerService();
    }
    
    public function index(){
        $currentDateTime = new DateTime();
        $month = $currentDateTime->format("m");
        $valueMonth = (int)$month;
        $monthName = $currentDateTime->format("F");
        $customerList = $this->customerService->getAllCustomerWithMonth($valueMonth);

        require __DIR__ ."/../views/home/pages/home_page.php";
    }

    public function infoPage(){

        $dataList = $this->campaignService->getAllCampaignByLimit(4);
        require __DIR__ ."/../views/home/pages/info_page.php";

    }

    public function parentHelpPage(){
        require __DIR__."/../views/home/pages/parent_help_page.php";
    }

    public function liveStreamPage(){
        require __DIR__."/../views/home/pages/live_streaming_page.php";
    }

    public function legislationAndGuidancePage(){
        require __DIR__."/../views/home/pages/legislation_guidance_page.php";
    }
}
