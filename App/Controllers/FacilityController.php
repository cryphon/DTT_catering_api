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
    $object = $this->getObjectFromBody();

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
    $result = $this->facilityService->createNewFacility($facility);
    $type = gettype($result);
    if(!($type === 'Facility')){
      return (new Status\InternalServerError(["message" => $result]))->send();
    }

    return empty($facility) ? null : (new Status\Created($result))->send();
  }

  public function updateFacility(){
    $object = $this->getObjectFromBody();

    //check if body corresponds to required properties for creation of Facility
    if (!(isset($object->facilityId) && isset($object->name) && isset($object->creationDate) && isset($object->locationId))){
        return (new Status\BadRequest(["message" => "body properties do not correspond to required properties."]))->send();
    }


    //if valid facilityId
    $facility = $this->facilityService->getFacilityById($object->facilityId);
    if(empty($facility)){
      return (new Status\BadRequest(["message" => "facility with id[". $object->facilityId ."] does not exist"]))->send();
    }

    //if valid locationId
    $location = $this->locationService->getLocationById($object->locationId);
    if (empty($location)){
      return (new Status\InternalServerError(["message" => "location with id[" . $object->locationId ."] does not exist"]))->send();
    }


    $facility->setName($object->name);
    $facility->setCreationDate($object->creationDate);
    $facility->setLocation($location);
    $facility = $this->facilityService->updateFacility($facility);
    return (new Status\Ok($facility))->send();
  }

  public function deleteFacility(){
    $object = $this->getObjectFromBody();


    if(!(isset($object->facilityId))){
      return (new Status\BadRequest(["message" => "body properties do not correspond to required properties."]))->send();
    }

    //facility exists
    if(!($this->facilityService->getFacilityById($object->facilityId))){
      return (new Status\InternalServerError(["message" => "facility with id[" . $object->facilityId . "] does not exist"]))->send();
    }
    return (new Status\Ok($this->facilityService->deleteFacility($object->facilityId)))->send();

  }

  public function GetOneFacility(){
    $object = $this->getObjectFromBody();

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

  function getObjectFromBody(){
    $body =  file_get_contents('php://input');
    $object = json_decode($body);


    //handle empty body request
    if (empty($object)) {
      return (new Status\BadRequest(["message" => "No body was provided"]))->send();
    }
    return $object;
  }
}