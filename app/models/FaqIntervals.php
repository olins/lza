<?php

use Phalcon\Mvc\Model;

class FaqIntervals extends Model
{
  public function initialize()
  {
      $this->setSource("faq_intervals");
  }
}
