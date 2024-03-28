<?php

namespace controllers;

require __DIR__."/../models/customer.php";
require __DIR__."/../services/customer_service.php";

use core\BaseController;
use model\Customer;
use Service\CustomerService;
use Service\DisableLoginRegistration;

class CustomerController extends BaseController{
    private $customerService;
    private $disableService;

    public function __construct(){
        $this->customerService = new CustomerService();
        $this->disableService = new DisableLoginRegistration();
    }

    public function index() :void{
        // for customer profile
    }

    public function customerLogin() : void{
        $checkWaiting = $this->disableService->checkDisable();
        if($checkWaiting === true){
            $this->disableService->goToWaitingRoom();
        }else{
            // $this->disableService->destroySession();

            $selectedCampaignId = $_GET["selectedCampaignId"];
            require __DIR__."/../views/customer/pages/customer_login.php";
            if(isset($_POST["cusLoginBtn"])){
                $this->login();
            }
        }
    }

    public function customerRegister() : void{
        $checkWaiting = $this->disableService->checkDisable();
        if($checkWaiting === true){
            $this->disableService->goToWaitingRoom();
        }else{
            // $this->disableService->destroySession();

            $selectedCampaignId = $_GET["selectedCampaignId"];
            require __DIR__."/../views/customer/pages/customer_register.php";
            if(isset($_POST["CusRegisterBtn"])){
                $this->createCustomer();
            }
        }

        
    }

    private function createCustomer(): void{
        $userName = $_POST["cusRegisterUserName"];
        $firstName = $_POST["cusRegisterFirstName"];
        $lastName = $_POST["cusRegisterLastName"];
        $phoneNumber = $_POST["cusRegisterPhoneNumber"];
        $email = $_POST["cusRegisterEmail"];
        $password = $_POST["cusRegisterPassword"];

        // password validation
        $errorTxt = CusPasswordValidation($password);
        if($errorTxt !== null){
            showAlertPopup(($errorTxt));
            exit();
        }

        //check if the customer exist
        $customerModel = $this->customerService->getCustomerModelByEmail($email);
        if($customerModel !== null){
            showAlertPopup("Customer already exist with the same email");
            exit();
        }

        $imagePath = imageSaver("cusRegisterProfileImage", null);

        $newCustomerData = $this->customerService->insertOneCustomer(
            $userName,
            $firstName,
            $lastName,
            $email,
            $password,
            $phoneNumber,
            $imagePath,
        );

        if($newCustomerData === null){
            showAlertPopup("Customer Registration Failed");
            exit();
        }else{
            $selectedCampaignId = $_GET["selectedCampaignId"];
            $this->assignSession($newCustomerData);
            showAlertPopup("Customer Registration Success.  Please click 'Ok' to go to participation form");
            pushRoute("/participationForm?selectedCampaignId=$selectedCampaignId");
        }
    }

    private function login() : void{
        $email = $_POST["cusLoginEmail"];
        $password = $_POST["cusLoginPassword"];
        
        //check user exist
        $customerModelData = $this->customerService->getCustomerModelByEmail($email);
        if($customerModelData === null){
            showAlertPopup("Customer Not Found");
            exit();
        }

        $checkPassword = $this->customerService->matchPassword($customerModelData->getHashedPassword(), $password);
        if($checkPassword === true){
            $selectedCampaignId = $_GET["selectedCampaignId"];
            $this->assignSession($customerModelData);
            pushRoute("/participationForm?selectedCampaignId=$selectedCampaignId");
        }else{
            showAlertPopup("Wrong Password");
            exit();
        }
    }

    private function assignSession(Customer $customerModel) : void{
        $_SESSION["CustomerId"] = $customerModel->getId();
    }

    private function loginFailedCheck(): void{

    }
}