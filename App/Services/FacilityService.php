<?php


namespace App\Services;
use App\Repositories\FacilityRepository;

class FacilityService {
  
  private $facilityRepo;

  function __construct(){
    $this->facilityRepo = new FacilityRepository();
  }

  public function getAllFacilities(): array {
    return $this->facilityRepo->getAllFacilities();
  }

  /**
   * @param int $id
   * @return Facility
   */
  public function getFacilityById($id){
    return $this->facilityRepo->getFacilityById($id);
  }


  /**
   * @param Facility $facility
   * @return Facility
   */
  public function createNewFacility($facility){
    return $this->facilityRepo->createNewFacility($facility);
  }
}