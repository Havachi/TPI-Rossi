<?php
require_once "models/DBConnection.class.php";
use biolocal\DBConnection as DB;


function getUserOrdersList(){
  $db = new DB();
  $query = "SELECT * FROM orders WHERE userID = :userID";
  return $db->query($query,array('userID' => $_SESSION['Account']->getUserID()));
}
