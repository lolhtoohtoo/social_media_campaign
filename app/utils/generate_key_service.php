<?php

function generateSaltKey() : String{
    return bin2hex(random_bytes(20)); 
}