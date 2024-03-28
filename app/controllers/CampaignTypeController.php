<?php 

namespace controllers;

require __DIR__."/../services/campaignType_service.php";
// require __DIR__."/../core/controllers/baseController.php";


use Service\CampaignTypeService;
use core\BaseController;

class CampaignTypeController extends BaseController{
    private $campaignTypeService;

    public function __construct(){
        $this->campaignTypeService = new CampaignTypeService();
    }

    public function index(): void{
        if(isset($_SESSION["AdminId"])){
            require __DIR__."/../views/campaign_type/pages/add_campaignType.php";
            if(isset($_POST["btnCreateCampaignType"])){
                $this->createCampaignType();
            }
        }else{
            showAlertPopup("Please Login First");
            pushRoute("/");
        }
    }

    private function createCampaignType() : void{
        $newCampaignTypeName = $_POST["campaignTypeName"];
        $checkCampaignExists = $this->campaignTypeService->getCampaignTypeByName($newCampaignTypeName);
        if($checkCampaignExists !== null){
            showAlertPopup("Campaign-Type $newCampaignTypeName already exists");
        }else{
            $newCampaignTypeModel = $this->campaignTypeService->insertOneCampaignType(
                $newCampaignTypeName,
                $_SESSION["AdminId"],
            );

            if($newCampaignTypeModel !== null){
                showAlertPopup("Campaign-Type $newCampaignTypeName created Successfully");
            }else{
                showAlertPopup("Something went wrong. Please try again later");
            }
        }
    }
}