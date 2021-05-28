<?php
  require 'models/order.class.php';
  use BioLocal\Order ;

/**
 * This function create a new order
 */
function createOrder(){
  $o = new Order($_SESSION['Account']->getUserID(),$_SESSION['Cart']);
  $o->writeOrder();
}
