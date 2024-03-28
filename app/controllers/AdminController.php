<?php
namespace controllers;

require __DIR__."/../utils/image_saver.php";

require __DIR__."/../core/views/components/alert_popup.php";
require __DIR__."/../router/push_router.php";
require __DIR__."/../utils/password_validator.php";
require __DIR__."/../services/admin_service.php";
require __DIR__."/../core/services/disable_login_registration_service.php";
// require __DIR__."/../core/controllers/baseController.php";



use model\Admin;
use Service\AdminService;
use Service\DisableLoginRegistration;
use core\BaseController;


class AdminController extends BaseController{
    private $adminService;
    private $disableService;

    public function __construct(){
        $this->disableService = new DisableLoginRegistration();
        $this->adminService = new AdminService();
    }

    public function index():void{
        
        $checkWaiting = $this->disableService->checkDisable();
        if($checkWaiting === true){
            $this->disableService->goToWaitingRoom();
        }else{
            // $this->disableService->destroySession();
            require __DIR__ ."/../views/admin/pages/admin_registration_page.php";
            if(isset($_POST["btnSubmit"])){
                $this->createAdmin();
            }
        }
    }

    public function getLoginPage():void{
        $checkWaiting = $this->disableService->checkDisable();
        if($checkWaiting === true){
            $this->disableService->goToWaitingRoom();
        }else{
            // $this->disableService->destroySession();
            require __DIR__."/../views/admin/pages/admin_login_page.php";
            if(isset($_POST["btnLogin"])){
                $this->adminLogin();
            }
        }
    }

    public function getAdminDashboard() : void{
        if(!isset($_SESSION["AdminId"])){
            pushRoute("/adminLogin");
        }else{
            $adminData = $this->adminService->getUserById($_SESSION["AdminId"]);

            require __DIR__."/../views/admin/pages/admin_dashboard.php";
        }
    }

    public function getLogoutPage() : void{
        if(isset($_SESSION["AdminId"])){
            destroySession();
        }else{
            showAlertPopup("Please login first");
        }

        pushRoute("/");
    }

    private function createAdmin() : void{

       
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $displayName = $_POST["displayName"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phone"];
        $password = $_POST["password"];

        $errorTxt = CusPasswordValidation($password);
        if($errorTxt !== null){
            showAlertPopup($errorTxt);
            exit() ;
        }

        //check if the same email exist, if exist show popup;
        $adminArrayData = $this->adminService->getUserArrayByEmail($email);
        if($adminArrayData !== null){
            showAlertPopup("Admin already exist with same email");
            exit() ;
        }
        $imagePath = imageSaver("profileImage", null);
        $adminData = $this->adminService->insertOneAdmin(
            $firstName,
            $lastName,
            $displayName,
            $email,
            $imagePath === null ? "" : $imagePath,
            $phoneNumber,
            $password,
        );
        if($adminData === null){
            showAlertPopup("Admin registration Failed");
        }else{
            $newAdminArrayData = $this->adminService->getUserArrayByEmail($email);
            $this->assignSession($newAdminArrayData);
            showAlertPopup("Admin Registration Success");
            pushRoute("/adminDashboard");
        }
    }

    private function adminLogin() : void{
        $email = $_POST["loginEmail"];
        $password = $_POST["loginPassword"];
        $adminArrayData = $this->adminService->getUserArrayByEmail($email);
        if($adminArrayData === null){
            showAlertPopup("Admin Not Found");
            exit();
        }
        
        if(!$this->adminService->matchPassword($adminArrayData["hashedPassword"], $password)){
            $this->loginFailedCheck();
            
            exit();
        }
        showAlertPopup("Admin Login Success");
        $this->assignSession($adminArrayData);
        pushRoute("/adminDashboard");
    }

    private function assignSession(Array $adminArrayData) : void{
        $adminModelData = Admin::arrayToModel($adminArrayData);
        $_SESSION["AdminId"] = $adminModelData->getId();
    }

    private function loginFailedCheck(): void{
        $this->disableService->wrongAttempts();
    } 
}

