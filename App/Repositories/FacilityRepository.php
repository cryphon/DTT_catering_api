<?php

namespace App\Repositories;

use App\Models\Facility;
use App\Services\LocationService;
use App\Plugins\Http\Response as Status;
use DateTime;
use PDOException;

class FacilityRepository extends Repository{


  /**
   * @return array
   */
  public function getAllFacilities() {
   // init location service
    
    $objects = $this->db->executeGetListRecordsQuery("SELECT id,name, creationDate, locationId FROM Facility");
    $facilities = [];
    //map objects to facilities
    foreach ($objects as $object) {

      $facility = new Facility($object->name, $object->creationDate, $object->locationId, $object->id);
      array_push($facilities, $facility);
    }

    return $facilities;
  }

  /**
   * @param Facility $facility
   * @return Facility|string
   */
  public function createNewFacility($facility){
    try{
      $this->db->executeQuery("INSERT INTO Facility(name, creationDate, locationId) VALUES (:name,:creationDate,:locationId)",
       ["name" => htmlspecialchars($facility->getName()), "creationDate" => htmlspecialchars($facility->getCreationDate()), "locationId" => htmlspecialchars($facility->getLocation()->getId())]);
    }catch(PDOException $e){
      return $e->getMessage();
    }
        $id = $this->db->getLastInsertedId();
    return $this->getFacilityById($id);
  }

  /**
   * @param int $id
   * @return Facility
   */
  public function getFacilityById($id){

    $object = $this->db->executeGetOneRecordQuery("SELECT id, name, creationDate, locationId FROM Facility WHERE id = :id", ["id" => htmlspecialchars($id)]);
    return empty($object) ? null : new Facility($object->name, $object->creationDate, $object->locationId, $object->id);
  }

  /**
   * @param Facility
   * @return Facility|string
   */
  public function updateFacility($facility){
    try {
      $this->db->executeQuery("UPDATE Facility SET name= :name, creationDate= :creationDate, locationId= :locationId WHERE id = :id", ["id" => htmlspecialchars($facility->getId()), "name" => htmlspecialchars($facility->getName()), "creationDate" => htmlspecialchars($facility->getCreationDate()), "locationId" => htmlspecialchars($facility->getLocation()->getId())]);
      return $facility;
    }catch(PDOException $e){
      return $e->getMessage();
    }
  }

  public function deleteFacility($id){
    try {
      return $this->db->executeQuery("DELETE FROM Facility WHERE id = :id", ["id" => htmlspecialchars($id)]);
    }catch(PDOException $e){
      return $e->getMessage();
    }
  }
}