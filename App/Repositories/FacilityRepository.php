<?php

namespace App\Repositories;

use App\Models\Facility;
use App\Services\LocationService;
use DateTime;

class FacilityRepository extends Repository{


  /**
   * @return array
   */
  public function getAllFacilities() {
   // init location service

   $locationService = new LocationService();
    
    $objects = $this->db->executeGetListRecordsQuery("SELECT id,name, creationDate, locationId FROM Facility");
    $facilities = [];
    //map objects to facilities
    foreach ($objects as $object) {

      $location = $locationService->getLocationById($object->locationId);
      $facility = new Facility($object->name, $object->creationDate, $location, $object->id);
      array_push($facilities, $facility);
    }

    return $facilities;
  }

  /**
   * @param Facility $facility
   * @return Facility
   */
  public function createNewFacility($facility){
    $this->db->executeQuery("INSERT INTO `Facility`(`name`, `creationDate`, `locationId`) VALUES (:name,:creationDate,:locationId)", ["name" => $facility->getName(), "creationDate" => $facility->getCreationDate(), "locationId" => $facility->getLocation()->getId()]);
    $id = $this->db->getLastInsertedId();
    return $this->getFacilityById($id);
  }

  /**
   * @param int $id
   * @return Facility
   */
  public function getFacilityById($id){
    $locationService = new LocationService();

    $object = $this->db->executeGetOneRecordQuery("SELECT id, name, creationDate, locationId FROM Facility WHERE id = :id", ["id" => $id]);
    
    return empty($object) ? null : new Facility($object->name, $object->creationDate, $locationService->getLocationById($object->locationId), $object->id);
  }
}