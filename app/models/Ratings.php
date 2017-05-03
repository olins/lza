<?php

use Phalcon\Mvc\Model;

class Ratings extends Model
{
  public function initialize()
  {
      $this->setSource("ratings");
  }
}
