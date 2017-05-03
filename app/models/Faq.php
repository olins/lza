<?php

use Phalcon\Mvc\Model;

class Faq extends Model
{
  public function initialize()
  {
      $this->setSource("faq");
  }
}
