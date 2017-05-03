<?php

use Phalcon\Mvc\Model;

class Store extends Model
{
  public function initialize()
  {
      $this->setSource("store");
  }

  public function getStoreData($year, $month)
  {
    $storeData = Store::findfirst([
          "year = $year and month = '$month'"
    ]);

    return json_decode($storeData->data);
  }
}
