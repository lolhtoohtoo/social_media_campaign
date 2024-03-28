<?php

namespace Service;

require __DIR__."/../models/attachment_reply.php";

use model\AttachmentReply;
use Utils\CusDate;

class AttachmentReplySupportService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateTable();
    }

    private function checkOrCreateTable() : void{
        $createString = "CREATE TABLE IF NOT EXISTS attachmentReplySupport(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            message TEXT,
            adminId INTEGER NOT NULL,
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            FOREIGN KEY (adminId) REFERENCES admin(id) ON DELETE CASCADE
        )";

        mysqli_query($this->dbConnection, $createString);
    }

    public function getAttachmentReplyById(int $id) : ?AttachmentReply{
        $searchQueryString = "SELECT * FROM attachmentReplySupport WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return AttachmentReply::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function insertNewAttachmentReply(
        ?String $message,
        int $adminId,
    ) : ?AttachmentReply{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();

            $insertQueryString = "INSERT INTO attachmentReplySupport
                (
                    message,
                    adminId,
                    createdAt
                )
                VALUES(
                    '$message',
                    $adminId,
                    '$dateTime'
                )";
            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $insertRowId = mysqli_insert_id($this->dbConnection);
                $dataModel = $this->getAttachmentReplyById($insertRowId);
                return $dataModel;
            }    
        }catch(err){
            return null;
        }
    } 
}