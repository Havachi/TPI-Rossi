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
      <div class="navbar-list-nav">
        <div class="search">
          <input class="search-bar" type="text" name="search" placeholder="Recherche...">
          <button type="submit" name="search"><i class="material-icons">search</i></button>
        </div>
        <div class="productFullList">
          <a href="index.php">Tous les produits</a>
        </div>
        <div class="productDiscountList">
          <a href="index.php">Actions</a>
        </div>
      </div>
      <?php if (isset($_SESSION)): ?>
        <div class="navbar-list-user">
          <div class="user-name">
            <a href="#">
              <?php echo $_SESSION['Account']->firstName?>
              <?php echo $_SESSION['Account']->lastName ?>
            </a>
          </div>
          <div class="user-avatar">
              <img onclick="toggleMenu()" src="<?=get_gravatar($_SESSION['Account']->emailAddress,50,'identicon','g',false) ; ?>" alt="">
          </div>
        </div>
        <div id="menu" class="navbar-list-menu" style="">
          <div class="menu">
            <div class="menu-container">
              <div class="menu-list">
                <div class="menu-list-item">
                  <a href="#">Espace Client</a>
                </div>
                <div class="menu-list-item">
                  <a href="#">Se déconnecter</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="navbar-list-auth">
          <div class="auth-login">
            <a class="btn btn-primary" href="index.php?action=login">Se connecter</a>
          </div>
          <div class="auth-register">
            <a class="btn btn-secondary" href="index.php?action=register">Créer un compte</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
