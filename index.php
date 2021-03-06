<?php
namespace BioLocal;
require "controllers/controller.php";

/**
 * This file is the entry point for this web site.
 * It redirect users request to the right place.
 */
$request_url = $_SERVER["REQUEST_URI"];
$control = new Controller($request_url);

if (isset($_GET) && !empty($_GET)) {
  if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($control::pageExist($_GET['action'])) {
      $control::displayPage($_GET['action']);
    }else {
      $control::displayPage("home");
    }
  }
}else {
  $control::displayPage("home");
  exit();
}
