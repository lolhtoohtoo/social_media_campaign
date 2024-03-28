<?php

namespace model;

class AttachmentReply{
    private int $id;
    private ?String $message;
    private int $adminId;
    private String $createdAt;
    private ?String $deletedAt;

    public function __construct(
        int $id,
        ?String $message,
        int $adminId,
        String $createdAt,
        ?String $deletedAt,
    ){
        $this->id = $id;
        $this->message = $message;
        $this->adminId = $adminId;
        $this->createdAt = $createdAt;
        $this->deletedAt = $deletedAt;
    }

    static public function arrayToModel(array $arrayData) : AttachmentReply{
        return new AttachmentReply(
            (int)$arrayData["id"],
            $arrayData["message"],
            (int)$arrayData["adminId"],
            $arrayData["createdAt"],
            $arrayData["deletedAt"],
        );
    }

    public function getId() : int{
        return $this->id;
    }

    public function getMessage(): ?String{
        return $this->message;
    }
}