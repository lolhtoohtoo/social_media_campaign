<?php

namespace Service;

use model\Customer;
use Utils\CusDate;


class CustomerService{
    private $getDate;
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateDbTable();
    }

    private function checkOrCreateDbTable() : void{
        $createDbString = "CREATE TABLE IF NOT EXISTS customer(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            userName VARCHAR(255) NOT NULL,
            firstName VARCHAR(255),
            lastName VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            hashedPassword TEXT NOT NULL,
            phoneNumber VARCHAR(25) NOT NULL,
            profileImagePath VARCHAR(255),
            activeStatus TINYINT NOT NULL DEFAULT 1,
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50)
        )";
        mysqli_query($this->dbConnection, $createDbString);
    }

    public function getAllCustomerWithMonth(int $month) : array{
        $monthlyRegistration = [];

        $queryString = "SELECT * FROM customer";
        $queryResult = mysqli_query($this->dbConnection, $queryString);
        $rows = mysqli_num_rows($queryResult);
        for($i = 0; $i < $rows; $i++){
            $arrayData = mysqli_fetch_array($queryResult);
            $singleModel = Customer::arrayToModel($arrayData);
            $customerMonth = $singleModel->getRegistrationMonth();
            if($month === $customerMonth){
                array_push($monthlyRegistration, $singleModel);
            }
        }
        return $monthlyRegistration;
    }

    public function getCustomerModelByEmail(String $email) : ?Customer{
      
        $searchQueryString  = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Customer::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function getCustomerById(int $id) : ? Customer{
        $searchQueryString = "SELECT * FROM customer WHERE id = $id";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Customer::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function matchPassword(String $oldHashedPassword, String $newPassword) : bool{
        return password_verify($newPassword, $oldHashedPassword);
    }

    public function insertOneCustomer(
        String $userName,
        String $firstName,
        String $lastName,
        String $email,
        String $password,
        String $phoneNumber,
        String $profileImagePath
    ) : ?Customer{
        try{
            $dateTime = $this->getDate->getCurrentDateUTC();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQueryString = "INSERT INTO customer
                (
                    userName,
                    firstName,
                    lastName,
                    email,
                    hashedPassword,
                    phoneNumber,
                    profileImagePath,
                    createdAt
                )
                VALUES(
                    '$userName',
                    '$firstName',
                    '$lastName',
                    '$email',
                    '$hashedPassword',
                    '$phoneNumber',
                    '$profileImagePath',
                    '$dateTime'
                )";
            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $insertRowId = mysqli_insert_id($this->dbConnection );
                $dataModel = $this->getCustomerById($insertRowId);
                return $dataModel;
            }    
        }catch(err){
            return null;
        }
    }
}