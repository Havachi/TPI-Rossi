<?php
  require 'models/order.class.php';
  use BioLocal\Order ;

function createOrder(){
  $o = new Order($_SESSION['Account']->getUserID(),$_SESSION['Cart']);
  $o->writeOrder();
}
