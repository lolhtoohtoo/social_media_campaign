<?php
namespace Service;

require __DIR__."/../core/services/db_service.php";
require __DIR__."/../models/admin.php";
require __DIR__."/../utils/cus_date.php";
require __DIR__."/../utils/generate_key_service.php";

use Utils\CusDate;
use model\Admin;

class AdminService{
    private $getDate;
  
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = connectDb();
        $this->getDate = new CusDate();
        $this->checkOrCreateDbTable();
        // echo "admin table created successfully";
    }

    private function checkOrCreateDbTable(): void{
        // displayName is similar to userName

        $createQueryString = "CREATE TABLE IF NOT EXISTS admin(
            id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstName VARCHAR(100),
            lastName VARCHAR(100),
            displayName VARCHAR(100),  
            email VARCHAR(100) NOT NULL UNIQUE,
            hashedPassword TEXT NOT NULL,
            phoneNumber VARCHAR(25),
            profileImagePath VARCHAR(255),
            createdAt VARCHAR(50) NOT NULL,
            deletedAt VARCHAR(50),
            activeStatus TINYINT NOT NULL DEFAULT 1
        )";
        mysqli_query($this->dbConnection, $createQueryString);
    }

  
    public function getUserArrayByEmail(String $email) : ?array{
        $searchQueryString = "SELECT * FROM admin WHERE email = '$email' LIMIT 1";
        $searchResult = mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return $arrayData;
        }else{
            return null;
        }
    }

    public function getUserById(int $id) : ?Admin{
        $searchQueryString = "SELECT * FROM admin WHERE id = '$id'";
        $searchResult =  mysqli_query($this->dbConnection, $searchQueryString);
        $rows = mysqli_num_rows($searchResult);
        if($rows > 0){
            $arrayData = mysqli_fetch_array($searchResult);
            return Admin::arrayToModel($arrayData);
        }else{
            return null;
        }
    }

    public function matchPassword(String $oldHashedPassword, String $newPassword) : bool{
        return password_verify($newPassword, $oldHashedPassword);
    }


    public function insertOneAdmin(String $firstName, String $lastName,String $displayName ,String $email, String $profileImagePath, String $phoneNumber, String $password): ?Admin{

        try{
            $datetime = $this->getDate->getCurrentDateUTC();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQueryString = "INSERT INTO admin
                (firstName, lastName, displayName, email, hashedPassword, phoneNumber, profileImagePath, createdAt)
                VALUES(
                    '$firstName',
                    '$lastName',
                    '$displayName',
                    '$email',
                    '$hashedPassword',
                    '$phoneNumber',
                    '$profileImagePath',
                    '$datetime'
                )
            ";

            $insertResult = mysqli_query($this->dbConnection, $insertQueryString);
            if($insertResult){
                $arrayData = $this->getUserArrayByEmail($email);
                return Admin::arrayToModel($arrayData);
            }else{
                return null;
            }
        }catch(err){
            return null;
        }
    }
}