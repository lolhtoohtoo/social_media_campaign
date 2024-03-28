<?php

namespace controllers;

require __DIR__."/../services/mediaApp_service.php";

use Service\MediaAppService;
use core\BaseController;

class MediaAppController extends BaseController{
    private $mediaAppService;

    public function __construct(){
        $this->mediaAppService = new MediaAppService();
    }

    public function index(): void{
        if(isset($_SESSION["AdminId"])){
            require __DIR__."/../views/media_app/pages/add_mediaApp_page.php";
            if(isset($_POST["btnCreateMediaApp"])){
                $this->createMediaApp();
            }
        }else{
            showAlertPopup("Please Login First");
            pushRoute("/");
        }
    }

    private function createMediaApp():void{
       
        $mediaAppName = $_POST["mediaAppName"];
        $mediaAppTechnique = $_POST["mediaAppTechnique"];
        $mediaAppRating = $_POST["mediaAppRating"];
        $mediaAppLink = $_POST["mediaAppLink"];

        $oldMediaApp = $this->mediaAppService->getMediaAppByName($mediaAppName);
        if($oldMediaApp !== null){
            showAlertPopup("Media-app $mediaAppName is already existed");
            exit();
        }
 
        $imagePath = imageSaver("mediaAppImage", null);
        $newMediaApp = $this->mediaAppService->insertOneMediaApp(
            $mediaAppName,
            $imagePath,
            $mediaAppTechnique,
            $mediaAppLink,
            (int)$mediaAppRating,
            (int)$_SESSION["AdminId"]
        );

        if($newMediaApp !== null){
            showAlertPopup("Media-app $mediaAppName created Successfully");
        }else{
            showAlertPopup("Something went wrong. Please try again later");
        }

        
    }
}