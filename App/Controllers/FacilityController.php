<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Plugins\Http\Response as Status;
use App\Plugins\Http\Exceptions;
use App\Services\FacilityService;
use App\Services\LocationService;
use App\Models\Facility;
use FFI\Exception;
use DateTime;

class FacilityController extends BaseController{


  private $facilityService;
  private $locationService;

  function __construct(){
    $this->facilityService = new FacilityService();
    $this->locationService = new LocationService();
  }

  public function createNewFacility(){
    $body =  file_get_contents('php://input');
    $object = json_decode($body);

    //empty body
    if (empty($object)) {
      return (new Status\BadRequest(["message" => "No body was provided"]))->send();
    }

    //check if body corresponds to required properties for creation of Facility
    if (!(isset($object->name) && isset($object->creationDate) && isset($object->locationId))){
        return (new Status\BadRequest(["message" => "body properties do not correspond to required properties."]))->send();
    }


    //TODO
    //check if date in valid format


    $location = $this->locationService->getLocationById($object->locationId);

    //check if location is valid
    if (empty($location)){
      return (new Status\InternalServerError(["message" => "location with locationId[" . $object->locationId ."] does not exist"]))->send();
    }

    $facility = new Facility($object->name, $object->creationDate, $location);

    return (new Status\Created($this->facilityService->createNewFacility($facility)))->send();
  }

  public function GetOneFacility(){
    $body = file_get_contents('php://input');
    $object = json_decode($body);

    if(empty($body)){
      return (new Status\BadRequest(["message" => "body properties do not correspond to required properties."]))->send();
    }

    $facility = $this->facilityService->getFacilityById($object->facilityId);

    //check if location is valid
    if (empty($facility)){
      return (new Status\InternalServerError(["message" => "facility with facilityId[" . $object->facilityId ."] does not exist"]))->send();
    }

    return (new Status\Ok($facility))->send();
  }

  public function getAll(){
    $facilities = $this->facilityService->getAllFacilities();
    return (new Status\Ok($facilities))->send();
  }
}