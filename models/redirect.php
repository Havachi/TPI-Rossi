<?php
namespace BioLocal;

function postRedirect($postData){
  if (isset($postData) && !empty($postData)) {
    if (isset($postData['action']) && !empty($postData['action'])){
      switch ($postData['action']) {
        case 'register':
          require_once "authentication.php";
          $r = new Register();
          $r->createAccount($_POST);
          unset($_POST);
          unset($_GET['action']);
          header('Location: /',true,303);
          $_GET['action'] = "home";
          break;
        case 'login':
          require_once "authentication.php";
          Login::loginAccount($_POST['userEmailAddress'],$_POST['userPassword']);
          break;
        }
      }
    }
  }


?>
