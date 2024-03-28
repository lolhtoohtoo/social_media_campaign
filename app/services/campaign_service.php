<?php

namespace Service;

require __DIR__."/../models/campaign.php";

use Utils\CusDate;
use model\Campaign;

class CampaignService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateDbTable();
        // echo "campaign_type table created successfully";
    }

    private function checkOrCreateDbTable() : void{
        $createQueryString = "CREATE TABLE IF NOT EXISTS campaign(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            campaignName VARCHAR(255) NOT NULL,
            imagePathOne VARCHAR(255) NOT NULL,
            imagePathTwo VARCHAR(255),
            imagePathThree VARCHAR(255),
            imagePathFour VARCHAR(255),
            description TEXT NOT NULL,
            aim TEXT NOT NULL,
            vision TEXT NOT NULL,
            startDate VARCHAR(50) NOT NULL,
            endDate VARCHAR(50),
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            fees FLOAT NOT NULL,
            taxPercentage FLOAT NOT NULL DEFAULT 0,
            location TEXT NOT NULL,
            mapDataLink TEXT,
            activeStatus TINYINT NOT NULL DEFAULT 1,
            campaignContactEmail VARCHAR(255),
            campaignContactAdditionalInfo TEXT,
            adminId INTEGER NOT NULL,
            mediaAppId INTEGER NOT NULL,
            campaignTypeId INTEGER NOT NULL,
            FOREIGN KEY (adminId) REFERENCES admin(id) ON DELETE CASCADE,
            FOREIGN KEY (mediaAppId) REFERENCES mediaApp(id) ON DELETE CASCADE,
            FOREIGN KEY (campaignTypeId) REFERENCES campaignType(id) on DELETE CASCADE
        )";
        mysqli_query($this->dbConnection, $createQueryString);
    }


    public function getCampaignById(int $id) : ?Campaign{
        $searchQueryString = "SELECT * FROM campaign WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Campaign::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function getAllCampaignByLimit(int $limit) : array{
        $modelList = [];

        $queryString = "SELECT * FROM campaign ORDER BY id DESC Limit $limit";
        $queryResult = mysqli_query($this->dbConnection, $queryString);
        $rows = mysqli_num_rows($queryResult);
        for($i = 0; $i < $rows; $i++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = Campaign::arrayToModel($arrayData);
            array_push($modelList, $singleModel);
        }
        return $modelList;
    }

    public function getAllCampaign(): array{
        $modelList = [];

        $queryString = "SELECT * FROM campaign";
        $queryResult = mysqli_query($this->dbConnection, $queryString);
        $rows = mysqli_num_rows($queryResult);
        for($i = 0; $i < $rows; $i++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = Campaign::arrayToModel($arrayData);
            array_push($modelList, $singleModel);
        }
        return $modelList;
    }

    public function getAllCampaignByNameOnlyActive(String $txt) : array{
        $modelList = [];

        $queryString = "SELECT * FROM campaign WHERE activeStatus = 1 AND campaignName LIKE '%$txt%'";
        $queryResult = mysqli_query($this->dbConnection, $queryString);
        $rows = mysqli_num_rows($queryResult);
        for($i = 0; $i < $rows; $i++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = Campaign::arrayToModel($arrayData);
            array_push($modelList, $singleModel);
        }

        return $modelList;
    }

    public function insertOneCampaign(
        String $campaignName,
        ?String $imagePathOne,
        ?String $imagePathTwo,
        ?String $imagePathThree,
        ?String $imagePathFour,
        String $description,
        String $aim,
        String $vision,
        String $startDate,
        String $endDate,
        float $fees,
        String $location,
        ?String $mapDataLink,
        int $activeStatus,
        String $campaignContactEmail,
        ?String $campaignContactAdditionalInfo,
        int $adminId,
        int $mediaAppId,
        int $campaignTypeId,
    ) : ?Campaign{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();

            $insertQueryString = "INSERT INTO campaign
                (
                    campaignName, 
                    imagePathOne, 
                    imagePathTwo,
                    imagePathThree,
                    imagePathFour,
                    description,
                    aim,
                    vision,
                    startDate,
                    endDate,
                    createdAt,
                    fees,
                    location,
                    mapDataLink,
                    activeStatus,
                    campaignContactEmail,
                    campaignContactAdditionalInfo,
                    adminId,
                    mediaAppId,
                    campaignTypeId
                )
                VALUES(
                    '$campaignName',
                    '$imagePathOne',
                    '$imagePathTwo',
                    '$imagePathThree',
                    '$imagePathFour',
                    '$description',
                    '$aim',
                    '$vision',
                    '$startDate',
                    '$endDate',
                    '$dateTime',
                    '$fees',
                    '$location',
                    '$mapDataLink',
                    '$activeStatus',
                    '$campaignContactEmail',
                    '$campaignContactAdditionalInfo',
                    '$adminId',
                    '$mediaAppId',
                    '$campaignTypeId'
                )
            ";

            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $insertRowId = mysqli_insert_id($this->dbConnection);
                $dataModel = $this->getCampaignById($insertRowId);
                return $dataModel;
            }else{
                return null;
            }
        }catch(err){
            return null;
        }
    }
}