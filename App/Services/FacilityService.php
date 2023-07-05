<?php


namespace App\Services;
use App\Repositories\FacilityRepository;

class FacilityService {
  
  private $facilityRepo;

  function __construct(){
    $this->facilityRepo = new FacilityRepository();
  }

  public function getAllFacilities(): array {
    $f =  $this->facilityRepo->getAllFacilities();
    return $f;
  }
}