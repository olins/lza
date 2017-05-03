<?php

use Phalcon\Mvc\Model;

class Documents extends Model
{
  public function initialize()
  {
      $this->setSource("documents");
  }
}
