<?php


namespace App\Services;
use App\Repositories\FacilityRepository;

class FacilityService {
  
  private $facilityRepo;
  private $locationService;
  private $tagService;

  function __construct(){
    $this->facilityRepo = new FacilityRepository();
    $this->locationService = new LocationService();
    $this->tagService = new TagService();
  }

  public function getAllFacilities(): array {
    $facilities =  $this->facilityRepo->getAllFacilities();

    foreach($facilities as $f){
      $f->setLocation($this->locationService->getLocationById($f->getLocationId()));
      $f->setTags($this->tagService->getTagsByFacilityById($f->getId()));
    }
    return $facilities;
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

  /**
   * @param Facility $facility
   * @return Facility
   */
  public function updateFacility($facility){
    return $this->facilityRepo->updateFacility($facility);
  }

  /**
   * @param int $id
   * @return bool
   */
  public function deleteFacility($id){
    return $this->facilityRepo->deleteFacility($id);
  }
}