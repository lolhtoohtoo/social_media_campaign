<?php

namespace controllers;

require __DIR__."/../utils/enum_to_array.php";
require __DIR__."/../services/participation_service.php";
require __DIR__."/../services/payment_service.php";

use BookingStatus;
use core\BaseController;
use model\ParticipateForm;
use Service\CampaignService;
use Service\PaymentService;
use Service\ParticipationService;

class ParticipationController extends BaseController{
    private $participateService;
    private $campaignService;
    private $paymentService;

    public function __construct(){
        $this->paymentService = new PaymentService();
        $this->participateService = new ParticipationService();
        $this->campaignService = new CampaignService();
    }

    public function index(): void{
        $selectedCampaignId = $_GET["selectedCampaignId"];
        if(isset($_SESSION["CustomerId"])){
            $arrayPaymentType = enumToArray("PaymentType");
            $campaignModel = $this->campaignService->getCampaignById($selectedCampaignId);

            require __DIR__."/../views/participant_form/pages/participant_form.php";
            if(isset($_POST["btnParticipate"])){
                $this->submitParticipateForm();        
            }
        }else{
            pushRoute("/customerLogin?selectedCampaignId=$selectedCampaignId");
        }
    }

    private function submitParticipateForm() : void{
        $paymentType = $_POST["paymentType"];
        $code = $_POST["code"];
        $cvc = $_POST["cvc"];

        $willApplyAt = $_POST["participateApplyDate"];
        $participants = $_POST["participants"];
        $note = $_POST["note"];
        $bookingStatus = BookingStatus::PENDING;
        $contactEmail = $_POST["contactEmail"];
        $contactPhoneNumber = $_POST["contactPhoneNumber"];
        $paymentType = $_POST["paymentType"];
        $customerId = $_SESSION["CustomerId"];
        $selectedCampaignId = $_GET["selectedCampaignId"];

        $campaignModelData = $this->campaignService->getCampaignById($selectedCampaignId);
        $totalAmount = $campaignModelData->getTotalPrice($participants);

        
        
        if(isset($_POST["btnParticipate"])){
            $payment = $this->paymentService->insertOnePayment(
                $paymentType,
                $code,
                $cvc,
            );
            
            if($payment === null){
                showAlertPopup("Payment error occured. Please try again later");
                exit();
            }

            $participateModel = $this->participateService->insertParticipationForm(
                $willApplyAt,
                $participants,
                $totalAmount,
                $note,
                $bookingStatus,
                $contactEmail,
                $contactPhoneNumber,
                $selectedCampaignId,
                $customerId,
                $payment->getId(),
            );

            if($participateModel === null){
                showAlertPopup("Error in Participation");
                exit();
            }else{
                showAlertPopup("Participation success");
                pushRoute("/campaignDetail?campaignId=$selectedCampaignId");
            }
        }
    }
}