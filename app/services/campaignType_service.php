<?php

namespace Service;

require __DIR__."/../models/campaign_type.php";
// require __DIR__."/../core/services/db_service.php";
// require __DIR__."/../utils/cus_date.php";

use Utils\CusDate;
use model\Campaign_type;

class CampaignTypeService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateDbTable();
        // echo "campaign_type table created successfully";
    }

    private function checkOrCreateDbTable() : void{
        $createQueryString = "CREATE TABLE IF NOT EXISTS campaignType(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            campaignTypeName VARCHAR(255) NOT NULL UNIQUE,
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            activeStatus TINYINT NOT NULL DEFAULT 1,
            adminId INTEGER NOT NULL,
            FOREIGN KEY (adminId) REFERENCES admin(id) ON DELETE CASCADE
        )";
        mysqli_query($this->dbConnection, $createQueryString);
    }

    public function getCampaignTypeByName(String $campaignTypeName): ?Campaign_type{
        $searchQueryString = "SELECT * FROM campaignType WHERE campaignTypeName = '$campaignTypeName'";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Campaign_type::arrayToModel($arrayData);
        }else{
            return null;
        }
    }  

    public function getCampaignTypeById(int $campaignTypeId) : Campaign_type{
        $searchQueryString = "SELECT * FROM campaignType WHERE id = $campaignTypeId";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $arrayData = mysqli_fetch_array($searchResult);
        return Campaign_type::arrayToModel($arrayData);
    }

    public function getAllCampaignTypes() : array{
        $modelList = [];

        $getAllQueryString = "SELECT * FROM campaignType";
        $queryResult = mysqli_query($this->dbConnection, $getAllQueryString);
        $rows = mysqli_num_rows($queryResult);
        for($i = 0; $i < $rows; $i++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = Campaign_type::arrayToModel($arrayData);
            array_push($modelList, $singleModel);
        }

        return $modelList;
    }

    public function insertOneCampaignType(String $campaignTypeName, int $adminId): ?Campaign_type{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();

            $insertQueryString = "INSERT INTO campaignType
                (campaignTypeName,createdAt,adminId)
                VALUES(
                    '$campaignTypeName',
                    '$dateTime',
                    $adminId
                )
            ";

            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $modelData = $this->getCampaignTypeByName($campaignTypeName);
                return $modelData;
            }else{
                return null;
            }
        }catch(err){
            return null;
        }
    
    }
}