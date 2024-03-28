<?php



function connectDb() : ?mysqli{
    $hostName = "localhost";
    $userName = "root";
    $password = "password";
    $dbName = "SocialMediaCampaignDb";
    
    try{
        $dbConnection = mysqli_connect($hostName, $userName, $password);
        if($dbConnection){
            $databaseCheckString = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'";
            $queryResult = mysqli_query($dbConnection,$databaseCheckString);
            if(mysqli_num_rows($queryResult) > 0){
                return mysqli_connect($hostName, $userName, $password, $dbName);
            }else{
                $createDatabaseString = "CREATE DATABASE IF NOT EXISTS $dbName";
                $queryCreation = mysqli_query($dbConnection, $createDatabaseString);
            
                if($queryCreation){
                    return mysqli_connect($hostName, $userName, $password, $dbName);
                }else{
                    return null;
                }
            }
        }else{
            return null;
        }

    }catch(err){
        return null;
    }

}
