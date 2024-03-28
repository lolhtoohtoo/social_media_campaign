<?php

namespace model;
use DateTime;

class Customer{
    private int $id;
    private String $firstName;
    private String $lastName;
    private String $userName;
    private String $email;
    private String $hashedPassword;
    private String $phoneNumber;
    private String $profileImagePath;
    private bool $activeStatus;
    private String $createdAt;

    public function __construct(
        int $id, 
        String $firstName,
        String $lastName,
        String $userName,
        String $email,
        String $hashedPassword,
        String $phoneNumber,
        String $profileImagePath,
        int $activeStatus,
        String $createdAt,
    ){
        $this->id= $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->phoneNumber = $phoneNumber;
        $this->profileImagePath = $profileImagePath;
        $this->activeStatus = $activeStatus === 1 ? true : false;
        $this->createdAt = $createdAt; 
    }

    static function arrayToModel(array $arrayData) : Customer{
        return new Customer(
            (int)$arrayData["id"],
            $arrayData["firstName"],
            $arrayData["lastName"],
            $arrayData["userName"],
            $arrayData["email"],
            $arrayData["hashedPassword"],
            $arrayData["phoneNumber"],
            $arrayData["profileImagePath"],
            $arrayData["activeStatus"],
            (int)$arrayData["createdAt"],
        );
    }

    public function getId() : int{
        return $this->id;
    }

    public function getUserName() : String{
        return $this->userName;
    }

    public function getFullName() : String{
        return "$this->firstName $this->lastName";
    }

    public function getEmail() : String{
        return $this->email;
    }

    public function getHashedPassword() : String{
        return $this->hashedPassword;
    }

    public function getRegistrationDate() : DateTime{
        return new DateTime($this->createdAt);
    }

    public function getRegistrationMonth() : int{
        $date = $this->getRegistrationDate();
        $month = $date->format("m");
        return (int)$month;
    }
}