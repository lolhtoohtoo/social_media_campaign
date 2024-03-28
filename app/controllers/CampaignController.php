<?php

namespace controllers;

require __DIR__."/../services/campaign_service.php";

use Service\CampaignService;
use Service\CampaignTypeService;
use Service\MediaAppService;
use core\BaseController;

class CampaignController extends BaseController{
    private $campaignService;
    private $mediaAppService;
    private $campaignTypeService;

    public function __construct(){
        $this->campaignService = new CampaignService();
        $this->mediaAppService = new MediaAppService();
        $this->campaignTypeService = new CampaignTypeService();
    }

    public function index() : void{
        if(isset($_SESSION["AdminId"])){
            $arrayMediaApp = $this->mediaAppService->getAllMediaApps();
            $arrayCampaignType = $this->campaignTypeService->getAllCampaignTypes();
            require __DIR__."/../views/campaign/pages/add_campaign.php";
            if(isset($_POST["btnCreateCampaign"])){
                $this->createCampaign();
            }
        }else{
            showAlertPopup("Please Login First");
            pushRoute("/");
        }
    }

    public function campaignDetail() : void{
        $campaignId = $_GET['campaignId'];
        $campaignModelData = $this->campaignService->getCampaignById($campaignId);
        $campaignTypeModelData = $this->campaignTypeService->getCampaignTypeById($campaignModelData->getCampaignTypeId());
        $mediaAppModelData = $this->mediaAppService->getMediaAppById($campaignModelData->getMediaAppId());
     
        require __DIR__."/../views/campaign/pages/campaign_detail.php";
        
    }


    private function createCampaign() :void{
        $campaignName = $_POST["campaignName"];
        $mediaAppId = $_POST["mediaAppOptions"];
        $campaignTypeId = $_POST["campaignTypeOptions"];
        // $campaignImageOne = $_POST["campaignImageOne"];
        // $campaignImageTwo = $_POST["campaignImageTwo"];
        // $campaignImageThree = $_POST["campaignImageThree"];
        // $campaignImageFour = $_POST["campaignImageFour"];
        $description = $_POST["description"];
        $aim = $_POST["aim"];
        $vision = $_POST["vision"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $fees = $_POST["fees"];
        $location = $_POST["location"];
        $mapDataLink = $_POST["mapDataLink"];
        $activeStatus = $_POST["activeStatus"] == "on" ? 1 : 0;
        $campaignContactEmail = $_POST["campaignContactEmail"];
        $campaignContactAdditionalInfo = $_POST["campaignContactAdditionalInfo"];
        
        $imageOnePath = imageSaver("campaignImageOne", null);
        $imageTwoPath = imageSaver("campaignImageTwo", null);
        $imageThreePath = imageSaver("campaignImageThree", null);
        $imageFourPath = imageSaver("campaignImageFour", null);

        $campaignData = $this->campaignService->insertOneCampaign(
            $campaignName,  
            $imageOnePath,
            $imageTwoPath,
            $imageThreePath,
            $imageFourPath,
            $description,
            $aim,
            $vision,
            $startDate,
            $endDate,
            $fees,
            $location,
            $mapDataLink,
            $activeStatus,
            $campaignContactEmail,
            $campaignContactAdditionalInfo,
            $_SESSION["AdminId"],
            $mediaAppId,
            $campaignTypeId,
        );

        if($campaignData == null){
            showAlertPopup("Campaign cannot be created. Please try again later");
        }else{
            showAlertPopup("Campaign created successfully");
        }
    }
}