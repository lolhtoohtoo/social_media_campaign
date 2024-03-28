<?php

function showAlertPopup(String $errTxt) : void{
    echo "<script>window.alert('$errTxt')</script>";
}