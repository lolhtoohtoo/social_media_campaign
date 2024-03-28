<?php

namespace Service;

class DisableLoginRegistration{

    public function wrongAttempts() : void{
        if (!isset($_SESSION["LoginFailedAttemtps"])) {
            $_SESSION['LoginFailedAttemtps'] = 1;
        } else {
            $_SESSION['LoginFailedAttemtps']++;
        }
        $remainingAttempts = 5 - $_SESSION['LoginFailedAttemtps'];
        if($remainingAttempts <= 0){
            // echo $remainingAttempts;
            $this->forceDisable();
           
            // exit();
        }else{
            showAlertPopup("Incorrect Password.  $remainingAttempts attempts remain");
        }
    }
    public function forceDisable() : void{
        $this->destroySession();
            setcookie("DisableAll", 5, time() + 20, "/");
        $this->goToWaitingRoom();
    }

    public function checkDisable() : bool{
        if (isset($_COOKIE['DisableAll'])) {
            return true;
        } else {
            return false;
        }
    }

    public function goToWaitingRoom() : void{
        pushRoute("/waitingRoom");
    }

    public function destroySession() : void{
        destroyOneSession('LoginFailedAttemtps');
    }
}