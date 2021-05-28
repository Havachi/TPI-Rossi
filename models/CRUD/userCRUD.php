<?php
require_once "models/DBConnection.class.php";
use biolocal\DBConnection as DB;

/**
 * This function get all order made by a user
 * @return array all orders
 */
function getUserOrdersList(){
  $db = new DB();
  $query = "SELECT * FROM orders WHERE userID = :userID";
  return $db->query($query,array('userID' => $_SESSION['Account']->getUserID()));
}
