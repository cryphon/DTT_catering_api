<?php


namespace App\Services;

use App\Repositories\LocationRepository;
use App\Models;

class LocationService {
  private $locationRepo;

  function __construct(){
    $this->locationRepo = new LocationRepository();
  }

  public function getLocationById($id){
    return $this->locationRepo->getLocationById($id);
  }
}