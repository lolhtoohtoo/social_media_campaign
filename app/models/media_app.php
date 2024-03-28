<?php

namespace model;

class Media_app{
    private int $id;
    private String $mediaAppName;
    private String $mediaAppImagePath;
    private int $mediaAppRating;
    private String $mediaAppTechnique;
    private String $mediaAppLink;
    private String $createdAt;
    private int $adminId;
    private bool $activeStatus;

    public function __construct(
        int $id,
        String $mediaAppName,
        String $mediaAppImagePath,
        int $mediaAppRating,
        String $mediaAppTechnique,
        String $mediaAppLink,
        String $createdAt,
        int $adminId,
        int $activeStatus
    ){
        $this->id = $id;
        $this->mediaAppName = $mediaAppName;
        $this->mediaAppImagePath = $mediaAppImagePath;
        $this->mediaAppRating = $mediaAppRating;
        $this->mediaAppTechnique = $mediaAppTechnique;
        $this->mediaAppLink = $mediaAppLink;
        $this->createdAt = $createdAt;
        $this->adminId = $adminId;
        $this->activeStatus = $activeStatus === 1 ? true : false;
    }

    static function arrayToModel(array $arrayData) :Media_app{
        return new Media_app(
            (int)$arrayData["id"],
            $arrayData["mediaAppName"],
            $arrayData["mediaAppImagePath"],
            (int)$arrayData["mediaAppRating"],
            $arrayData["mediaAppTechnique"],
            $arrayData["mediaAppLink"],
            $arrayData["createdAt"],
            (int)$arrayData["adminId"],
            $arrayData["activeStatus"],
        );
    }

    public function getId() : int{
        return $this->id;
    }

    public function getMediaAppName() : String{
        return $this->mediaAppName;
    }

    public function getMediaAppImagePath() : String{
        return $this->mediaAppImagePath;
    }

    public function getMediaAppRating() : int{
        return $this->mediaAppRating;
    }

    public function getMediaAppTechnique() : String{
        return $this->mediaAppTechnique;
    }

    public function getMediaLink() :String{
        return $this->mediaAppLink;
    }

    public function getCreatedAt() : String{
        return $this->createdAt;
    }

    public function getAdminId() : int{
        return $this->adminId;
    }

    public function getActionStatus() : bool{
        return $this->activeStatus;
    }
}