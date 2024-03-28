<?php

namespace model;

class Payment{
    private int $id;
    private String $paymentName;
    private ?String $code;

    private ?String $cvc;

    public function __construct(
        int $id,
        String $paymentName,
        ?String $code,
        ?String $cvc,
    ){
        $this->id = $id;
        $this->paymentName = $paymentName;
        $this->code = $code;
        $this->cvc = $cvc;
    }

    static function arrayToModel(array $arrayData) : Payment{
        return new Payment(
            (int)$arrayData["id"],
            $arrayData["paymentName"],
            $arrayData["code"],
            $arrayData["cvc"],
        );
    }

    public function getId() : int{
        return $this->id;
    }
}
