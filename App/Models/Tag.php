<?php


namespace App\Models;

use JsonSerializable;

class Tag implements JsonSerializable{
    private int $id;
    private string $name;


    /**
     * 
     * @param int $id
     * @param name $name
     */
    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    public function jsonSerialize(): mixed{
    return [
      'id' => $this->id,
      'name' => $this->name,
    ];
  }
}