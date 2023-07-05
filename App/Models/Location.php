<?php


namespace App\Models;

use JsonSerializable;

class Location implements JsonSerializable {
  private int $id;
  private String $city;
  private String $zipCode;
  private String $countryCode;
  private String $phoneNumber;


  /**
   * @param int $id
   * @param string $city
   * @param string $zipCode
   * @param string $countryCode
   * @param string $phoneNumber
   */
  function __construct($id, $city, $zipCode, $countryCode, $phoneNumber){
    $this->id = $id;
    $this->city = $city;
    $this->zipCode = $zipCode;
    $this->countryCode = $countryCode;
    $this->phoneNumber = $phoneNumber;
  }

  public function jsonSerialize(): mixed
  {
    return [
      'id' => $this->id,
      'city' => $this->city,
      'zipCode' => $this->zipCode,
      'countryCode' => $this->countryCode,
      'phoneNumber' => $this->phoneNumber,
    ];
  }
}