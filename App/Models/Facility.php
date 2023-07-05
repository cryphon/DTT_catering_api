<?php

namespace App\Models;

use JsonSerializable;

class Facility implements JsonSerializable {

  private ?int $id;
  private String $name;
  private String $date;
  private Location $location;


  /**
   * @param string $name
   * @param string $date
   * @param Location $location
   * @param int $id
   */
  //id at end to make it optional
  function __construct($name, $date, $location, $id = null){
    $this->name = $name;
    $this->date = $date;
    $this->location = $location;
    $this->id = $id;
  }

  //serialize output for status messages
  public function jsonSerialize(): mixed
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'date' => $this->date,
      'location' => $this->location
    ];
  }
}