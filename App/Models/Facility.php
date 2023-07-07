<?php

namespace App\Models;

use JsonSerializable;
use DateTime;

class Facility implements JsonSerializable {

  private ?int $id;
  private string $name;
  private string $creationDate;
  
  //use of locationId to reduce the amount of queries needed to create a facility
  private int $locationId;
  private Location $location;
  private ?array $tags;


  /**
   * @param string $name
   * @param string $creationDate
   * @param Location $locationId
   * @param int $id
   * @param array $tags
   */
  //id at end to make it optional
  function __construct($name, $creationDate, $locationId, $id = null, $tags = []){
    $this->name = $name;
    $this->creationDate = $creationDate;
    $this->locationId = $locationId;
    $this->id = $id;
    $this->tags = $tags;
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

  public function getLocationId(): int {
    return $this->locationId;
  }
  /**
  * @param int $locationId
  * @return Facility
  */
  public function setLocationId($locationId){
    $this->location = $locationId;
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


  public function getTags(): array {
    return $this->tags;
  }

  /**
   * @param array $tags
   * @return Facility
   */
  public function setTags($tags){
    $this->tags = $tags;
    return $this;
  }

  //serialize output for status messages
  public function jsonSerialize(): mixed
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'creationDate' => $this->creationDate,
      'location' => $this->location,
      'tags' => $this->tags
    ];
  }
}