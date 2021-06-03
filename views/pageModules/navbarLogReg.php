<?php
require_once "models/gravatar.php";

?>

  <div class="navbar">
    <div class="navbar-list">

      <div class="navbar-list-brand">
        <div class="navbar-list-brand-logobrand">
          <a href="index.php">
            <img class="logo" src="/content/assets/logo/logo.png" alt="BioLocal Logo">
            <span class="brand">Bio-local</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="sm-navbar">

    <div class="sm-navbar-container">
    <a nohref name="sidebar-icon" onclick="showSMNavbar()" class="sidebar-btnCollapse">
      <span class="material-icons md-48 menu-icon">menu</span>
    </a>
    <a nohref name="cart-icon" onclick="showCart()" class="sidebar-btnCollapse">
      <span class="material-icons md-48 menu-icon">shopping_cart</span>
    </a>
      <div class="sidebar" id="sidebar">
        <button type="button" onclick="hideSMNavbar()" class="sidebar-quit "><span class="material-icons md-36">clear</span></button>
        <a class="highlightLink" href="index.php?action=home">
          <img class="logo" src="/content/assets/logo/logo.png" alt="BioLocal Logo">
          <span>Bio Local</span>
        </a>
        <a href="index.php?action=login">Se Connecter</a>
        <a href="index.php?action=register">Créer un compte</a>
      </div>
    </div>
  </div>
