<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Plugins\Http\Response as Status;
use App\Plugins\Http\Exceptions;
use App\Services\FacilityService;
use App\Services\LocationService;
use App\Models\Facility;
use FFI\Exception;

class FacilityController extends BaseController{


  private $facilityService;
  private $locationService;

  function __construct(){
    $this->facilityService = new FacilityService();
    $this->locationService = new LocationService();
  }

  public function create(){
    $body =  file_get_contents('php://input');
    $object = json_decode($body);

    //empty body
    if (empty($object)) {
      return (new Status\BadRequest(["message" => "No body was provided"]))->send();
    }


    try{
      $location = $this->locationService->getLocationById($object->locationId);
      $facility = new Facility($object->name, $object->date, $location);
    }catch(Exception $e){
      return (new Status\BadRequest(["message" => $e->getMessage()]));
    }
  }
}