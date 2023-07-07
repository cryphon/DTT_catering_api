<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService{


    private TagRepository $tagRepo;


    function __construct(){
        $this->tagRepo = new TagRepository();
    }
    /**
     * @param int $id
     * @return array|null
     */
    public function getTagsByFacilityById($id){
        return $this->tagRepo->getTagsByFacilityById($id);
    }
}