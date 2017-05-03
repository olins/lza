<?php

use Phalcon\Mvc\Model;

class Activities extends Model
{
  public function initialize()
  {
      $this->setSource("activities");
  }
}
