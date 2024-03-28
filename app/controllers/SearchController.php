<?php

namespace controllers;

use core\BaseController;
use Service\CampaignService;
use Service\CampaignTypeService;
use Service\MediaAppService;


class SearchController extends BaseController{
    private $campaignService;
    private $campaignTypeService;
    private $mediaAppService;

    public function __construct(){
        $this->campaignService = new CampaignService();
        $this->campaignTypeService = new CampaignTypeService();
        $this->mediaAppService = new MediaAppService();
    }

    public function index() :void{
        $originalArrayData = $this->campaignService->getAllCampaign();
        $campaignList = [];
        $campaignList = $originalArrayData;
        $orgCampaignList = $originalArrayData;
        if(isset($_POST["searchBtn"])){
            $nameString = $_POST["searchInput"];
            $campaignList=[];
            if($nameString === ""){
                $campaignList = $originalArrayData;
            }else{
                $arrayData = $this->campaignService->getAllCampaignByNameOnlyActive($nameString);
                $campaignList = $arrayData;
            }
        }
        require __DIR__."/../views/home/pages/search_page.php";
    }
}