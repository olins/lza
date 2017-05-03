<?php

use Phalcon\Mvc\Model;

class DateIntervals extends Model
{
  public function initialize()
  {
      $this->setSource("date_intervals");
  }
}
