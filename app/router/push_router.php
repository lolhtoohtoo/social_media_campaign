<?php

function pushRoute(String $routeName) : void{
    // javascript function => window.location with echo (OR) use header function from php
    // both work

    echo "<script>window.location = '$routeName'</script>";
    // header($routeName);
}