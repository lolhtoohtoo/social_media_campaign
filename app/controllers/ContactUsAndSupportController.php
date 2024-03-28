<?php

namespace controllers;

require __DIR__."/../services/contact_us_service.php";
require __DIR__."/../services/attachment_reply_support_service.php";

use core\BaseController;
use Service\AttachmentReplySupportService;
use Service\ContactUsService;
use model\ContactUs;
use model\AttachmentReply;

class ContactUsAndSupportController extends BaseController{
    private $attachmentReplySupportService;
    private $contactUsService;

    public function __construct(){
        $this->attachmentReplySupportService = new AttachmentReplySupportService();
        $this->contactUsService = new ContactUsService();
    }

    public function index() : void{
        // will show privacy policy page

        require __DIR__."/../views/contactAndSupport/pages/privacy_policy_page.php";
    }

    public function contactUs() : void{
       
        require __DIR__."/../views/contactAndSupport/pages/customer_contact_us_page.php";
        if(isset($_POST["submitQuestion"])){
            $this->submitContact();
        }
    }

    public function checkCustomerSupportMessage() : void{
        if(!isset($_SESSION["AdminId"])){
            pushRoute("/adminLogin");
        }else{
            $supportList = $this->contactUsService->getAllContactUsList();
            
            require __DIR__."/../views/contactAndSupport/pages/submission_check_from_admin_page.php";
        }

    }

    public function replyCustomerSupportMessage() : void{
        if(!isset($_SESSION["AdminId"])){
            pushRoute("/adminLogin");
        }else{
            require __DIR__."/../views/contactAndSupport/pages/support_by_admin.php";
            if(isset($_POST["replyBtn"])){
                if(!isset($_SESSION["AdminId"])){
                    pushRoute("/adminLogin");
                    exit();
                }else{
                    $this->replyContact();
                }
                
            }
        }
    }

    public function replyContact() : void{
        $message = $_POST["replyMessage"];
        $contactUsId = $_GET["contactUsId"];

        $replyModel = $this->attachmentReplySupportService->insertNewAttachmentReply(
            $message,
            $contactUsId,
        );

        if($replyModel){
            $replySuccessBool = $this->contactUsService->updateReplyId($replyModel->getId(), $contactUsId);
            if($replySuccessBool){
                showAlertPopup("Reply Success !");
                pushRoute("/adminCustomerSupport");
            }else{
                showAlertPopup("Reply Failed.  Please try again later");
            }
        }else{
            showAlertPopup("Reply message error");
        }
    }

    private function submitContact() : void{
        $subjectTitle = $_POST["subjectTitle"];
        $message = $_POST["message"];
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];

        $contactData = $this->contactUsService->insertOneContact(
            $subjectTitle,
            $message,
            $userName,
            $email,
            $phoneNumber,
        );

        if($contactData){
            showAlertPopup("Submission success");
            pushRoute("/privacyPolicy");
        }else{
            showAlertPopup("Submission Failed");
        }
    }
}