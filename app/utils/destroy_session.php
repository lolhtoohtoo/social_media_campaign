<?php

function destroySession() :void{
    session_destroy();
}

function destroyOneSession(String $name) : void{
    unset($_SESSION[$name]);
}