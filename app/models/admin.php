<?php
namespace model;

class Admin{
    private int $id;
    private String $firstName;
    private String $lastName;
    private String $displayName;

    private String $email;
    private String $phoneNumber;
    private String $profileImagePath;
    private bool $activeStatus;

    public function __construct(int $id, String $firstName, String $lastName, String $displayName, String $email, String $profileImagePath, String $phoneNumber, int $activeStatus){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->displayName = $displayName;
        $this->email = $email;
        $this->profileImagePath = $profileImagePath;
        $this->phoneNumber = $phoneNumber;
        $this->activeStatus = $activeStatus === 1 ? true : false;
    }

    static function arrayToModel(array $arrayData) : Admin{
        return new Admin(
            (int)$arrayData["id"],
            $arrayData["firstName"],
            $arrayData["lastName"],
            $arrayData["displayName"],
            $arrayData["email"],
            $arrayData["profileImagePath"] ?? "",
            $arrayData["phoneNumber"],
            $arrayData["activeStatus"],
        );
    }

    public function getId():int{
        return $this->id;
    }

    public function getFirstName() : String{
        return $this->firstName;
    }

    public function getLastName() : String{
        return $this->lastName;
    }

    public function getFullName() : String{
        return "$this->firstName $this->lastName";
    }

    public function getDisplayName() : String{
        return $this->displayName;
    }

    public function getEmail() : String{
        return $this->email;
    }

    public function getPhoneNumber() : String{
        return $this->phoneNumber;
    }

    public function getProfileImagePath() : String{
        return $this->profileImagePath;
    }

    public function getActiveStatus() : bool{
        return $this->activeStatus;
    }
}