<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
  public function initialize()
  {
      $this->setSource("users");
  }

  public function getFullName()
  {
      return ($this->name.' '.$this->surname);
  }
}
