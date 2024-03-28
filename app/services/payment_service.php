<?php

namespace Service;

require __DIR__."/../models/payment.php";

use model\Payment;
use Utils\CusDate;

class PaymentService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateTable();
    }

    private function checkOrCreateTable() : void{
        $createString = "CREATE TABLE IF NOT EXISTS payment(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            paymentName VARCHAR(100) NOT NULL,
            code VARCHAR(255),
            cvc VARCHAR(50)
        )";
        mysqli_query($this->dbConnection, $createString);
    }

    public function getPaymentById(int $id) : ?Payment{
        $searchQueryString = "SELECT * FROM payment WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Payment::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function insertOnePayment(
        String $paymentName,
        ?String $code,
        ?String $cvc,
    ) : ?Payment{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();
            $insertQueryString = "INSERT INTO payment 
                (
                    createdAt,
                    paymentName,
                    code,
                    cvc
                )
                VALUES(
                    '$dateTime',
                    '$paymentName',
                    '$code',
                    '$cvc'
                )";
            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $insertRowId = mysqli_insert_id($this->dbConnection);
                $dataModel = $this->getPaymentById($insertRowId);
                return $dataModel;
            }else{
                return null;
            }
        }catch(err){
            return null;
        }
    }
}