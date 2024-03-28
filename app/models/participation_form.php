<?php

namespace model;

class ParticipateForm{
    private int $id;
    private String $createdAt;
    private String $willApplyAt;
    private int $participants;
    private float $totalAmount;
    private ?String $note;
    private bool $activeStatus;
    private String $bookingStatus;
    private ?String $contactEmail;
    private ?String $contactPhoneNumber;
    private int $campaignId;
    private int $customerId;
    private int $paymentId;

    public function __construct(
        int $id,
        String $createdAt,
        String $willApplyAt,
        int $participants,
        float $totalAmount,
        ?String $note,
        bool $activeStatus,
        String $bookingStatus,
        ?String $contactEmail,
        ?String $contactPhoneNumber,
        int $campaignId,
        int $customerId,
        int $paymentId,
    ){
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->willApplyAt = $willApplyAt;
        $this->participants = $participants;
        $this->totalAmount = $totalAmount;
        $this->note = $note;
        $this->activeStatus = $activeStatus === 1 ? true : false;
        $this->bookingStatus = $bookingStatus;
        $this->contactEmail = $contactEmail;
        $this->contactPhoneNumber = $contactPhoneNumber;
        $this->campaignId = $campaignId;
        $this->customerId = $customerId;
        $this->paymentId = $paymentId;
    }

    static function arrayToModel(array $arrayData) : ParticipateForm{
        return new ParticipateForm(
            (int)$arrayData["id"],
            $arrayData["createdAt"],
            $arrayData["willApplyAt"],
            (int)$arrayData["participants"],
            $arrayData["totalAmount"],
            $arrayData["note"],
            $arrayData["activeStatus"],
            $arrayData["bookingStatus"],
            $arrayData["contactEmail"],
            $arrayData["contactPhoneNumber"],
            $arrayData["campaignId"],
            $arrayData["customerId"],
            $arrayData["paymentId"],
        );
    }
}