<?php

/**
 * This function will get neihbourg postal code from the user's postal code
 * It use a public and free API from "api.geonames.org"
 * @param  string $currentPC The user's postal code
 * @return return an array of unique postal code
 */
function getNearbyPostalCode(string $currentPC){
  $nearPC = array();
  $url = "http://api.geonames.org/findNearbyPostalCodes?postalcode=".$currentPC."&country=CH&username=havachi&maxRows=500&radius=30";
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
