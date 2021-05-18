<?php
/**
 * This file is the CRUD implementation for Supplyers in Bio-Local
 *
 */

require_once "models/DBConnection.class.php";
use biolocal\DBConnection as DB;

/**
 * This function fetch all supplyers in the database
 * @return array The full list of supplyers in the database
 */
function getSupplyersList(){
  $db = new DB();
  $query = "SELECT * FROM supplyers";
  $result = $db->query($query);
  return $result;
}
