<?php

function getNearbyPostalCode(string $currentPC){
  $nearPC = array();
  $url = "http://api.geonames.org/findNearbyPostalCodes?postalcode=".$currentPC."&country=CH&radius=30&username=havachi";
  if (!function_exists('curl_init')){
    die('Sorry cURL is not installed!');
  }
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_URL, $url);
  $rawdata = curl_exec($curl);
  curl_close($curl);
  $xml = simplexml_load_string($rawdata);
  foreach ($xml->code as $result) {
    $nearPC[] = (string)$result->postalcode;
  }
  return array_unique($nearPC);
}
