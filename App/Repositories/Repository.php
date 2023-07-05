<?php

namespace App\Repositories;

use App\Plugins\Di\Factory;


class Repository {

  protected $db;

  function __construct(){
      $di = Factory::getDi();
      $this->db = $di->getShared("db"); 
  }
}