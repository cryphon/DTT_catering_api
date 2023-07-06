<?php


namespace App\Repositories;
use App\Repositories\Repository;
use App\Models\Location;
use PDOException;
use App\Plugins\Http\Response as Status;

class LocationRepository extends Repository{
  
/**
 * @param int $id
 * @return mixed|Location
 */
  public function getLocationById($id){
    $object = $this->db->executeGetOneRecordQuery("SELECT id, address, zipCode, countryCode, phoneNumber FROM Location WHERE id = :id", ["id" => $id]);
    //return null if object is empty -> will be thrown in controller
    return empty($object) ? null : new Location($object->id, $object->address, $object->zipCode, $object->countryCode, $object->phoneNumber);
  }
}