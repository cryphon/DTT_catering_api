<?php

namespace App\Models;

use JsonSerializable;
use DateTime;

class Facility implements JsonSerializable {

  private ?int $id;
  private string $name;
  private string $creationDate;
  private Location $location;


  /**
   * @param string $name
   * @param string $creationDate
   * @param Location $location
   * @param int $id
   */
  //id at end to make it optional
  function __construct($name, $creationDate, $location, $id = null){
    $this->name = $name;
    $this->creationDate = $creationDate;
    $this->location = $location;
    $this->id = $id;
  }

  public function getId(): int {
    return $this->id;
  }

  /**
   * @param int $id
   * @return self
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }


  public function getName() : string {
    return $this->name;
  }

  /**
   * @param string $name
   * @return Facility
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }
  public function getCreationDate(): string {
    return $this->creationDate;
  }

  /**
   * @param string $date
   */
  public function setCreationDate($date): self {
    $this->creationDate = $date;
    return $this;
  }

  public function getLocation(): Location {
    return $this->location;
  }
/**
 * @param Location $location
 * @return Facility
 */
  public function setLocation($location){
    $this->location = $location;
    return $this;
  }


  //serialize output for status messages
  public function jsonSerialize(): mixed
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'creationDate' => $this->creationDate,
      'location' => $this->location
    ];
  }
}