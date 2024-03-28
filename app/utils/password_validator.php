<?php

// if validation is succeed, return null;
function CusPasswordValidation(String $password) : ?String{
    $minLength = 8;
    $number = preg_match("@[0-9]@", $password);
    $lowerLetter = preg_match("@[a-z]@", $password);
    $upperLetter = preg_match("@[A-Z]@", $password);
    $specialCharacters = preg_match("@[^\w]@", $password);

    if(strlen($password) < $minLength) return "Password need to have at least 8 characters";
    if(!$number) return "Number required";
    if(!$lowerLetter) return "Lower-case letter required";
    if(!$upperLetter) return "Upper-case letter required";
    if(!$specialCharacters) return "Special-case letter required";
    return null;
}