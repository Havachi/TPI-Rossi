<?php
/**
 * This file is the CRUD implementation for Supplyers in Bio-Local
 *
 */

require_once "models/DBConnection.class.php";
use biolocal\DBConnection as DB;

/**
 * This function fetch all supplyers in the database
 * @param array Optional. The postal code to filter supplyer by
 * @return array The full list of supplyers in the database
 */
function getSupplyersList(array $postalCodeList = array()){
  $supplyers = array();
  $db = new DB();
  $query = "SELECT * FROM supplyers";
  $result = $db->query($query);
  if ($postalCodeList != array()) {
    foreach ($postalCodeList as $postalCode) {
      foreach ($result as $supplyer) {
        if ($supplyer['supplyerCP'] == $postalCode) {
          $supplyers[] = $supplyer;
        }
      }
    }
  }else {
    $supplyers = $result;
  }

  return $supplyers;
}
