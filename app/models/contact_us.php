<?php

namespace model;


class ContactUs{
    private int $id;
    private ?String $subjectTitle;
    private ?String $message;
    private ?String $userName;
    private String $email;
   
    private ?String $phoneNumber;
    private ?int $attachmentReplyId;
    private String $createdAt;
    private ?String $deletedAt;

    public function __construct(
        int $id,
        ?String $subjectTitle,
        ?String $message,
        ?String $userName,
        String $email,
        ?String $phoneNumber,
        ?int $attachmentReplyId,
        String $createdAt,
        ?String $deletedAt,
    ){
        $this->id = $id;
        $this->subjectTitle = $subjectTitle;
        $this->message = $message;
        $this->userName = $userName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->attachmentReplyId = $attachmentReplyId;
        $this->createdAt = $createdAt;
        $this->deletedAt = $deletedAt;
    }

    static public function arrayToModel(array $arrayData) : ContactUs{
        return new ContactUs(
            (int)$arrayData["id"],
            $arrayData["subjectTitle"],
            $arrayData["message"],
            $arrayData["userName"],
            $arrayData["email"],
            $arrayData["phoneNumber"],
            $arrayData["attachmentReplyId"],
            $arrayData["createdAt"],
            $arrayData["deletedAt"],
        );
    }

    public function getId() : int{
        return $this->id;
    }

    public function getUserName() : ?String{
        return $this->userName;
    }

    public function getEmail() : String{
        return $this->email;
    }

    public function getTitle() : ?String{
        return $this->subjectTitle;
    }

    public function getMessage() : ?String{
        return $this->message;
    }
}