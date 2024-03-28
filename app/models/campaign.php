<?php

namespace model;

class Campaign{
    private int $id;
    private String $campaignName;
    private ?String $imagePathOne;
    private ?String $imagePathTwo;
    private ?String $imagePathThree;
    private ?String $imagePathFour;
    private String $description;
    private String $aim;
    private String $vision;
    private String $startDate;
    private String $endDate;
    private String $createdAt;
    private float $fees;
    private float $taxPercentage;
    private String $location;
    private ?String $mapDataLink;
    private bool $activeStatus;
    private ?String $campaignContactEmail;
    private ?String $campaignContactAdditionalInfo;
    private int $adminId;
    private int $mediaAppId;
    private int $campaignTypeId;

    public function __construct(
        int $id,
        String $campaignName,
        ?String $imagePathOne,
        ?String $imagePathTwo,
        ?String $imagePathThree,
        ?String $imagePathFour,
        String $description,
        String $aim,
        String $vision,
        String $startDate,
        String $endDate,
        String $createdAt,
        float $fees,
        float $taxPercentage,
        String $location,
        ?String $mapDataLink,
        bool $activeStatus,
        ?String $campaignContactEmail,
        ?String $campaignContactAdditionalInfo,
        int $adminId,
        int $mediaAppId,
        int $campaignTypeId, 
    ){
        $this->id = $id;
        $this->campaignName = $campaignName;
        $this->imagePathOne = $imagePathOne;
        $this->imagePathTwo = $imagePathTwo;
        $this->imagePathThree = $imagePathThree;
        $this->imagePathFour = $imagePathFour;
        $this->description = $description;
        $this->aim = $aim;
        $this->vision = $vision;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->createdAt = $createdAt;
        $this->fees = $fees;
        $this->taxPercentage = $taxPercentage;
        $this->location = $location;
        $this->mapDataLink = $mapDataLink;
        $this->activeStatus = $activeStatus === 1 ? true : false;
        $this->campaignContactEmail = $campaignContactEmail;
        $this->campaignContactAdditionalInfo = $campaignContactAdditionalInfo;
        $this->adminId = $adminId;
        $this->mediaAppId = $mediaAppId;
        $this->campaignTypeId = $campaignTypeId;
    }

    static function arrayToModel(array $arrayData) : Campaign{
        return new Campaign(
            (int)$arrayData["id"],
            $arrayData["campaignName"],
            $arrayData["imagePathOne"],
            $arrayData["imagePathTwo"],
            $arrayData["imagePathThree"],
            $arrayData["imagePathFour"],
            $arrayData["description"],
            $arrayData["aim"],
            $arrayData["vision"],
            $arrayData["startDate"],
            $arrayData["endDate"],
            $arrayData["createdAt"],
            $arrayData["fees"],
            $arrayData["taxPercentage"],
            $arrayData["location"],
            $arrayData["mapDataLink"],
            $arrayData["activeStatus"],
            $arrayData["campaignContactEmail"],
            $arrayData["campaignContactAdditionalInfo"],
            $arrayData["adminId"],
            $arrayData["mediaAppId"],
            $arrayData["campaignTypeId"],
        );
    }

    public function getCampaignName() : String{
        return $this->campaignName;
    }

    public function getId() : int{
        return $this->id;
    }

    public function getStartDate() : String{
        return $this->startDate;
    }

    public function getEndDate() : String{
        return $this->endDate;
    }

    public function getCampaignTypeId() : int{
        return $this->campaignTypeId;
    }

    public function getMediaAppId() : int{
        return $this->mediaAppId;
    }

    public function getFees() : float{
        return $this->fees;
    }

    public function getTotalPrice(int $participants) : float{
        $totalPrice = $participants * $this->fees;
        $taxPrice = ($totalPrice / 100) * $this->taxPercentage;
        $finalTotalPrice = $totalPrice - $taxPrice;
        return $finalTotalPrice;
    } 

    public function getAllImages() : array{
        $imageArray = [];
        if($this->imagePathOne !== null && $this->imagePathOne !== ""){
            array_push($imageArray, $this->imagePathOne);
        }

        if($this->imagePathTwo !== null && $this->imagePathTwo !== ""){
            array_push($imageArray, $this->imagePathTwo);
        }

        if($this->imagePathThree !== null && $this->imagePathThree !== ""){
            array_push($imageArray, $this->imagePathThree);
        }

        if($this->imagePathFour !== null && $this->imagePathFour !== ""){
            array_push($imageArray, $this->imagePathFour);
        }

        return $imageArray;
    }

    public function getDescription() : String{
        return $this->description;
    }

    public function getAim() : String{
        return $this->aim;
    }

    public function getVision() : String{
        return $this->vision;
    }

    public function getTaxPercentage() : String{
        return $this->taxPercentage;
    }

    public function getLocation() : String{
        return $this->location;
    }

    public function getMapDataLink() : ?String{
        return $this->mapDataLink;
    }

    public function getActiveStatus() : bool{
        return $this->activeStatus;
    }

    public function getCampaignContactEmail() : ?String{
        return $this->campaignContactEmail;
    }

    public function getCampaignContactAdditionalInfo() : ?String{
        return $this->campaignContactAdditionalInfo;
    }
}