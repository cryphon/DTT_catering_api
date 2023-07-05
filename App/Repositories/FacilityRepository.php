<?php

namespace App\Repositories;

use App\Models\Facility;
use App\Services\LocationService;

class FacilityRepository extends Repository{

  public function getAllFacilities(): array {
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
}