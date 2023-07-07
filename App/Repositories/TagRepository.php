<?php

namespace App\Repositories;
use App\Models\Tag;

class TagRepository extends Repository{


    /**
     * Returns array | null
     * @param int $id
     * @return array|null
     */
    public function getTagsByFacilityById($id){
        $objects = $this->db->executeGetListRecordsQuery("SELECT t.id, t.name FROM FacilityTags as ft, Tag as t WHERE ft.facilityId = :id AND ft.TagId = t.id", ["id" => $id]);
        
        //return list of tag for Many to Many rel with facility
        $tags = [];
        foreach($objects as $obj){
            array_push($tags, new Tag($obj->id, $obj->name));
        }

        //return nulll if tags empty. can then be handled in controller
        return empty($tags) ? null : $tags;
    }
}
