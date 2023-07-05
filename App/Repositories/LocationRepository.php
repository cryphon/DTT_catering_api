<?php


namespace App\Repositories;
use App\Repositories\Repository;
use App\Models\Location;

class LocationRepository extends Repository{
  

  public function getLocationById($id){
    // init location service

    $object = $this->db->executeGetOneRecordQuery("SELECT id, address, zipCode, countryCode, phoneNumber FROM Location WHERE id = :id", ["id" => $id]);
    $location = new Location($object->id, $object->address, $object->zipCode, $object->countryCode, $object->phoneNumber);
    
    return $location;
  }
}