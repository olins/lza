<?php

use Phalcon\Mvc\Model;

class Mission extends Model
{
  public function initialize()
  {
      $this->setSource("mission");
  }
}
