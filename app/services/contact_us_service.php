<?php

namespace Service;

require __DIR__."/../models/contact_us.php";

use model\ContactUs;
use Utils\CusDate;

class ContactUsService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateTable();
    }

    private function checkOrCreateTable() : void{
        $createString = "CREATE TABLE IF NOT EXISTS contactUs(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            subjectTitle VARCHAR(255),
            message TEXT,
            userName VARCHAR(255),
            email VARCHAR(255) NOT NULL,
            phoneNumber VARCHAR(25),
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            attachmentReplyId INTEGER,
            rating INTEGER NOT NULL DEFAULT 0,
            FOREIGN KEY (attachmentReplyId) REFERENCES attachmentReplySupport(id) ON DELETE CASCADE
        )";
        mysqli_query($this->dbConnection, $createString);
    }

    public function getContactUsById(int $id) : ?ContactUs{
        $searchQueryString = "SELECT * FROM contactUs WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return ContactUs::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function updateReplyId(int $replyId, int $contactUsId) : bool{
        $updateString = "UPDATE contactUs SET attachmentReplyId = $replyId WHERE id = $contactUsId";
        $updateResult = mysqli_query($this->dbConnection, $updateString);
        return $updateResult;
    }

    public function getAllContactUsList() : array{
        $modelList = [];

        $queryString = "SELECT * FROM contactUs";
        $queryResult = mysqli_query($this->dbConnection, $queryString);
        $rows = mysqli_num_rows($queryResult);
        for($a = 0; $a < $rows; $a++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = ContactUs::arrayToModel($arrayData);
            array_push($modelList, $singleModel);
        }

        return $modelList;
    }

    public function insertOneContact(
        ?String $subjectTitle,
        ?String $message,
        ?String $userName,
        String $email,
        ?String $phoneNumber,
    ) : ?ContactUs{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();

            $insertQueryString = "INSERT INTO contactUs
            (
                subjectTitle,
                message,
                userName,
                email,
                phoneNumber,
                createdAt
            )
            VALUES(
                '$subjectTitle',
                '$message',
                '$userName',
                '$email',
                '$phoneNumber',
                '$dateTime'
            )";

            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $insertRowId = mysqli_insert_id($this->dbConnection);
                $dataModel = $this->getContactUsById($insertRowId);
                return $dataModel;
            }
        }catch(err){
            return null;
        }
    }
}
