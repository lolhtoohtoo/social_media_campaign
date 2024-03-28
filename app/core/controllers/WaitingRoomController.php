<?php

namespace controllers;

require __DIR__."/baseController.php";

use core\BaseController;


class WaitingRoomController extends BaseController{

    public function __construct(){
    }

    public function index() : void{
        require __DIR__."/../views/waiting_room/waiting_room_page.php";
    }
}