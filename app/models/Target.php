<?php

use Phalcon\Mvc\Model;

class Target extends Model
{
  public function initialize()
  {
      $this->setSource("target");
  }
}
