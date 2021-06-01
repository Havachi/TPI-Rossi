<?php
namespace BioLocal;
require "controllers/controller.php";
require "models/redirect.php";
require "models/authentication.php";

session_start();

/**
 * This file is the entry point for this web site.
 * It redirect users request to the right place.
 */

//This redirect all post Data directly where it should go
if (isset($_POST) && !empty($_POST)) {
  postRedirect($_POST);
}

$request_url = $_SERVER["REQUEST_URI"];
$control = new Controller($request_url);
if (isset($_GET) && !empty($_GET)) {
  if (isset($_GET['action']) && !empty($_GET['action'])) {

    //Logout special path
    if ($_GET['action'] === 'logout') {
      Account::logout();
    }

    //Cart action special path
    if ($_GET['action'] === 'aTC' || $_GET['action'] === 'rFC' || $_GET['action'] === 'dC') {
      if (isset($_GET['product']) && !empty($_GET['product'])) {
        $control::cartControl($_GET['action'], $_GET['product']);
      }else {
        $control::cartControl($_GET['action']);
      }
    }

    //User space special path
    if ($_GET['action'] == 'userspace') {
      if (isset($_GET['display'])) {
        if ($_GET['display'] == 'info') {
          $control::displayPage('userspaceInfo');
        }elseif($_GET['display'] == 'order'){
          $control::displayPage('userspaceOrder');
        }
      }else {
        $control::displayPage('userspaceInfo');
      }
    }

    //Checkout special path
    if ($_GET['action'] == 'checkout') {
      if (isset($_GET['step'])) {
        $control::checkoutControl($_GET['step']);
      }else{
        $control::checkoutControl();
      }
    }

    //Default path - Home
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
