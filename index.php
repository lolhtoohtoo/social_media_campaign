<?php

require __DIR__."/app/router/routes.php";
require __DIR__."/app/utils/destroy_session.php";

session_start();
function startPoint() : void{
    // destroySession();
    global $routes;
    $routeString = getRouteStringFromURL();
    changeRoute($routeString, $routes);
}

startPoint();
