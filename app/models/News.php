<?php

use Phalcon\Mvc\Model;

class News extends Model
{
  public function initialize()
  {
      $this->setSource("news");
  }
}
