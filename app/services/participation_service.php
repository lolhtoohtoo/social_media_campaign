<?php

namespace Service;

require __DIR__."/../models/participation_form.php";

use model\ParticipateForm;
use Utils\CusDate;


class ParticipationService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateDbTable();
    }

    private function checkOrCreateDbTable() : void{
        $createString = "CREATE TABLE IF NOT EXISTS participateForm(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            willApplyAt VARCHAR(50) NOT NULL,
            participants INTEGER,
            totalAmount FLOAT NOT NULL,
            note TEXT,
            activeStatus TINYINT NOT NULL DEFAULT 1,
            bookingStatus VARCHAR(30) NOT NULL,
            contactEmail VARCHAR(255),
            contactPhoneNumber VARCHAR(100),
            campaignId INTEGER NOT NULL,
            customerId INTEGER NOT NULL,
            paymentId INTEGER NOT NULL,
            FOREIGN KEY (campaignId) REFERENCES campaign(id) on DELETE CASCADE,
            FOREIGN KEY (customerId) REFERENCES customer(id) on DELETE CASCADE,
            FOREIGN KEY (paymentId) REFERENCES payment(id) on DELETE CASCADE
        )";
        mysqli_query($this->dbConnection, $createString);
    }

    public function getParticipateFormById(int $id) : ? ParticipateForm{
        $searchQueryString = "SELECT * FROM participateForm WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return ParticipateForm::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function insertParticipationForm(
        String $willApplyAt,
        int $participants,
        float $totalAmount,
        ?String $note,
        String $bookingStatus,
        ?String $contactEmail,
        ?String $contactPhoneNumber,
        int $campaignId,
        int $customerId,
        int $paymentId,
    ) : ?ParticipateForm{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();
            $insertQueryString = "INSERT INTO participateForm
                (
                    createdAt,
                    willApplyAt,
                    participants,
                    totalAmount,
                    note,
                    bookingStatus,
                    contactEmail,
                    contactPhoneNumber,
                    campaignId,
                    customerId,
                    paymentId
                )
                VALUES(
                    '$dateTime',
                    '$willApplyAt',
                    $participants,
                    $totalAmount,
                    '$note',
                    '$bookingStatus',
                    '$contactEmail',
                    '$contactPhoneNumber',
                    '$campaignId',
                    '$customerId',
                    '$paymentId'
                )";

            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $insertRowId = mysqli_insert_id($this->dbConnection);
                $dataModel = $this->getParticipateFormById($insertRowId);
                return $dataModel;
            }else{
                return null;
            }    
        }catch(err){
            return null;
        }
    }
}