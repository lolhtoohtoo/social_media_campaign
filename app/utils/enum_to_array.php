<?php
require __DIR__."/../constants/enums/paymentType.php";
require __DIR__."/../constants/enums/bookingStatus.php";

function enumToArray(String $enumClass): array {
    // if (empty($enumClass)) {
    //   throw new InvalidArgumentException("Enum class name cannot be empty");
    // }
    // $allConstants = get_defined_constants(true)['user'];
    // $paymentTypeConstants = array_filter($allConstants, function($value, $key) use ($enumClass) {
    //   return strpos($key, $enumClass . "::") === 0;
    // }, ARRAY_FILTER_USE_BOTH);
    // return array_values($paymentTypeConstants);
    $reflector = new ReflectionClass($enumClass);
    return array_values($reflector->getConstants());
  }
