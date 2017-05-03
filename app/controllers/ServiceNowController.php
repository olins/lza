<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
include_once dirname(dirname(__FILE__)).'/libraries/dom/simple_html_dom.php';

class ServiceNowController extends Controller
{
    public function indexAction()
    {
      $serviceNow = $this->getserviceNowAction();

      $thisYear = date("Y");
      $thisMonth =  date("F");
      $storeMod = new Store();
      $stores = $storeMod->getStoreData($thisYear, $thisMonth);

      $this->view->pick("serviceNow/index");
      $this->view->setVar("stores", $stores);
      $this->view->setVar("serviceNow", $serviceNow);

      $this->assets->addCss("css/serviceNow.css");
      $this->assets->addCss("css/tableStyle.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      //$this->assets->addJs("js/serviceNowPhantom.js");
    }

    public function getserviceNowAction()
    {
      $ch = curl_init();

      $incurl = "https://tiger.service-now.com//incident_list.do?XML&sysparm_userpref_module=bf2c0383c0a801640128cbe631d11c4b&sysparm_query=active%3Dtrue%5Eassigned_toISEMPTY%5Estate!%3D6%5Eassignment_groupDYNAMICd6435e965f510100a9ad2572f2b47744%5EEQ&sysparm_clear_stack=true&sysparm_clear_stack=true";
      $user = "peol@zebra.as";
      $pw = "Li!gG4x#";
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, $user .":". $pw);

      // User agent
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");
      curl_setopt($ch, CURLOPT_URL, "https://tiger.service-now.com/");

      // Download the given URL, and return output
      $output = curl_exec($ch);

      // Close the cURL resource, and free system resources
      curl_close($ch);
      var_dump($output); die();
      $output = new simple_html_dom();
      $content = file_get_contents('https://tiger.service-now.com/sys_report_display.do?sysparm_report_id=51af0bc6db6b9a0095bffddabf961943');
      $output->load($content);
      $output = strstr($output, '<div class="report_content">');
      $output = preg_replace("/<th[^>]*><\\/th[^>]*>/", '', $output);
      $output = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $output);

      return $output;

    }

    public function storeUpdateAction()
    {
      $thisYear = date("Y");
      $nextYear = date("Y", strtotime('+1 year'));
      $thisMonth =  date("F");
      $nextMonth =  date("F", strtotime('+1 month'));
      // is cURL installed yet?
      if (!function_exists('curl_init')){
          die('Sorry cURL is not installed!');
      }

      // OK cool - then let's create a new cURL resource handle
      $ch = curl_init();

      // Now set some options (most are optional)

      // Set URL to download
      curl_setopt($ch, CURLOPT_URL, 'https://api.smartsheet.com/2.0/sheets/3705393143670660');
      $header = array("Authorization: Bearer 20sh4hdt584c0s3omnm0gy6m8l",
            "Content-Type: application/json");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      // User agent
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");

      // Include header in result? (0 = yes, 1 = no)
      curl_setopt($ch, CURLOPT_HEADER, 0);

      // Should cURL return or print out the data? (true = return, false = print)
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);

      // Download the given URL, and return output
      $output = curl_exec($ch);

      // Close the cURL resource, and free system resources
      curl_close($ch);

      $smart = json_decode($output);
      foreach($smart->rows as $rowKey => $row) {
        if(isset($startRow) and !isset($endRow)) {
          $stores[] = $row->cells;
        }
        foreach($row->cells as $cell) {
          if(property_exists($cell, "value")) {
            if((string)$cell->value == $thisYear) {
              $startYear = $row->rowNumber;
            }
            if((string)$cell->value == $nextYear) {
              $endYear = $row->rowNumber;
              if($endYear < $endRow) {
                $endRow = null;
              }
            }
            if(isset($startYear)) {
              if((string)$cell->value == $thisMonth and $row->rowNumber > $startYear) {
                $startRow = $row->rowNumber + 1;
              }
              if((string)$cell->value == $nextMonth) {
                $endRow = $row->rowNumber - 1;
              }
            }
          }
        }
      }
      array_pop($stores);

      $storeData = Store::findfirst([
            "year = $thisYear and month = '$thisMonth'"
      ]);
      if(!$storeData) {
        $storeData = new Store();
        $storeData->year = $thisYear;
        $storeData->month = $thisMonth;
      }
      $storeData->data = json_encode($stores);
      $storeData->save();

    }
}
