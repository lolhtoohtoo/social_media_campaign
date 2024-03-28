<?php

namespace model;

class Campaign_type{
    private int $id;
    private String $campaignTypeName;
    private String $createdAt;
    private int $adminId;
    private bool $activeStatus;

    public function __construct(
        int $id,
        String $campaignTypeName,
        String $createdAt, 
        int $adminId,
        int $activeStatus,
    ){
        $this->id = $id;
        $this->campaignTypeName = $campaignTypeName;
        $this->createdAt = $createdAt;
        $this->adminId = $adminId;
        $this->activeStatus = $activeStatus === 1 ? true : false;
    }

    static function arrayToModel(array $arrayData) : Campaign_type{
        return new Campaign_type(
            (int)$arrayData["id"],
            $arrayData["campaignTypeName"],
            $arrayData["createdAt"],
            (int)$arrayData["adminId"],
            $arrayData["activeStatus"],
        );
    }

    public function getId() : int{
        return $this->id;
    }

    public function getCampaignTypeName() : String{
        return $this->campaignTypeName;
    }

    public function getCreatedAt() : String{
        return $this->createdAt;
    }

    public function getAdminId() : int{
        return $this->adminId;
    }

    public function getActiveStatus() : bool{
        return $this->activeStatus;
    }
}