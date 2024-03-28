<?php

namespace Service;

require __DIR__."/../models/media_app.php";

use Utils\CusDate;
use model\Media_app;

class MediaAppService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate;
        $this->checkOrCreateDbTable();
        // echo "mediaApp table created successfully";
    }

    private function checkOrCreateDbTable() : void{
        $createQueryString = "CREATE TABLE IF NOT EXISTS mediaApp(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            mediaAppName VARCHAR(255) NOT NULL UNIQUE,
            mediaAppImagePath VARCHAR(255),
            mediaAppRating INTEGER NOT NULL DEFAULT 0,
            mediaAppTechnique TEXT,
            mediaAppLink TEXT,
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            activeStatus TINYINT NOT NULL DEFAULT 1,
            adminId INTEGER NOT NULL,
            FOREIGN KEY (adminId) REFERENCES admin(id) ON DELETE CASCADE
        )";
        mysqli_query($this->dbConnection, $createQueryString);
    }

    public function getMediaAppByName(String $mediaAppName) : ?Media_app{
        $searchQueryString = "SELECT * FROM mediaApp WHERE mediaAppName = '$mediaAppName'";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Media_app::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function getMediaAppById(int $id) : Media_app{
        $searchQueryString = "SELECT * FROM mediaApp WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $arrayData = mysqli_fetch_array($searchResult);
        return Media_app::arrayToModel($arrayData);
    }

    public function getAllMediaApps() : array{
        $modelList = [];

        $getAllQueryString = "SELECT * FROM mediaApp";
        $queryResult = mysqli_query($this->dbConnection, $getAllQueryString);
        $rows = mysqli_num_rows($queryResult);
        for($i = 0; $i < $rows; $i++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = Media_app::arrayToModel($arrayData);
            array_push($modelList, $singleModel);
        }

        return $modelList;
    }

    public function insertOneMediaApp(
        String $mediaAppName,
        String $imagePath,
        String $mediaAppTechnique,
        String $mediaAppLink,
        int $rating,
        int $adminId,
    ) : ?Media_app{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();
            $insertQueryString = "INSERT INTO mediaApp
                (mediaAppName, mediaAppImagePath, mediaAppRating, mediaAppTechnique, mediaAppLink,createdAt, adminId)
                VALUES(
                    '$mediaAppName',
                    '$imagePath',
                    $rating,
                    '$mediaAppTechnique',
                    '$mediaAppLink',
                    '$dateTime',
                    $adminId
                )
            ";

            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $modelData = $this->getMediaAppByName($mediaAppName);
                return $modelData;
            }else{
                return null;
            }
        }catch(err){
            return null;
        }
    }
}